<?php

namespace App\Console\Commands;

use App\Services\GenerationPost;
use Illuminate\Console\Command;

class PublicationPostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:post';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate new post from DB';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Publication post');
        $result = (new GenerationPost())->setPosts();
        $this->info($result ? 'Success' : 'Error');

    }
}
