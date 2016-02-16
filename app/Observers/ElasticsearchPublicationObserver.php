<?php namespace App\Observers;

use App\Models\Publication;
use Es;

class ElasticsearchPublicationObserver
{
    public function created(Publication $publication)
    {
        Es::index([
            'index' => 'info',
            'type' => 'publications',
            'id' => $publication->id,
            'body' => $publication->toArray()
        ]);
    }

    public function updated(Publication $publication)
    {
        Es::index([
            'index' => 'info',
            'type' => 'publications',
            'id' => $publication->id,
            'body' => $publication->toArray()
        ]);
    }

    public function deleted(Publication $publication)
    {
        Es::delete([
            'index' => 'info',
            'type' => 'publications',
            'id' => $publication->id
        ]);
    }
}
