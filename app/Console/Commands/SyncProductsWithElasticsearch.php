<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ProductService;
use App\Http\Elasticsearch\ElasticsearchProduct;

class SyncProductsWithElasticsearch extends Command
{

    protected $productService;
    protected $elasticsearchProduct;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
   public function __construct(ProductService $productService , ElasticsearchProduct $elasticsearchProduct)
{
    parent::__construct();
    $this->productService = $productService;
    $this->elasticsearchProduct = $elasticsearchProduct;
}

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $products = $this->productService->index();
        foreach ($products as $product) {
            $this->elasticsearchProduct->indexProduct($product);
        }
        return 0;
    }
}
