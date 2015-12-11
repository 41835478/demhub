<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Publication;
use Es;

class IndexPublicationsToElasticsearch extends Command
{
    /**
     * {@inheritdoc}
     */
    protected $name = "es:publication-index";

    /**
     * {@inheritdoc}
     */
    protected $description = "Indexes all publications to elasticsearch";

    /**
     * @return void
     */
    public function fire()
    {
        // Uncomment if index needs to be created
        $indexParams = [
            'index' => 'info'
        ];
        Es::indices()->delete($indexParams);
        Es::indices()->create($indexParams);

        User::chunk(100, function($publications) {
            foreach ($publications as $publication) {
                $params = [
                    'index' => 'info',
                    'type' => 'publications',
                    'id' => $publication->id,
                    'body' => $publication->toArray()
                ];
                Es::index($params);
            }
        });

    }
}
