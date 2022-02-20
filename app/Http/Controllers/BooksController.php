<?php

namespace App\Http\Controllers;

use App\Exceptions\APIFailureException;
use App\Models\Book;
use App\Services\IceAndFireBooksService;
use App\Transformers\BookTransformer;
use Illuminate\Support\Facades\Request;

class BooksController extends Controller
{
    private $booksAPI;

    public function __construct(IceAndFireBooksService $booksAPI)
    {
        $this->booksAPI = $booksAPI;
    }

    public function index(Request $request)
    {
        try {
            return fractal($this->booksAPI->fetchBooks(), new BookTransformer())->toArray()['data'];
        } catch (APIFailureException $e) {
            return response()->json([
                'message' => 'failed to fetch data'
            ], 500);
        }
    }
}
