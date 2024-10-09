<?php

namespace App\Providers;



use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;


class ElasticsearchServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('elasticsearch', function ($app) {
            return ClientBuilder::create()
                ->setHosts(['http://89.233.104.235:9200']) 
                ->build();
        });
    }
}
