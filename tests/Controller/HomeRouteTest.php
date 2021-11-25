<?php declare(strict_types=1);

namespace App\Tests\Controller;

use App\Tests\Resources\TestCase\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/** @covers \App\Controller\HomeRoute */
final class HomeRouteTest extends WebTestCase
{
    public function testRoute(): void
    {
        self::$client->request('GET', '/');

        self::assertStatusCode(Response::HTTP_OK);
    }
}
