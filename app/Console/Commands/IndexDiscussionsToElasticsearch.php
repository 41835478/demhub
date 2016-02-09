<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use Riari\Forum\Models\Thread;
use Es;

class IndexDiscussionsToElasticsearch extends Command
{
    /**
     * {@inheritdoc}
     */
    protected $name = "es:discussions-index";

    /**
     * {@inheritdoc}
     */
    protected $description = "Indexes all discussions (threads) to elasticsearch";

    /**
     * @return void
     */
    public function fire()
    {
        // Uncomment if index needs to be created
        $indexParams = [
            'index' => 'discussions'
        ];

        if (!Es::indices()->exists($indexParams)) {
            Es::indices()->create($indexParams);
        }
        else {
            Es::indices()->delete($indexParams);
            Es::indices()->create($indexParams);
        }

        $mappingProperties = [
            'index' => 'discussions',
            'type' => 'threads',
            'body' => [
                'threads' => [
                    '_source' => [
                        'enabled' => true
                    ],
                    'properties' => [
                        // 'publish_date' => [
                        //     'type' => 'date',
                        //     'format' => 'yyyy-MM-dd HH:mm:ss'
                        // ],
                        'updated_at' => [
                            'type' => 'date',
                            'format' => 'yyyy-MM-dd HH:mm:ss'
                        ]
                    ]
                ]
            ]
        ];
        Es::indices()->putMapping($mappingProperties);

        Thread::chunk(100, function($threads) {
            foreach ($threads as $thread) {
                $params = [
                    'index' => 'discussions',
                    'type' => 'threads',
                    'id' => $thread->id,
                    'body' => $thread['attributes']//alternative to $thread->toArray()
                ];
                Es::index($params);
            }
        });

    }

}
