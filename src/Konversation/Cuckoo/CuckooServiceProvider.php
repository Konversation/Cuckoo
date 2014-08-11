<?php
namespace Konversation\Cuckoo;

use Illuminate\Support\ServiceProvider;

use Konversation\Cuckoo\Entity;

class CuckooServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->package('konversation/cuckoo');

        $this->app->register('Cviebrock\\EloquentSluggable\\SluggableServiceProvider');

        $config     = $this->app->make('config');

        $boardModel = $config->get('cuckoo::model.board', Entity::DEFAULT_BOARD_MODEL);
        $topicModel = $config->get('cuckoo::model.topic', Entity::DEFAULT_TOPIC_MODEL);
        $postModel  = $config->get('cuckoo::model.post', Entity::DEFAULT_POST_MODEL);

        $this->app->singleton('cuckoo.board', function () use ($boardModel) {
            return new $boardModel();
        });

        $this->app->singleton('cuckoo.topic', function () use ($topicModel) {
            return new $topicModel();
        });

        $this->app->singleton('cuckoo.post', function () use ($postModel) {
            return new $postModel();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'cuckoo.board',
            'cuckoo.topic',
            'cuckoo.post',
        ];
    }
}

