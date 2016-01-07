<?php namespace App\Providers;

use App\Observers\ElasticsearchArticleObserver;
use App\Observers\ElasticsearchDiscussionObserver;
use App\Observers\ElasticsearchInfoResourceObserver;
use App\Observers\ElasticsearchPublicationObserver;
use App\Observers\ElasticsearchUserObserver;
use App\Models\Article;
use Riari\Forum\Models\Thread;
use App\Models\InfoResource;
use App\Models\Publication;
use App\Models\Access\User\User;
use Illuminate\Support\ServiceProvider;

class ObserversServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Article::observe($this->app->make(ElasticsearchArticleObserver::class));
        Thread::observe($this->app->make(ElasticsearchDiscussionObserver::class));
        InfoResource::observe($this->app->make(ElasticsearchInfoResourceObserver::class));
        Publication::observe($this->app->make(ElasticsearchPublicationObserver::class));
        User::observe($this->app->make(ElasticsearchUserObserver::class));
    }

    public function register()
    {
        $this->app->bindShared(ElasticsearchArticleObserver::class, function()
        {
            return new ElasticsearchArticleObserver();
        });
        $this->app->bindShared(ElasticsearchDiscussionObserver::class, function()
        {
            return new ElasticsearchDiscussionObserver();
        });
        $this->app->bindShared(ElasticsearchInfoResourceObserver::class, function()
        {
            return new ElasticsearchInfoResourceObserver();
        });
        $this->app->bindShared(ElasticsearchPublicationObserver::class, function()
        {
            return new ElasticsearchPublicationObserver();
        });
        $this->app->bindShared(ElasticsearchUserObserver::class, function()
        {
            return new ElasticsearchUserObserver();
        });
    }
}
