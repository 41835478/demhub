<?php namespace App\Observers;

use App\Models\InfoResource;
use Es;

class ElasticsearchInfoResourceObserver
{
    public function created(InfoResource $resource)
    {
        Es::index([
            'index' => 'info',
            'type' => 'resource',
            'id' => $resource->id,
            'body' => $resource->toArray()
        ]);
    }

    public function updated(InfoResource $resource)
    {
        Es::index([
            'index' => 'info',
            'type' => 'resource',
            'id' => $resource->id,
            'body' => $resource->toArray()
        ]);
    }

    public function deleted(InfoResource $resource)
    {
        Es::delete([
            'index' => 'info',
            'type' => 'resource',
            'id' => $resource->id
        ]);
    }
}
