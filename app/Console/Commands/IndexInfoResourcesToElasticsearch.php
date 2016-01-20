<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\InfoResource;
use Es;

class IndexInfoResourcesToElasticsearch extends Command
{
    /**
     * {@inheritdoc}
     */
    protected $name = "es:resources-index";

    /**
     * {@inheritdoc}
     */
    protected $description = "Indexes all information resources to elasticsearch";

    /**
     * @return void
     */
    public function fire()
    {
        // Uncomment if index needs to be created
        $indexParams = [
            'index' => 'info'
        ];

        if (!Es::indices()->exists($indexParams)) {
            Es::indices()->create($indexParams);
        }
        else {
            Es::indices()->delete($indexParams);
            Es::indices()->create($indexParams);
        }

        InfoResource::chunk(100, function($resources) {
            foreach ($resources as $resource) {
                $params = [
                    'index' => 'info',
                    'type' => 'resources',
                    'id' => $resource->id,
                    'body' => $resource->toArray()
                ];
                Es::index($params);
            }
        });

    }
}
