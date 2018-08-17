<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'status_id', 'master_id'
    ];

    public function master()
    {
        return $this->belongsTo('App\User', 'master_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\Status', 'status_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany('App\Task', 'project_id');
    }
}
