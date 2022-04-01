<?php

namespace App\Console\Commands\Post;

use App\Models\Post;
use Illuminate\Console\Command;

class DeleteRejectedPostsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kidblog:delete-rejected-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete posts that have been rejected.';

    /**
     * Execute the console command.
     *
     * @return string
     */
    public function handle()
    {
        $delete = Post::where('visibility', 'Rejected')
            ->get()
            ->each(function ($post) {
                $post->delete();
            });

        if (!$delete) {
            return $this->error('Posts could not be deleted. Please, try again!');
        }

        return $this->info('All rejected posts have been successfully deleted!');
    }
}
