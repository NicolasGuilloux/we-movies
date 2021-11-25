<?php declare(strict_types=1);

namespace App\Tests\Controller;

use App\Tests\Resources\Spy\HttpClientSpy;
use App\Tests\Resources\TestCase\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * @covers \App\ArgumentResolver\GenreArgumentResolver
 * @covers \App\Controller\GenreRoute
 */
final class GenreRouteTest extends WebTestCase
{
    public function testRoute(): void
    {
        /** @var HttpClientSpy $spy */
        $spy = $this->getService(HttpClientSpy::class);
        $spy->stubRequestFromFile('GET', 'https://api.themoviedb.org/3/genre/movie/list', 'get_genres.json');

        self::$client->request('GET', '/genre/28');

        self::assertStatusCode(Response::HTTP_OK);
    }

    public function testRouteNotFound(): void
    {
        /** @var HttpClientSpy $spy */
        $spy = $this->getService(HttpClientSpy::class);
        $spy->stubRequestFromFile('GET', 'https://api.themoviedb.org/3/genre/movie/list', 'get_genres.json');

        self::$client->request('GET', '/genre/21');

        self::assertStatusCode(Response::HTTP_NOT_FOUND);
    }
}
