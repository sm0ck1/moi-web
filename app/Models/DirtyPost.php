<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirtyPost extends Model
{
    protected $fillable = [
        'title',
        'text',
        'topic',
        'url',
        'publish',
    ];
}
