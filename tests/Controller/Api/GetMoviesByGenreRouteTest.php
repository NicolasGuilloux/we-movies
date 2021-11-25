<?php declare(strict_types=1);

namespace App\Tests\Controller\Api;

use App\Tests\Resources\Spy\HttpClientSpy;
use App\Tests\Resources\TestCase\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @covers \App\Controller\Api\GetMoviesByGenreRoute
 * @covers \App\Api\TMDB\Method\GetMoviesByGenre
 */
final class GetMoviesByGenreRouteTest extends WebTestCase
{
    public function testRoute(): void
    {
        /** @var HttpClientSpy $spy */
        $spy = $this->getService(HttpClientSpy::class);
        $spy->stubRequestFromFile('GET', 'https://api.themoviedb.org/3/genre/movie/list', 'get_genres.json');
        $spy->stubRequestFromFile('GET', 'https://api.themoviedb.org/3/discover/movie', 'get_movies_by_genre.json');

        self::$client->request('GET', '/api/genres/28/movies');
        self::assertStatusCode(Response::HTTP_OK);

        $content = $this->getJsonResponseContent();
        self::assertArrayHasKey('results', $content);
        self::assertArrayHasKey('page', $content);
        self::assertArrayHasKey('total_results', $content);
        self::assertArrayHasKey('total_pages', $content);
    }
}
