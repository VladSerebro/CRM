<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'task_id', 'text', 'author_id'
    ];

    protected function task()
    {
        return $this->belongsTo('App\Task', 'task_id', 'id');
    }

    protected function author()
    {
        return $this->belongsTo('App\User', 'author_id', 'id');
    }
}
