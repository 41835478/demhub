<?php namespace App\Observers;

use Riari\Forum\Models\Thread;
use Es;
use Riari\Forum\Models\Post;

class ElasticsearchDiscussionObserver
{
    public function created(Thread $thread)
    {
        Es::index([
            'index' => 'discussions',
            'type' => 'threads',
            'id' => $thread->id,
            'body' => $thread['attributes']//alternative to $thread->toArray()
        ]);
    }

    public function updated(Thread $thread)
    {
        Es::index([
            'index' => 'discussions',
            'type' => 'threads',
            'id' => $thread->id,
            'body' => $thread['attributes']//alternative to $thread->toArray()
        ]);
    }

    public function deleted(Thread $thread)
    {
        Es::delete([
            'index' => 'discussions',
            'type' => 'threads',
            'id' => $thread->id
        ]);
    }
}
