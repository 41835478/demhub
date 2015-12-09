<?php namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;
use Es;

class IndexArticlesToElasticsearch extends Command
{
    /**
     * {@inheritdoc}
     */
    protected $name = "app:es-index";

    /**
     * {@inheritdoc}
     */
    protected $description = "Indexes all articles to elasticsearch";

    /**
     * @return void
     */
    public function fire()
    {
        // Uncomment if index needs to be created
        $indexParams = [
            'index' => 'news'
        ];
        // Es::indices()->create($indexParams);

        $mappingProperties = [
            'index' => 'news',
            'type' => 'articles',
            'body' => [
                'articles' => [
                    '_source' => [
                        'enabled' => true
                    ],
                    'properties' => [
                        'publish_date' => [
                            'type' => 'date',
                            'format' => 'yyyy-MM-dd HH:mm:ss'
                        ]
                    ]
                ]
            ]
        ];
        Es::indices()->putMapping($mappingProperties);

        Article::chunk(100, function($articles) {
            foreach ($articles as $article) {
                dd($article->toArray());
                $params = [
                    'index' => 'news',
                    'type' => 'articles',
                    'id' => $article->id,
                    'body' => $article->toArray()
                ];
                Es::index($article);
            }
        });

    }
}
