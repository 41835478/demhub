<?php namespace App\Observers;

use App\Models\Access\User\User;
use Es;

class ElasticsearchUserObserver
{
    public function created(User $user)
    {
        Es::index([
            'index' => 'access',
            'type' => 'users',
            'id' => $user->id,
            'body' => $user->toArray()
        ]);
    }

    public function updated(User $user)
    {
        Es::index([
            'index' => 'access',
            'type' => 'users',
            'id' => $user->id,
            'body' => $user->toArray()
        ]);
    }

    public function deleted(User $user)
    {
        Es::delete([
            'index' => 'access',
            'type' => 'users',
            'id' => $user->id
        ]);
    }
}
