<?php namespace App\Providers;

use App\Observers\ElasticsearchArticleObserver;
use App\Models\Article;
use Illuminate\Support\ServiceProvider;

class ObserversServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Article::observe($this->app->make(ElasticsearchArticleObserver::class));
    }

    public function register()
    {
        $this->app->bindShared(ElasticsearchArticleObserver::class, function()
        {
            return new ElasticsearchArticleObserver();
        });
    }
}
