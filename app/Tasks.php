<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['taskName', 'taskContent', 'taskStartDate', 'taskEndDate', 'project_id', 'taskStatus'];

    public function projectTask()
    {
        return $this->belongsTo('App\Projects');
    }
}
