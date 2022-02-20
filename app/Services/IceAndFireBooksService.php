<?php

namespace App\Services;

use App\Exceptions\APIFailureException;
use Illuminate\Support\Facades\Http;

class IceAndFireBooksService
{
    const API_BASE_URL = 'https://www.anapioficeandfire.com/api';

    public static function fetchBooks(): array
    {
        $response = Http::get(self::API_BASE_URL . '/books?pageSize=50');
        if ($response->successful()) {
            return $response->object();
        } else {
            throw new APIFailureException("api failed", 0);
        }
    }
}