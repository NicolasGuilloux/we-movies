<?php declare(strict_types=1);

namespace App\Tests\Controller\Api;

use App\Tests\Resources\Spy\HttpClientSpy;
use App\Tests\Resources\TestCase\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @covers \App\Controller\Api\GetGenresRoute
 * @covers \App\Api\TMDB\Method\GetGenres
 */
final class GetGenresRouteTest extends WebTestCase
{
    public function testRoute(): void
    {
        /** @var HttpClientSpy $spy */
        $spy = $this->getService(HttpClientSpy::class);
        $spy->stubRequestFromFile('GET', 'https://api.themoviedb.org/3/genre/movie/list', 'get_genres.json');

        self::$client->request('GET', '/api/genres');
        self::assertStatusCode(Response::HTTP_OK);

        $content = $this->getJsonResponseContent();
        self::assertCount(19, $content);
    }
}
