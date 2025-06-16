<?php

namespace App\Models;

use App\Jobs\PublicationPostJob;
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

    protected static function booted()
    {
        static::created(function (DirtyPost $dirtyPost) {
            PublicationPostJob::dispatch($dirtyPost);
        });
    }
}
