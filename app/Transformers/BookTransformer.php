<?php

namespace App\Transformers;

use App\Models\Book;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class BookTransformer extends TransformerAbstract
{
    public function transform($book)
    {
        return [
            'isbn' => $book->isbn,
            'name' => $book->name,
            'authors' => $book->authors,
            'character_count' => count($book->characters),
            'publisher' => $book->publisher,
            'release_date' => Carbon::parse($book->released)
        ];
    }

}
