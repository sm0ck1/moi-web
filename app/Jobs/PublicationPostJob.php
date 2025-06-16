<?php

namespace App\Jobs;

use App\Models\DirtyPost;
use App\Services\GenerationPost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PublicationPostJob implements ShouldQueue
{
    use Queueable;

    private DirtyPost $dirtyPost;

    /**
     * Create a new job instance.
     */
    public function __construct($dirtyPost)
    {
        $this->dirtyPost = $dirtyPost;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        (new GenerationPost())->setPosts($this->dirtyPost);
    }
}
