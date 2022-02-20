<?php

namespace App\Services;

use App\Exceptions\APIFailureException;
use GuzzleHttp\HandlerStack;
use Illuminate\Support\Facades\Http;
use Kevinrob\GuzzleCache\CacheMiddleware;

class IceAndFireBooksService
{
    const API_BASE_URL = 'https://www.anapioficeandfire.com/api';

    public static function fetchBooks(): array
    {
        $response = Http::withOptions(self::getCacheOptions())->get(self::API_BASE_URL . '/books?pageSize=50');
        if ($response->successful()) {
            return $response->object();
        } else {
            throw new APIFailureException("api failed", 0);
        }
    }

    private static function getCacheOptions(): array
    {
        $stack = HandlerStack::create();

        $stack->push(new CacheMiddleware(), 'cache');

        return ['handler' => $stack];
    }
}
