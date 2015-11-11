<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tasks;
use App\TaskUser;
use App\Projects;
use Validator;
use DB;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'taskCode' => 'required|min:3||alpha_num|unique:tasks',
            'taskName' => 'required|max:255|alpha_num',
            'taskStartDate' => 'required|date',
            'taskEndDate' => 'required|date',
            'taskContent' => 'required',
            'userTask' => 'required',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id)
    {
        $projectInfo = Projects::findOrFail($project_id);

        $teams = DB::table('teams')->get();

        $usersTask = DB::table('users')->get();

        return view('admin.task.create', ['projectInfo'=>$projectInfo, 'teams'=>$teams, 'usersTask'=>$usersTask]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $project_id)
    {
        $input = $request->all();
        $validator = $this->validator($input);

        if ($validator->fails()) {
            return redirect('admin/task/'.$project_id.'/create')
                        ->withErrors($validator);
        } else {
            $task=new Tasks;
            $task->taskCode= $request->input('taskCode');
            $task->taskName= $request->input('taskName');
            $task->taskContent= $request->input('taskContent');
            $task->taskStartDate= $request->input('taskStartDate');
            $task->taskEndDate= $request->input('taskEndDate');
            $task->project_id= $project_id;
            $task->taskStatus="0";
            $task->save();

            $usersTask = $request->input('userTask');

            foreach ($usersTask as $userTask){
                $taskUser = new TaskUser;

                $taskUser->task_id = $task->id;
                $taskUser->user_id = $userTask;
                $taskUser->save();
            }
            return redirect('admin/project/'.$project_id)
                        ->withErrors('Create Task Succeed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($project_id, $id)
    {
        $taskInfo = Tasks::findOrFail($id);
        $taskUsers = DB::table('taskUser')
                        ->join('users', 'users.id', '=', 'taskUser.user_id')
                        ->where('task_id','=', $id)->get();
        return view('admin.task.show', ['taskInfo'=>$taskInfo, 'taskUsers'=>$taskUsers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id, $id)
    {
        $task = Tasks::findOrFail($id);

        $taskUsers = DB::table('taskUser')
                        ->join('users', 'users.id', '=', 'taskUser.user_id')
                        ->where('task_id','=', $id)->get();

        $projectInfo = Projects::findOrFail($project_id);

        $teams = DB::table('teams')->get();

        $usersTask = DB::table('users')->get();
        return view('admin.task.edit', ['projectInfo' => $projectInfo, 'teams' => $teams, 'usersTask' => $usersTask, 'task' => $task, 'taskUsers'=>$taskUsers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project_id, $id)
    {
        $task = DB::table('tasks')->where('id','=', $id)->first();
        $input = $request->all();
        $validator = $this->validator($input);

        if ($validator->fails()) {
            return redirect('admin/task/'.$project_id.'/'.$task->id.'/edit')
                        ->withErrors($validator);
        } else {
            $task->taskCode= $request->input('taskCode');
            $task->taskName= $request->input('taskName');
            $task->taskContent= $request->input('taskContent');
            $task->taskStartDate= $request->input('taskStartDate');
            $task->taskEndDate= $request->input('taskEndDate');
            $task->taskStatus="0";
            DB::table('tasks')
            ->where('id','=', $id)
            ->update([
                'taskCode' => $task->taskCode, 
                'taskName' =>$task->taskName, 
                'taskContent' => $task->taskContent,
                'taskStartDate' => $task->taskStartDate,
                'taskEndDate' => $task->taskEndDate
            ]);

            $taskUsers = DB::table('taskUser')
                        ->where('task_id','=', $id)->delete();

            $usersTask = $request->input('userTask');

            foreach ($usersTask as $userTask){
                $taskUser = new TaskUser;

                $taskUser->task_id = $task->id;
                $taskUser->user_id = $userTask;
                $taskUser->save();
            }
            return redirect('admin/task/'.$project_id.'/'.$task->id)
                        ->withErrors('Edited Task Succeed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_id, $id)
    {
        $task = Tasks::findOrFail($id);
        $taskUsers = DB::table('taskUser')
                        ->where('task_id','=', $id)->delete();
        $task->delete();
        return redirect('admin/project/'.$project_id)
                    ->withErrors("DELETED Task Done");
    }
}
