<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Access\User\User;
use Es;

class IndexUsersToElasticsearch extends Command
{
    /**
     * {@inheritdoc}
     */
    protected $name = "es:users-index";

    /**
     * {@inheritdoc}
     */
    protected $description = "Indexes all users to elasticsearch";

    /**
     * @return void
     */
    public function fire()
    {
        // Uncomment if index needs to be created
        $indexParams = [
            'index' => 'access'
        ];

        // Es::indices()->delete($indexParams);
        if (!Es::indices()->exists($indexParams)) {
            Es::indices()->create($indexParams);
        }

        User::chunk(100, function($users) {
            foreach ($users as $user) {
                $params = [
                    'index' => 'access',
                    'type' => 'users',
                    'id' => $user->id,
                    'body' => $user->toArray()
                ];
                Es::index($params);
            }
        });

    }
}
