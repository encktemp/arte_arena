<?php

namespace App\Jobs;

use App\Models\Item;
use App\Models\SyncLog;
use Illuminate\Support\Facades\Http;

class SyncPostsJob extends Job
{
    public function handle()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');

        if ($response->failed()) {
            logger('Failed to fetch posts from API.');
            return;
        }

        $posts = $response->json();
        $processedCount = 0;

        foreach ($posts as $post) {
            Item::updateOrCreate(
                ['id' => $post['id']],
                [
                    'title' => $post['title'],
                    'body' => $post['body'],
                ]
            );
            $processedCount++;
        }

        SyncLog::create([
            'processed_at' => now(),
            'records_processed' => $processedCount,
        ]);

        logger("Successfully processed {$processedCount} posts.");
    }
}
