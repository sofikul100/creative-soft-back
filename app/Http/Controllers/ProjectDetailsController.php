<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\ProjectPricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class ProjectDetailsController extends Controller
{
    public function project_details_index(Request $request)
    {
        if ($request->ajax()) {
            $project_detail_feature_image_path = asset('backend/project_detail_section_images');
            $teams = DB::table('project_details')
                ->join('projects', 'project_details.project_id', '=', 'projects.id')
                ->select('project_details.*', 'projects.project_title')
                ->get();
            return DataTables::of($teams)
                ->addIndexColumn()
                ->editColumn('project_detail_feature_image', function ($row) use ($project_detail_feature_image_path) {
                    return '<img src="' . $project_detail_feature_image_path . '/' . $row->project_detail_feature_image . '"  height="auto" width="200px">';
                })
                ->editColumn('status', function ($row) {
                    if(Auth::user()->can('status.project_d_section')){
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
                      if(Auth::user()->can('edit.project_d_section')){
                        $actionBtn .= '<a href="' . route('edit.project_detail_section', $row->id) . '"  class="btn btn-outline-info btn-sm">Edit</a> &nbsp;';
                      }
                      
                      if(Auth::user()->can('delete.project_d_section')){
                        $actionBtn .= '<a  class="btn btn-outline-danger btn-sm"  data-id="' . $row->id . '" onclick="deleteProjectDetailSection(' . $row->id . ')">Delete</a>';
                      }

                    return $actionBtn;
                })

                ->rawColumns(['action', 'project_detail_feature_image', 'status'])
                ->make(true);
        } else {
            $project_details = DB::table('project_details')->get();
            $projects = DB::table('projects')->get();
            return view('backend.project_details.project_details', compact('project_details', 'projects'));
        }
    }




    public function add_project_detail_section(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'project_detail_feature_content' => 'required',
            'project_detail_feature_image' => 'required|image|mimes:jpg,jpeg,png',
        ]);


        $projectDetailSectionImage = $request->file('project_detail_feature_image');
        $Img = Image::make($projectDetailSectionImage);
        $originalPath = public_path() . '/backend/project_detail_section_images/';
        $Img->resize(800, 800);
        $imageName = time() . $projectDetailSectionImage->getClientOriginalName();
        $Img->save($originalPath . $imageName);

        $projectDetailSection = new ProjectDetail();
        $projectDetailSection->project_id = $request->project_id;
        $projectDetailSection->project_detail_feature_content = strip_tags($request->project_detail_feature_content);
        $projectDetailSection->project_detail_feature_image = $imageName;
        $projectDetailSection->save();

        return response()->json(['success' => true, 'message' => 'Project Detail Section Added Successfully']);
    }




    public function edit_project_detail_section($id)
    {
        $projects = DB::table('projects')->get();
        $project_detail = DB::table('project_details')->where('id', $id)->first();
        return view("backend.project_details.edit_project_detail", compact('projects', 'project_detail'));
    }



    public function update_project_detail_section(Request $request, $id)
    {
        $request->validate([
            'project_id' => 'required',
            'project_detail_feature_content' => 'required',
        ]);

        $project_detail = ProjectDetail::find($id);

        $old_project_detail_image = $project_detail->project_detail_feature_image;




        if ($request->project_detail_feature_image) {

            if (file_exists(public_path('backend/project_detail_section_images/' . $old_project_detail_image))) {
                unlink(public_path('backend/project_detail_section_images/' . $old_project_detail_image));
            }

            $projectDetailSectionImage = $request->file('project_detail_feature_image');
            $Img = Image::make($projectDetailSectionImage);
            $originalPath = public_path() . '/backend/project_detail_section_images/';
            $Img->resize(800, 800);
            $imageName = time() . $projectDetailSectionImage->getClientOriginalName();
            $Img->save($originalPath . $imageName);

            $project_detail->project_id = $request->project_id;
            $project_detail->project_detail_feature_content =$request->project_detail_feature_content;
            $project_detail->project_detail_feature_image = $imageName;
            $project_detail->save();

            return redirect()->route('project_details.index')->with('message','Product Detail Section Updated Successfully');
        } else {
            $project_detail->project_id = $request->project_id;
            $project_detail->project_detail_feature_content = strip_tags($request->project_detail_feature_content);
            $project_detail->project_detail_feature_image = $old_project_detail_image;

            $project_detail->save();

            return redirect()->route('project_details.index')->with('message','Product Detail Section Updated Successfully');
        }
    }




    public function delete_project_detail_section(Request $request)
    {
        $project_detail_section = ProjectDetail::find($request->id);

        if (file_exists(public_path('backend/project_detail_section_images/' . $project_detail_section->project_detail_feature_image))) {
            unlink(public_path('backend/project_detail_section_images/' . $project_detail_section->project_detail_feature_image));
        }

        $project_detail_section->delete();

        return response()->json(['success' => true, 'message' => 'Project Detail Section deleted successfully']);
    }




    public function change_project_detail_section_status (Request $request){
        $slider = ProjectDetail::find($request->project_detail_section_id);
        $slider->status = $request->status;
        $slider->save();

        return response()->json(['success' => true]);
    }






    //==========START WORKING WITH PROJECT PRICINGJ============//
    public function project_pricing_index(Request $request){
        if ($request->ajax()) {
            $data = DB::table('project_pricings')
                ->join('projects', 'project_pricings.project_id', '=', 'projects.id')
                ->select('project_pricings.*', 'projects.project_title')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('is_populer', function ($row) {
                    if(Auth::user()->can('populer.project_price')){
                        if ($row->is_populer == 1) {
                            return '<label class="switch">
                           <input  checked class="toggle-class-populer" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="active" data-off="inctive" data-id="' . $row->id . '">
                           <span class="slider round"></span>
                           </label>';
                        } else {
                            return '<label class="switch">
                           <input  class="toggle-class-populer" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="active" data-off="inctive" data-id="' . $row->id . '">
                           <span class="slider round"></span>
                           </label>';
                        }
                    }
                })
                ->editColumn('status', function ($row) {
                    if(Auth::user()->can('status.project_price')){
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
                      if(Auth::user()->can('edit.project_price')){
                        $actionBtn .= '<a href="' . route('edit.product_pricing', $row->id) . '"  class="btn btn-outline-info btn-sm">Edit</a>';
                      }
                     

                      if(Auth::user()->can('delete.project_price')){
                        $actionBtn .= '<a  class="btn btn-outline-danger btn-sm"  data-id="' . $row->id . '" onclick="delete_product_pricing(' . $row->id . ')">Delete</a>';
                      }
                    return $actionBtn;
                })

                ->rawColumns(['action','status','is_populer'])
                ->make(true);
        } else {
            $project_pricings = DB::table('project_pricings')->get();
            $projects = DB::table('projects')->get();
            return view('backend.project_pricing.project_pricing', compact('project_pricings', 'projects'));
        }
    }




    public function add_project_pricing (Request $request){
        $request->validate([
            'project_id' => 'required',
            'pricing_type_name' => 'required',
            'pricing_ammount' => 'required',
            'pricing_features'=>'required'
        ]);


        $project_pricing = new ProjectPricing();

        $project_pricing->project_id = $request->project_id;
        $project_pricing->pricing_type_name= $request->pricing_type_name;
        $project_pricing->pricing_ammount = $request->pricing_ammount;
        $project_pricing->pricing_features = $request->pricing_features;

        $project_pricing->save();

        if($project_pricing->save()){
            return response()->json(['success'=>true,'message'=>'project pricing added successfully']);
        }
    }




    public function edit_project_pricing ($id){
        $projects = Project::all();
        $project_pricing = ProjectPricing::findOrFail($id);

        return view('backend.project_pricing.edit_project_pricing',compact('projects','project_pricing'));
    }



    public function update_project_pricing (Request $request){
        $request->validate([
            'project_id' => 'required',
            'pricing_type_name' => 'required',
            'pricing_ammount' => 'required',
            'pricing_features'=>'required'
        ]);


        $project_pricing =  ProjectPricing::findOrFail($request->id);
        $project_pricing->project_id = $request->project_id;
        $project_pricing->pricing_type_name= $request->pricing_type_name;
        $project_pricing->pricing_ammount = $request->pricing_ammount;
        $project_pricing->pricing_features = $request->pricing_features;
        $project_pricing->save();

        return redirect()->route('project_pricing.index')->with('message','Project Pricing updated successfully');
    }







    public function delete_project_pricing(Request $request){
        $project_pricing = ProjectPricing::where('id',$request->id)->first();

        $project_pricing->delete();

        return response()->json(['success'=>true,'message'=>'successfully project pricing deleted']);
    
    }




    public function change_project_pricing_status(Request $request){
        $slider = ProjectPricing::find($request->project_pricing_id);
        $slider->status = $request->status;
        $slider->save();

        return response()->json(['success' => true]);
    }




    public function change_ispopuler(Request $request){
        $slider = ProjectPricing::find($request->project_pricing_id);
        $slider->is_populer = $request->is_populer;
        $slider->save();

        return response()->json(['success' => true]);
    }



}
