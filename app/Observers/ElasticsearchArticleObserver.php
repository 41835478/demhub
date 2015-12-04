<?php namespace App\Observers;

use App\Models\Article;
use Es;

class ElasticsearchArticleObserver
{
    public function created(Article $article)
    {
        Es::index([
            'index' => 'news',
            'type' => 'articles',
            'id' => $article->id,
            'body' => $article->toArray() // call to add all fields
            // 'body' => [ // call to add specific fields
            //   'title' => $article->title,
            //   'excerpt' => $article->excerpt,
            //   'keywords' => $article->keywords
            // ]
        ]);
    }

    public function updated(Article $article)
    {
        Es::index([
            'index' => 'news',
            'type' => 'articles',
            'id' => $article->id,
            'body' => $article->toArray() // call to add all fields
            // 'body' => [ // call to add specific fields
            //   'title' => $article->title,
            //   'excerpt' => $article->excerpt,
            //   'keywords' => $article->keywords
            // ]
        ]);
    }

    public function deleted(Article $article)
    {
        Es::delete([
            'index' => 'news',
            'type' => 'articles',
            'id' => $article->id
        ]);
    }
}
