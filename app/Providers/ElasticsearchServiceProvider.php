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
                ->setHosts([env('ELASTICSEARCH_HOST')]) // Sử dụng env để lấy giá trị từ .env
                ->build();
        });
    }
}
