<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Tasks;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $userTasks = User::findOrFail($user_id)->userTask()->get();
        $userTasksId = array();
        foreach ($userTasks as $userTask) {
            $userTasksId[] = $userTask->task_id;
        }
        $tasks = DB::table('tasks')
                    ->join('projects', 'projects.id', '=', 'tasks.project_id')
                    ->whereIn('tasks.id', $userTasksId)
                    ->select('tasks.*', 'projects.projectCode')
                    ->paginate(2);
        return view('user.pages.task', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id, $id)
    {
        $task = DB::table('tasks')
                    ->join('projects', 'projects.id', '=', 'tasks.project_id')
                    ->where('tasks.id', $id)
                    ->select('tasks.*', 'projects.projectCode')
                    ->first();
        return view('user.pages.showTask', ['task'=>$task]);
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
    public function update(Request $request, $user_id, $id)
    {
        $shipped = $request->input('shipped');
        if ($shipped == 'on'){
            DB::table('tasks')
                ->where('id','=', $id)
                ->update(['tasks.taskStatus' => 1]);
            return redirect('user/task/'.$user_id);
        } else {
            return redirect('user/task/'.$user_id);
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
        //
    }

    public function project($user_id, $projectCode)
    {
        $project = DB::table('projects')
                    ->where('projects.projectCode', $projectCode)
                    ->first();
        return view('user.pages.project', ['project'=>$project]);
    }
}
