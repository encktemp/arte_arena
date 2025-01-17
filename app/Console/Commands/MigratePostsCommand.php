<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\Item;

class MigratePostsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate posts from JSONPlaceholder API to the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching posts from API...');

        // Check if data exists in Redis cache
        $posts = Cache::remember('posts', 86400, function () {
            $response = Http::get('https://jsonplaceholder.typicode.com/posts');
            
            if ($response->failed()) {
                $this->error('Failed to fetch posts from API.');
                return [];
            }
            
            return $response->json();
        });

        if (empty($posts)) {
            $this->info('No posts found or API failed.');
            return Command::FAILURE;
        }

        $this->info('Saving posts to the database...');
        $processedCount = 0;

        foreach ($posts as $post) {
            Item::updateOrCreate(
                ['id' => $post['id']], // Match based on the 'id' field
                [
                    'title' => $post['title'],
                    'body' => $post['body'],
                ]
            );

            $processedCount++;
        }

        $this->info("Successfully processed {$processedCount} posts.");
        return Command::SUCCESS;
    }
}
