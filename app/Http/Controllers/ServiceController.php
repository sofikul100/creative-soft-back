<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class ServiceController extends Controller
{
    public function service_index(Request $request)
    {
        if ($request->ajax()) {
            $service_image_path = asset('backend/service_images');
            $services = DB::table('services')->get();
            return DataTables::of($services)
                ->addIndexColumn()
                ->editColumn('service_image', function ($row) use ($service_image_path) {
                    return '<img src="' . $service_image_path . '/' . $row->service_image . '"  height="120px" width="220px">';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    if(Auth::user()->can('edit.service')){
                        $actionBtn .= '<a  class="btn btn-outline-info btn-sm edit_service"   data-id="' . $row->id . '"  data-bs-toggle="modal" data-bs-target="#edit-service">Edit</a>';
                    }
                    if(Auth::user()->can('delete.service')){
                        $actionBtn .= '<a  class="btn btn-outline-danger btn-sm"  data-id="' . $row->id . '" onclick="deleteService(' . $row->id . ')">Delete</a>';
                    }
                    
 
                    return $actionBtn;
                })

                ->rawColumns(['action', 'service_image'])
                ->make(true);
        } else {
            $services = Service::all();
            return view('backend.service_f.service', compact('services'));
        }
    }



    public function add_service(Request $request)
    {
        $request->validate([
            'service_title' => 'required',
            'service_description' => 'required|max:400',
            'service_image' => 'required|image|mimes:jpg,jpeg,png,svg'
        ]);



        $serviceImage = $request->file('service_image');
        $service = Image::make($serviceImage);
        $originalPath = public_path() . '/backend/service_images/';
        $service->resize(200, 200);
        $imageName = time() . $serviceImage->getClientOriginalName();
        $service->save($originalPath . $imageName);

        $service = new Service();
        $service->service_title = $request->service_title;
        $service->service_description = $request->service_description;
        $service->service_image = $imageName;
        $service->save();

        return response()->json(['success' => true, 'message' => 'Service Added Successfully']);
    }





    public function edit_service(Request $request)
    {
        $service = DB::table('services')->where('id', $request->id)->first();

        return response()->json([$service]);
    }




    public function update_service(Request $request)
    {
        $request->validate([
            'service_update_title' => 'required',
            'service_update_description' => 'required'
        ]);

        $service = Service::find($request->service_id);

        $old_service_imgae = $service->service_image;




        if ($request->service_update_image) {

            if (file_exists(public_path('backend/service_images/' . $old_service_imgae))) {
                unlink(public_path('backend/service_images/' . $old_service_imgae));
            }

            $ServiceImage = $request->service_update_image;
            $serviceImg = Image::make($ServiceImage);
            $originalPath = public_path() . '/backend/service_images/';
            $serviceImg->resize(200, 200);
            $imageName = time() . $ServiceImage->getClientOriginalName();
            $serviceImg->save($originalPath . $imageName);

            $service->service_image = $imageName;
            $service->service_title = $request->service_update_title;
            $service->service_description = $request->service_update_description;

            $service->save();

            return response()->json(['success' => true, 'message' => 'Successfully Service updated']);
        } else {
            $service->service_image = $old_service_imgae;
            $service->service_title = $request->service_update_title;
            $service->service_description = $request->service_update_description;

            $service->save();

            return response()->json(['success' => true, 'message' => 'Successfully Service updated']);
        }
    }










    public function delete_service(Request $request)
    {
        $service = Service::find($request->id);

        if (file_exists(public_path('backend/service_images/' . $service->service_image))) {
            unlink(public_path('backend/service_images/' . $service->service_image));
        }

        $service->delete();

        return response()->json(['success' => true, 'message' => 'Service deleted successfully']);
    }
}
