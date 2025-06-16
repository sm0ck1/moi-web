<?php

namespace App\Jobs;

use App\Models\DirtyPost;
use App\Services\GenerationPost;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class PublicationPostJob implements ShouldQueue
{
    use Queueable;

    // Количество попыток выполнения задания при возникновении ошибок
    public $tries = 3;

    // Время ожидания между повторными попытками (в секундах)
    public $backoff = 300; // 5 минут

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
