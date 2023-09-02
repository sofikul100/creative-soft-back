<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class SliderController extends Controller
{
    public function slider_index(Request $request)
    {
        if ($request->ajax()) {
            $slider_image_path = asset('backend/slider_images');
            $teams = DB::table('sliders')->get();
            return DataTables::of($teams)
                ->addIndexColumn()
                ->editColumn('slider_image', function ($row) use ($slider_image_path) {
                    return '<img src="' . $slider_image_path . '/' . $row->slider_image . '"  height="auto" width="200px">';
                })
                ->editColumn('status', function ($row) {
                    if(Auth::user()->can('status.slider')){
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
                      if(Auth::user()->can('edit.slider')){
                        $actionBtn .= '<a  class="btn btn-outline-info btn-sm edit_slider"   data-id="' . $row->id . '"  data-bs-toggle="modal" data-bs-target="#edit_slider">Edit</a>&nbsp;';
                      }
                      
                      if(Auth::user()->can('delete.slider')){
                        $actionBtn .= '<a  class="btn btn-outline-danger btn-sm"  data-id="' . $row->id . '" onclick="deleteSlider(' . $row->id . ')">Delete</a>';
                      }
                      

                    return $actionBtn;
                })

                ->rawColumns(['action', 'slider_image', 'status'])
                ->make(true);
        } else {
            $sliders = Slider::all();
            return view('backend.slider.slider', compact('sliders'));
        }
    }




    public function add_slider(Request $request)
    {
        $request->validate([
            'slider_image' => 'required|image|mimes:jpg,jpeg',
            'slider_toptitle' => 'required',
            'slider_maintitle' => 'required',
            'slider_subtitle' => 'required'
        ]);


        $sliderImage = $request->file('slider_image');
        $SliderImg = Image::make($sliderImage);
        $originalPath = public_path() . '/backend/slider_images/';
        $SliderImg->resize(1200, 600);
        $imageName = time() . $sliderImage->getClientOriginalName();
        $SliderImg->save($originalPath . $imageName);

        $slider = new Slider();
        $slider->slider_toptitle = $request->slider_toptitle;
        $slider->slider_maintitle = $request->slider_maintitle;
        $slider->slider_subtitle = $request->slider_subtitle;
        $slider->slider_image = $imageName;
        $slider->save();

        return response()->json(['success' => true, 'message' => 'Slider Added Successfully']);
    }





    public function edit_slider(Request $request){
        $slider = DB::table('sliders')->where('id', $request->id)->first();

        return response()->json([$slider]);
    }



    public function update_slider (Request $request){
        $request->validate([
            'slider_update_toptitle' => 'required',
            'slider_update_maintitle' => 'required',
            'slider_update_subtitle' => 'required'
        ]);

        $slider = Slider::find($request->slider_id);

        $old_slider_image = $slider->slider_image;




        if ($request->slider_update_image) {

            if (file_exists(public_path('backend/slider_images/' . $old_slider_image))) {
                unlink(public_path('backend/slider_images/' . $old_slider_image));
            }

            $sliderImage = $request->file('slider_update_image');
            $SliderImg = Image::make($sliderImage);
            $originalPath = public_path() . '/backend/slider_images/';
            $SliderImg->resize(1200, 600);
            $imageName = time() . $sliderImage->getClientOriginalName();
            $SliderImg->save($originalPath . $imageName);

            $slider->slider_image = $imageName;
            $slider->slider_toptitle = $request->slider_update_toptitle;
            $slider->slider_maintitle = $request->slider_update_maintitle;
            $slider->slider_subtitle = $request->slider_update_subtitle;
            $slider->save();

            return response()->json(['success' => true, 'message' => 'Successfully Slider updated']);
        } else {
            $slider->slider_image = $old_slider_image;
            $slider->slider_toptitle = $request->slider_update_toptitle;
            $slider->slider_maintitle = $request->slider_update_maintitle;
            $slider->slider_subtitle = $request->slider_update_subtitle;

            $slider->save();

            return response()->json(['success' => true, 'message' => 'Successfully Slider updated']);
        }
    }










    public function delete_slider (Request $request){
        $slider = Slider::find($request->id);

        if (file_exists(public_path('backend/slider_images/' . $slider->slider_image))) {
            unlink(public_path('backend/slider_images/' . $slider->slider_image));
        }

        $slider->delete();

        return response()->json(['success' => true, 'message' => 'Slider deleted successfully']);
    }





    public function change_slider_status (Request $request){
        $slider = Slider::find($request->slider_id);
        $slider->status = $request->status;
        $slider->save();

        return response()->json(['success' => true]);
    }
}
