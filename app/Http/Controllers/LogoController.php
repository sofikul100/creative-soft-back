<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class LogoController extends Controller
{
    public function logo_index(Request $request)
    {
        if ($request->ajax()) {
            $logo_images_path = asset('backend/logo_images');
            $logo = DB::table('logos')->get();
            return DataTables::of($logo)
                ->addIndexColumn()
                ->editColumn('logo', function ($row) use ($logo_images_path) {
                    return '<img src="' . $logo_images_path . '/' . $row->logo . '"  height="90px" width="220px">';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn='';
                    if(Auth::user()->can('edit.logo')){
                        $actionBtn .= '<a  class="btn btn-outline-info btn-sm edit_logo mr-2"   data-id="' . $row->id . '"  data-bs-toggle="modal" data-bs-target="#edit-logo">Edit</a> &nbsp;';
                    }
                    if(Auth::user()->can('delete.logo')){
                    $actionBtn .= '<a  class="btn btn-outline-danger btn-sm ml-2"  data-id="' . $row->id . '" onclick="deleteLogo(' . $row->id . ')">Delete</a>';
                    }
                    return $actionBtn;
                })

                ->rawColumns(['action', 'logo'])
                ->make(true);
        } else {
            $logo = Logo::all();
            return view('backend.logo.logo', compact('logo'));
        }
    }


    public function add_logo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpg,png,jpeg,svg'
        ]);

       

        $logoImage = $request->file('logo');
        $logo = Image::make($logoImage);
        $originalPath = public_path() . '/backend/logo_images/';
        $logo->resize(200, 200);
        $imageName = time() . $logoImage->getClientOriginalName();
        $logo->save($originalPath . $imageName);

        $logo = new Logo();
        $logo->logo = $imageName;
        $logo->save();

        return response()->json(['success' => true, 'message' => 'Logo Added Successfully']);
    }



    public function edit_logo(Request $request)
    {
        $logo = DB::table('logos')->where('id', $request->id)->first();

        return response()->json([$logo]);
    }





    public function update_logo(Request $request)
    {
        $request->validate([
            'update_logo' => 'required'
        ]);

        $logo = Logo::find($request->logo_id);

        $old_logo = $logo->logo;




        if ($request->update_logo) {

            if (file_exists(public_path('backend/logo_images/' . $old_logo))) {
                unlink(public_path('backend/logo_images/' . $old_logo));
            }

            $logoImage = $request->update_logo;
            $logoImg = Image::make($logoImage);
            $originalPath = public_path() . '/backend/logo_images/';
            $logoImg->resize(200, 200);
            $imageName = time() . $logoImage->getClientOriginalName();
            $logoImg->save($originalPath . $imageName);

            $logo->logo = $imageName;


            $logo->save();

            return response()->json(['success'=>true,'message' => 'Successfully logo updated']);
        }
    }




    










    public function delete_logo(Request $request)
    {
        $logo = Logo::find($request->id);

        if (file_exists(public_path('backend/logo_images/' . $logo->logo))) {
            unlink(public_path('backend/logo_images/' . $logo->logo));
        }

        $logo->delete();

        return response()->json(['success' => true, 'message' => 'Logo deleted successfully']);
    }
}
