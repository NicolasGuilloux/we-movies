<?php declare(strict_types=1);

namespace App\Tests\Controller\Api;

use App\Tests\Resources\Spy\HttpClientSpy;
use App\Tests\Resources\TestCase\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @covers \App\Controller\Api\GetMovieSearchRoute
 * @covers \App\Api\TMDB\Method\GetMovieSearch
 */
final class GetMovieSearchRouteTest extends WebTestCase
{
    public function testRoute(): void
    {
        /** @var HttpClientSpy $spy */
        $spy = $this->getService(HttpClientSpy::class);
        $spy->stubRequestFromFile('GET', 'https://api.themoviedb.org/3/search/movie', 'get_movie_search.json');

        self::$client->request('GET', '/api/movies/search?query=test');
        self::assertStatusCode(Response::HTTP_OK);

        $content = $this->getJsonResponseContent();
        self::assertArrayHasKey('results', $content);
        self::assertArrayHasKey('page', $content);
        self::assertArrayHasKey('total_results', $content);
        self::assertArrayHasKey('total_pages', $content);
    }
}
