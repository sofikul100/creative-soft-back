<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class TeamController extends Controller
{
    public function team_index(Request $request)
    {
        if ($request->ajax()) {
            $team_image_path = asset('backend/team_mumbers_images');
            $teams = DB::table('teams')->get();
            return DataTables::of($teams)
                ->addIndexColumn()
                ->editColumn('team_mumber_image', function ($row) use ($team_image_path) {
                    return '<img src="' . $team_image_path . '/' . $row->team_mumber_image . '"  height="120px" width="220px">';
                })
                ->editColumn('status', function ($row) {
                    if(Auth::user()->can('status.team')){
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
                    if(Auth::user()->can('edit.team')){
                        $actionBtn.= '<a  class="btn btn-outline-info btn-sm edit_team_mumber"   data-id="' . $row->id . '"  data-bs-toggle="modal" data-bs-target="#edit_team_mumber">Edit</a>&nbsp;';
                    }
                    if(Auth::user()->can('delete.team')){
                        $actionBtn.= '<a  class="btn btn-outline-danger btn-sm"  data-id="' . $row->id . '" onclick="deleteTeam(' . $row->id . ')">Delete</a>';
                    }
                    

                    return $actionBtn;
                })

                ->rawColumns(['action', 'team_mumber_image', 'status'])
                ->make(true);
        } else {
            $teams = Team::all();
            return view('backend.our_team.team', compact('teams'));
        }
    }



    public function add_Team_mumber(Request $request)
    {
        $request->validate([
            'team_mumber_name' => 'required',
            'team_mumber_position' => 'required|max:400',
            'team_mumber_image' => 'required|image|mimes:jpg,jpeg,png,svg'
        ]);



        $teamImage = $request->file('team_mumber_image');
        $teamImg = Image::make($teamImage);
        $originalPath = public_path() . '/backend/team_mumbers_images/';
        $teamImg->resize(300, 300);
        $imageName = time() . $teamImage->getClientOriginalName();
        $teamImg->save($originalPath . $imageName);

        $team = new Team();
        $team->team_mumber_name = $request->team_mumber_name;
        $team->team_mumber_position = $request->team_mumber_position;
        $team->facebook_link = $request->facebook_link;
        $team->instagram_link = $request->instagram_link;
        $team->linkedin_link =  $request->linkedin_link;
        $team->twitter_link  = $request->twitter_link;
        $team->team_mumber_image = $imageName;
        $team->save();

        return response()->json(['success' => true, 'message' => 'Team Mumber Added Successfully']);
    }





    public function edit_team_mumber(Request $request)
    {
        $team = DB::table('teams')->where('id', $request->id)->first();

        return response()->json([$team]);
    }




    public function update_team_mumber(Request $request)
    {
        $request->validate([
            'team_mumber_update_name' => 'required',
            'team_mumber_update_position' => 'required'
        ]);

        $team = Team::find($request->team_mumber_id);

        $old_team_mumber_image = $team->team_mumber_image;




        if ($request->team_mumber_update_image) {

            if (file_exists(public_path('backend/team_mumbers_images/' . $old_team_mumber_image))) {
                unlink(public_path('backend/team_mumbers_images/' . $old_team_mumber_image));
            }

            $teamImage = $request->team_mumber_update_image;
            $teamImg = Image::make($teamImage);
            $originalPath = public_path() . '/backend/team_mumbers_images/';
            $teamImg->resize(200, 200);
            $imageName = time() . $teamImage->getClientOriginalName();
            $teamImg->save($originalPath . $imageName);

            $team->team_mumber_image = $imageName;
            $team->team_mumber_name = $request->team_mumber_update_name;
            $team->team_mumber_position = $request->team_mumber_update_position;

            $team->facebook_link = $request->facebook_update_link;
            $team->instagram_link = $request->instagram_update_link;
            $team->linkedin_link =  $request->linkedin_update_link;
            $team->twitter_link  = $request->twitter_update_link;

            $team->save();

            return response()->json(['success' => true, 'message' => 'Successfully team mumber updated']);
        } else {
            $team->team_mumber_image = $old_team_mumber_image;
            $team->team_mumber_name = $request->team_mumber_update_name;
            $team->team_mumber_position = $request->team_mumber_update_position;
            $team->facebook_link = $request->facebook_update_link;
            $team->instagram_link = $request->instagram_update_link;
            $team->linkedin_link =  $request->linkedin_update_link;
            $team->twitter_link  = $request->twitter_update_link;

            $team->save();

            return response()->json(['success' => true, 'message' => 'Successfully team mumber updated']);
        }
    }










    public function delete_team_mumber(Request $request)
    {
        $team = Team::find($request->id);

        if (file_exists(public_path('backend/team_mumbers_images/' . $team->team_mumber_image))) {
            unlink(public_path('backend/team_mumbers_images/' . $team->team_mumber_image));
        }

        $team->delete();

        return response()->json(['success' => true, 'message' => 'Team mumber deleted successfully']);
    }




    public function change_status(Request $request)
    {
        $team = Team::find($request->team_mumber_id);
        $team->status = $request->status;
        $team->save();

        return response()->json(['success' => true]);
    }
}
