<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'team' => 'required',
            'avatar' => 'required|max: 100000',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')
                        ->join('teams', 'teams.id', '=', 'users.team_id')
                        ->select('users.*', 'teams.teamName')
                        ->get();
        $teams = DB::table('teams')
                        ->get();
        return view('admin.user.list', ['users' => $users, 'teams'=>$teams]);
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
        $input = $request->all();
        $validator = $this->validator($input);

        if ($validator->fails()) {
            return redirect('admin/user')
                        ->withErrors($validator);
        } else {
            $user=new User;
            $user->name= $request->input('name');
            $user->username= $request->input('username');
            $user->email= $request->input('email');
            $user->password= bcrypt($request->input('password'));
            $user->team_id= $request->input('team');

            $imageName = '';
            $image = $request->file('avatar');
            if($image){
                global $imageName;
                $rand=rand(1,10000);
                $imageName = $rand . '.'. $request->input('username') . '.' .  $image->getClientOriginalExtension();
                $image->move(base_path() . '/public/avatar', $imageName);

                $user->avatar = 'avatar/'. $imageName;
            }
            $user->role="user";
            $user->key_active = "sgngjregjekgneknvgisudnvjkdn";
            $user->save();
            return redirect('admin/user/'.$user->id)
                        ->withErrors('Create User Succeed');
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
        $user = DB::table('users')
                        ->join('teams', 'teams.id', '=', 'users.team_id')
                        ->where('users.id', '=', $id)
                        ->first();
        $teams = DB::table('teams')->get();

        $userTasks = User::findOrFail($id)->userTask()->get();
        $userTasksId = array();
        foreach ($userTasks as $userTask) {
            $userTasksId[] = $userTask->task_id;
        }
        $tasks = DB::table('tasks')
                    ->join('projects', 'projects.id', '=', 'tasks.project_id')
                    ->whereIn('tasks.id', $userTasksId)
                    ->select('tasks.*', 'projects.projectCode')
                    ->paginate(2);
        return view('admin.user.show', ['user'=>$user,'teams'=>$teams, 'tasks'=>$tasks]);
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
        $user = DB::table('users')->where('id','=', $id)->first();
        $input = $request->all();
        $validator = $this->validator($input);

        if ($validator->fails()) {
            return redirect('admin/user')
                        ->withErrors($validator);
        } else {

            $user->name= $request->input('name');
            $user->username= $request->input('username');
            $user->email= $request->input('email');
            $user->team_id= $request->input('team');

            $imageName = '';
            $image = $request->file('avatar');
            if($image){
                File::delete(base_path() . '/public/'.$user->avatar);

                global $imageName;
                $rand=rand(1,10000);
                $imageName = $rand . '.'. $request->input('username') . '.' .  $image->getClientOriginalExtension();
                $image->move(base_path() . '/public/avatar', $imageName);

                $user->avatar = 'avatar/'. $imageName;
            }
            DB::table('users')
            ->where('id','=', $id)
            ->update([
                'name' => $user->name, 
                'username' => $user->username, 
                'email' => $user->email,
                'team_id' => $user->team_id,
                'avatar' => $user->avatar
            ]);
            return redirect('admin/user/'.$user->id)
                        ->withErrors('Edited User Succeed');
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
        $user = User::findOrFail($id);
        $userTasks = User::findOrFail($id)->userTask()->count();
        if ($userTasks>0){
            return redirect('admin/user')
                        ->withErrors("Sorry. You can't DELETE this user. You must DELETE all task of user");
        } else {
            File::delete(base_path() . '/public/'.$user->avatar);
            $user->delete();
        return redirect('admin/list')
                    ->withErrors("DELETED Project Done");
        }
    }
}
