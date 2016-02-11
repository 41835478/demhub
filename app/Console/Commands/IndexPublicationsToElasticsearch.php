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

        if (!Es::indices()->exists($indexParams)) {
            Es::indices()->create($indexParams);
        }
        // else {
        //     Es::indices()->delete($indexParams);
        //     Es::indices()->create($indexParams);
        // }

        $mappingProperties = [
            'index' => 'info',
            'type' => 'publications',
            'body' => [
                'publications' => [
                    '_source' => [
                        'enabled' => true
                    ],
                    'properties' => [
                        'publish_date' => [
                            'type' => 'date',
                            'format' => 'yyyy-MM-dd HH:mm:ss'
                        ],
                        'created_at' => [
                            'type' => 'date',
                            'format' => 'yyyy-MM-dd HH:mm:ss'
                        ],
                        'updated_at' => [
                            'type' => 'date',
                            'format' => 'yyyy-MM-dd HH:mm:ss'
                        ]
                    ]
                ]
            ]
        ];
        Es::indices()->putMapping($mappingProperties);

        Publication::chunk(100, function($publications) {
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
