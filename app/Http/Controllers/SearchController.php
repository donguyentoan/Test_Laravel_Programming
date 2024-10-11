<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $client = app('elasticsearch');
        $params = [
                'index' => 'products',
                'body'  => [
                    'query' => [
                        'multi_match' => [
                            'query' => $request->input('query'),
                            'fields' => ['model', 'name'],
                        ],
                    ],
                ],
            ];
        $response = $client->search($params);
        $products = collect($response['hits']['hits'])->map(function ($hit) {
        return (object) [
            'id' => $hit['_id'],
            'source' => $hit['_source'] 
        ];
        });
            return view('customer.result.searchResult', compact('products'));
    }

}


