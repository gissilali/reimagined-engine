<?php

use App\Traits\InteractsWithExceptionHandling;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class BooksTest extends TestCase
{
    use InteractsWithExceptionHandling;

    public function test_it_fetches_books()
    {
        $this->withoutExceptionHandling();
        $response = $this->get(route('books.get'));

        $response->assertResponseOk();
    }
}
