<?php

namespace App\Http\Controllers;

use App\Models\ClientSay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class WhatClientSaysController extends Controller
{
    public function client_says_index(Request $request)
    {
        if ($request->ajax()) {
            $client_says_image_path = asset('backend/what_client_says_images');
            $teams = DB::table('client_says')->get();
            return DataTables::of($teams)
                ->addIndexColumn()
                ->editColumn('client_image', function ($row) use ($client_says_image_path) {
                    return '<img src="' . $client_says_image_path . '/' . $row->client_image . '"  height="70px" width="70px" style="border-radius:50px">';
                })
                ->editColumn('status', function ($row) {
                    if(Auth::user()->can('status.clientsay')){
                        if ($row->status == 'active') {
                            return '<label class="switch">
                           <input  checked class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="active" data-off="inctive" data-id="' . $row->id . '">
                           <span class="slider round"></span>
                           </label>';
                        } else {
                            return '<label class="switch">
                           <input  class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="active" data-off="inctive" data-id="' . $row->id . '">
                           <span class="slider round"></span>
                           </label>';
                        }
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                      if(Auth::user()->can('edit.clientsay')){
                        $actionBtn .= '<a  class="btn btn-outline-info btn-sm edit_client_say"   data-id="' . $row->id . '"  data-bs-toggle="modal" data-bs-target="#edit_client_say">Edit</a>';
                      }
                      if(Auth::user()->can('delete.clientsay')){
                        $actionBtn .= '<a  class="btn btn-outline-danger btn-sm"  data-id="' . $row->id . '" onclick="deleteClientSay(' . $row->id . ')">Delete</a>';
                      }
                      
                    return $actionBtn;
                })

                ->rawColumns(['action', 'client_image', 'status'])
                ->make(true);
        } else {
            $client_says = ClientSay::all();
            return view('backend.what_client_says.what_client_says', compact('client_says'));
        }
    }




    public function add_client_say(Request $request)
    {
        $request->validate([
            'client_name' => 'required',
            'client_position' => 'required',
            'client_message' => 'required',
            'client_image' => 'required'
        ]);


        $clientImage = $request->file('client_image');
        $ClientImg = Image::make($clientImage);
        $originalPath = public_path() . '/backend/what_client_says_images/';
        $ClientImg->resize(70, 70);
        $imageName = time() . $clientImage->getClientOriginalName();
        $ClientImg->save($originalPath . $imageName);

        $ClientSay = new ClientSay();
        $ClientSay->client_name = $request->client_name;
        $ClientSay->client_position = $request->client_position;
        $ClientSay->client_message = $request->client_message;
        $ClientSay->client_image = $imageName;
        $ClientSay->save();

        return response()->json(['success' => true, 'message' => 'Client Say Added Successfully']);
    }





    public function edit_client_say (Request $request){
        $client_say = DB::table('client_says')->where('id', $request->id)->first();

        return response()->json([$client_say]);
    }



    public function update_client_say (Request $request){
        $request->validate([
            'client_update_name' => 'required',
            'client_update_position' => 'required',
            'client_update_message' => 'required'
        ]);

        $client_say = ClientSay::find($request->client_say_id);

        $old_client_image = $client_say->client_image;




        if ($request->client_update_image) {

            if (file_exists(public_path('backend/what_client_says_images/' . $old_client_image))) {
                unlink(public_path('backend/what_client_says_images/' . $old_client_image));
            }

            $clientImage = $request->client_update_image;
            $ClientImg = Image::make($clientImage);
            $originalPath = public_path() . '/backend/what_client_says_images/';
            $ClientImg->resize(200, 200);
            $imageName = time() . $clientImage->getClientOriginalName();
            $ClientImg->save($originalPath . $imageName);

            $client_say->client_image = $imageName;
            $client_say->client_name = $request->client_update_name;
            $client_say->client_position = $request->client_update_position;
            $client_say->client_message = $request->client_update_message;
            $client_say->save();

            return response()->json(['success' => true, 'message' => 'Successfully Client Say updated']);
        } else {
            $client_say->client_image = $old_client_image;
            $client_say->client_name = $request->client_update_name;
            $client_say->client_position = $request->client_update_position;
            $client_say->client_message = $request->client_update_message;

            $client_say->save();

            return response()->json(['success' => true, 'message' => 'Successfully Client Say updated']);
        }
    }










    public function delete_client_say (Request $request){
        $client_say = ClientSay::find($request->id);

        if (file_exists(public_path('backend/what_client_says_images/' . $client_say->client_image))) {
            unlink(public_path('backend/what_client_says_images/' . $client_say->client_image));
        }

        $client_say->delete();

        return response()->json(['success' => true, 'message' => 'Client Say deleted successfully']);
    }





    public function change_clientsay_status (Request $request){
        $client_say = ClientSay::find($request->client_say_id);
        $client_say->status = $request->status;
        $client_say->save();

        return response()->json(['success' => true]);
    }






}
