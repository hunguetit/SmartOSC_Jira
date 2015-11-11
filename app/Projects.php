<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['projectCode', 'projectName', 'projectVersion', 'projectCharter', 'projectStartDate', 'projectEndDate', 'projectStatus'];


    public function taskProject()
    {
        return $this->hasMany('App\Tasks', 'project_id');

    }
}
