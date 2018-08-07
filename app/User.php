<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function createdTasks()
    {
        return $this->hasMany('App\Task', 'master_id');
    }

    public function assignedTasks()
    {
        return $this->hasMany('App\Task', 'performer_id');
    }

    public function createdProjects()
    {
        return $this->hasMany('App\Project', 'master_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment','author_id');
    }
}
