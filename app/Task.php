<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'project_id', 'title', 'description', 'status_id', 'master_id', 'performer_id'
    ];

    public function master()
    {
        return $this->belongsTo('App\User', 'master_id', 'id');
    }

    public function performer()
    {
        return $this->belongsTo('App\User', 'performer_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\Status', 'status_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'task_id')
            ->orderBy('created_at', 'desc');
    }

    public function files()
    {
        return $this->hasMany('App\File', 'task_id');
    }
}
