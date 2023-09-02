<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class ProjectController extends Controller
{
    public function project_index(Request $request)
    {
        if ($request->ajax()) {
            $project_image_path = asset('backend/project_images');
            $projects = DB::table('projects')->get();
            return DataTables::of($projects)
                ->addIndexColumn()
                ->editColumn('project_image', function ($row) use ($project_image_path) {
                    return '<img src="' . $project_image_path . '/' . $row->project_image . '"  height="120px" width="220px">';
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                      if(Auth::user()->can('edit.project')){
                        $actionBtn .= '<a  class="btn btn-outline-info btn-sm edit_project"   data-id="' . $row->id . '"  data-bs-toggle="modal" data-bs-target="#edit-project">Edit</a>';
                      }
                     
                      if(Auth::user()->can('delete.project')){
                        $actionBtn .= '<a  class="btn btn-outline-danger btn-sm"  data-id="' . $row->id . '" onclick="deleteProject(' . $row->id . ')">Delete</a>';
                      }
                      
                    return $actionBtn;
                })

                ->rawColumns(['action', 'project_image','status'])
                ->make(true);
        } else {
            $projects = Project::all();
            return view('backend.projects.project', compact('projects'));
        }
    }



    public function add_project(Request $request)
    {
        $request->validate([
            'project_title' => 'required',
            'project_description' => 'required|max:400',
            'project_image' => 'required|image|mimes:jpg,jpeg,png,svg'
        ]);



        $projectImage = $request->file('project_image');
        $projectImg = Image::make($projectImage);
        $originalPath = public_path() . '/backend/project_images/';
        $projectImg->resize(200, 200);
        $imageName = time() . $projectImage->getClientOriginalName();
        $projectImg->save($originalPath . $imageName);

        $project = new Project();
        $project->project_title = $request->project_title;
        $project->project_description = $request->project_description;
        $project->project_image = $imageName;
        $project->save();

        return response()->json(['success' => true, 'message' => 'Project Added Successfully']);
    }





    public function edit_project(Request $request)
    {
        $project = DB::table('projects')->where('id', $request->id)->first();

        return response()->json([$project]);
    }




    public function update_project(Request $request)
    {
        $request->validate([
            'project_update_title' => 'required',
            'project_update_description' => 'required'
        ]);

        $project = Project::find($request->project_id);

        $old_project_imgae = $project->project_image;




        if ($request->project_update_image) {

            if (file_exists(public_path('backend/project_images/' . $old_project_imgae))) {
                unlink(public_path('backend/project_images/' . $old_project_imgae));
            }

            $projectImage = $request->project_update_image;
            $projectImg = Image::make($projectImage);
            $originalPath = public_path() . '/backend/project_images/';
            $projectImg->resize(200, 200);
            $imageName = time() . $projectImage->getClientOriginalName();
            $projectImg->save($originalPath . $imageName);

            $project->project_image = $imageName;
            $project->project_title = $request->project_update_title;
            $project->project_description = $request->project_update_description;

            $project->save();

            return response()->json(['success' => true, 'message' => 'Successfully project updated']);
        } else {
            $project->project_image = $old_project_imgae;
            $project->project_title = $request->project_update_title;
            $project->project_description = $request->project_update_description;

            $project->save();

            return response()->json(['success' => true, 'message' => 'Successfully project updated']);
        }
    }










    public function delete_project(Request $request)
    {
        $project = Project::find($request->id);

        if (file_exists(public_path('backend/project_images/' . $project->project_image))) {
            unlink(public_path('backend/project_images/' . $project->project_image));
        }

        $project->delete();

        return response()->json(['success' => true, 'message' => 'project deleted successfully']);
    }




    public function change_project_status (Request $request){
        $project = Project::find($request->project_id);
        $project->status = $request->status;
        $project->save();
  
        return response()->json(['success'=>true]);
    }




}
