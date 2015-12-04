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
        $models = Article::all();

        foreach ($models as $model)
        {
            Es::index([
                'index' => 'news',
                'type' => 'articles',
                'id' => $model->id,
                'body' => $model->toArray()
            ]);
        }
    }
}
