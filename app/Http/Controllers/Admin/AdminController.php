<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Validator;
use App\Projects;
use App\Tasks;
use App\Teams;
use App\User;
use App\TaskUser;
use DB;

class AdminController extends Controller
{
    protected function percentProjectDone($project_id){
        $tasksProject = DB::table('tasks')
                            ->select('tasks.taskStatus')
                            ->where('tasks.project_id', '=', $project_id)
                            ->get();
        $tasks = array();
        foreach($tasksProject as $taskProject){
            if ($taskProject->taskStatus == '1'){
                $tasks[] = $taskProject->taskStatus;          
            }
        }

        $percent = count($tasks)/count($tasksProject);

        return round($percent*100);
    }
    protected function checkStatus($project_id){
        $tasksProject = DB::table('tasks')
                            ->select('tasks.taskStatus')
                            ->where('tasks.project_id', '=', $project_id)
                            ->get();
        $tasks = array();
        foreach($tasksProject as $taskProject){
            if ($taskProject->taskStatus == '1'){
                $tasks[] = $taskProject->taskStatus;          
            }
        }

        if (count($tasks) == count($tasksProject)){
            DB::table('projects')
                ->where('id','=', $project_id)
                ->update([
                    'projectStatus' => '1'
                ]);
        }
        return true;
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectsCount = DB::table('projects')->count();
        $tasksCount = DB::table('tasks')->count();
        
        $users = DB::table('users')->count();
        $projectsId = DB::table('projects')
                            ->select('projects.id')
                            ->get();
        $projects_id = array();
        foreach ($projectsId as $projectId) {
            $projects_id[] = $projectId->id;
        }
        $percents = array();
        foreach ($projects_id as $project_id) {
            $this->checkStatus($project_id);
            $project = DB::table('projects')
                            ->select('projects.projectCode')
                            ->where('projects.id', '=', $project_id)
                            ->first();
            $tasks = DB::table('tasks')
                            ->where('tasks.project_id', '=', $project_id)
                            ->count();
            $taskDone = DB::table('tasks')
                            ->where('tasks.project_id', '=', $project_id)
                            ->where('tasks.taskStatus', '=', 1)
                            ->count();
            $percents[] = array(
                            'percent' => $this->percentProjectDone($project_id),
                            'project_code' => $project->projectCode,
                            'tasks' => $tasks,
                            'taskDone' => $taskDone,
                            'project_id' => $project_id
                        );
        }
        return view('admin.project.index', ['percents'=>$percents, 'projectsCount'=>$projectsCount, 'tasksCount'=>$tasksCount, 'users'=>$users]);
    }

    public function create()
    {
        return view('admin.project.create');
    }

    public function store()
    {
        if(Request::ajax()){
            $inputData = Request::get('form#createProject');
            parse_str($inputData, $formFields);

            $projectData = array(
              'code'      => $formFields['projectCode'],
              'name'     =>  $formFields['projectName'],
              'version'  =>  $formFields['projectVersion'],
              'startDate' =>  $formFields['projectStartDate'],
              'endDate' =>  $formFields['projectEndDate'],
            );
            $rules = array(
                'code' => 'required|min:3|alpha_num',
                'name' => 'required|min:3',
                'version' => 'required|min:1',
                'startDate' => 'required|date',
                'endDate' => 'required|date',
            );
            $validator = Validator::make($projectData,$rules);
            
            if($validator->fails()){
                return Response::json(array(
                    'fail' => true,
                    'errors' => withErrors($validator),
                ));
            } else {
                Projects::create($projectData);
                
                $response = array(
                    'status' => 'success',
                    'msg' => 'Setting created successfully',
                );
                return Response::json( $response );
            }
        }   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function teamUser()
    {
        // $teamUser = Teams::findOrFail(4)->userTeam()->get();
        // dd($teamUser);

        // $taskProject = Projects::findOrFail(1)->taskProject()->get();
        // dd($taskProject);

        // $userTask = User::findOrFail(2)->userTask()->get();
        // dd($userTask);

        $taskUsers = DB::table('taskUser')
                        ->join('users', 'users.id', '=', 'taskUser.user_id')
                        ->where('task_id','=', 1)->get();
        dd($taskUsers);
    }

    public function task()
    {
        return view('admin.project.task');
    }
}
