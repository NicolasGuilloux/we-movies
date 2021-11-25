<?php declare(strict_types=1);

namespace App\Tests\Controller\Api;

use App\Tests\Resources\Spy\HttpClientSpy;
use App\Tests\Resources\TestCase\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @covers \App\Controller\Api\GetMovieDetailsRoute
 * @covers \App\Api\TMDB\Method\GetMovie
 * @covers \App\Api\TMDB\Method\GetVideosByMovie
 */
final class GetMovieDetailsRouteTest extends WebTestCase
{
    public function testRoute(): void
    {
        /** @var HttpClientSpy $spy */
        $spy = $this->getService(HttpClientSpy::class);
        $spy->stubRequestFromFile('GET', 'https://api.themoviedb.org/3/movie/20', 'get_movie.json');

        self::$client->request('GET', '/api/movies/20/details');
        self::assertStatusCode(Response::HTTP_OK);

        $content = $this->getJsonResponseContent();
        self::assertArrayHasKey('details', $content);
        self::assertArrayHasKey('videos', $content);
    }
}
