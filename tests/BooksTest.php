<?php

use App\Services\IceAndFireBooksService;
use App\Traits\InteractsWithExceptionHandling;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class BooksTest extends TestCase
{
    use InteractsWithExceptionHandling;

    /**
     * @test
     */
    public function it_can_fetch_books()
    {
        $this->withoutExceptionHandling();
        $repository = Mockery::mock(IceAndFireBooksService::class);
        $repository->shouldReceive('fetchBooks')
            ->once()
            ->andReturn(
                json_decode(file_get_contents(
                    base_path('tests/stubs/ice-and-fire-api-books-success.json')
                ))
            );

        // load the mock into the IoC container
        $this->app->instance(IceAndFireBooksService::class, $repository);

        // when making your call, your controller will use your mock
        $response = $this->get(route('books.get'));

        $response->assertResponseStatus(200);
        $response->assertJson('[
            {"isbn" : "978-0553103540"},
            {"isbn" : "978-0553108033"}
        ]');
    }
}
