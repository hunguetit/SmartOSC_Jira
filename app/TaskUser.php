<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskUser extends Model
{
    protected $table = 'taskUser';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['task_id', 'user_id'];


    public function taskUser()
    {
        return $this->belongsToMany('App\User', 'user_id');
    }
}
