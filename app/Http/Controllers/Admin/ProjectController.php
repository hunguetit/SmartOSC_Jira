<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Projects;
use App\Tasks;
use App\Teams;
use App\User;
use Validator;
use DB;
use File;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'projectCode' => 'required|min:3||alpha_num|unique:projects',
            'projectName' => 'required|max:255|alpha_num',
            'projectVersion' => 'required|numeric',
            'projectStartDate' => 'required|date',
            'projectEndDate' => 'required|date',
            'projectCharter' => 'max: 100000|mimes: doc,docx',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = DB::table('projects')->paginate(2);
        return view('admin.project.list', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = $this->validator($input);

        if ($validator->fails()) {
            return redirect('admin/project/create')
                        ->withErrors($validator);
        } else {
            $project=new Projects;
            $project->projectCode= $request->input('projectCode');
            $project->projectName= $request->input('projectName');
            $project->projectVersion= $request->input('projectVersion');
            $project->projectStartDate= $request->input('projectStartDate');
            $project->projectEndDate= $request->input('projectEndDate');

            $fileName = '';
            $file = $request->file('projectCharter');
            if($file){
                global $fileName;
                $rand=rand(1,10000);
                $fileName = $rand . '.'. $request->input('projectCode') . '_Charter.' .  $file->getClientOriginalExtension();
                $file->move(base_path() . '/public/projectCharter', $fileName);

                $project->projectCharter = 'projectCharter/'. $fileName;
            }
            $project->projectStatus="0";
            $project->save();
            return redirect('admin/project/'.$project->id)
                        ->withErrors('Create Projects Succeed');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projectInfo = Projects::findOrFail($id);

        $tasksProject = Projects::findOrFail($id)->taskProject()->paginate(2);
        $projectUsers = DB::table('projects')
                        ->join('tasks', 'projects.id', '=', 'tasks.project_id')
                        ->join('taskUser', 'tasks.id', '=', 'taskUser.task_id')
                        ->join('users', 'taskUser.user_id', '=', 'users.id')
                        ->where('projects.id', '=', $id)
                        ->select('taskUser.user_id', 'users.id')
                        ->get();

        $userProjects = array();
        foreach ($projectUsers as $projectUser) {
            $userProjects[] = $projectUser->id;
        }
        $userProjects= array_unique($userProjects);
        

        $users = DB::table('users')
                    ->whereIn('id', $userProjects)
                    ->get();
        $teams = DB::table('teams')->get();

        $usersTask = DB::table('users')->get();

        return view('admin.project.show', ['teams' => $teams,'usersTask' => $usersTask,'projectInfo' => $projectInfo,'users' => $users ,'tasksProject' => $tasksProject]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Projects::findOrFail($id);
        return view('admin.project.edit', ['project' => $project]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = DB::table('projects')->where('id','=', $id)->first();

        $input = $request->all();
        $validator = $this->validator($input);

        if ($validator->fails()) {
            return redirect('admin/project/'.$project->id.'/edit')
                        ->withErrors($validator);
        } else {
            $project->projectCode= $request->input('projectCode');
            $project->projectName= $request->input('projectName');
            $project->projectVersion= $request->input('projectVersion');
            $project->projectStartDate= $request->input('projectStartDate');
            $project->projectEndDate= $request->input('projectEndDate');

            $fileName = '';
            $file = $request->file('projectCharter');
            if($file){
                File::delete(base_path() . '/public/'.$project->projectCharter);

                global $fileName;
                $rand=rand(1,10000);
                $fileName = $rand . '.'. $request->input('projectCode') . '_Charter.' .  $file->getClientOriginalExtension();
                $file->move(base_path() . '/public/projectCharter', $fileName);

                $project->projectCharter = 'projectCharter/'. $fileName;
            }
            $project->projectStatus="0";
            DB::table('projects')
            ->where('id','=', $id)
            ->update([
                'projectCode' => $project->projectCode, 
                'projectName' =>$project->projectName, 
                'projectVersion' => $project->projectVersion,
                'projectStartDate' => $project->projectStartDate,
                'projectEndDate' => $project->projectEndDate,
                'projectCharter' => $project->projectCharter,
                'projectStatus' => $project->projectStatus
            ]);            
            return redirect('admin/project/'.$project->id)
                        ->withErrors('Edited Projects Succeed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Projects::findOrFail($id);

        $projectTask = Projects::findOrFail($id)->taskProject()->count();
        if ($projectTask>0){
            return redirect('admin/project')
                        ->withErrors("Sorry. You can't DELETE this project. You must DELETE all task of project");
        } else {
            File::delete(base_path() . '/public/'.$project->projectCharter);
            $project->delete();
        return redirect('admin/project')
                    ->withErrors("DELETED Project Done");
        }
    }
}
