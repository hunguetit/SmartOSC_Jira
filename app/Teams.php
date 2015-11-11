<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teams extends Model
{
    protected $table = 'teams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['teamName'];

    public function userTeam()
    {
        return $this->hasMany('App\User', 'team_id');

    }
}
