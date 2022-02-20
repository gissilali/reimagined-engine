<?php

namespace App\Http\Controllers;

use App\Exceptions\APIFailureException;
use App\Services\IceAndFireBooksAPI;
use Illuminate\Support\Facades\Request;

class BooksController extends Controller
{
    private $booksAPI;

    public function __construct(IceAndFireBooksAPI $booksAPI)
    {
        $this->booksAPI = $booksAPI;
    }

    public function index(Request $request)
    {
        try {
            $this->booksAPI->fetchBooks();
        } catch (APIFailureException $e) {
            return response()->json([
                'message' => 'failed to fetch data'
            ], 500);
        }
        return [];
    }
}
