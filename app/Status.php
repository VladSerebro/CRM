<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function tasks()
    {
        return $this->hasMany('App\Task', 'status_id');
    }

    public function projects()
    {
        return $this->hasMany('App\Project', 'status_id');
    }
}
