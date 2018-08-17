<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'path', 'task_id', 'description'
    ];

    public function task()
    {
        return $this->belongsTo('App\Task', 'task_id', 'id');
    }
}
