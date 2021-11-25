<?php declare(strict_types=1);

namespace App\Tests\Resources\TestCase;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;

abstract class WebTestCase extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{
    protected static ?KernelBrowser $client = null;

    protected function setUp(): void
    {
        parent::setUp();
        
        self::$client = self::createClient();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        self::$client = null;
    }

    protected function getService(string $id): object
    {
        return self::$client->getContainer()->get($id);
    }

    protected function getJsonResponseContent(): array
    {
        $response = self::$client->getResponse();

        return json_decode($response->getContent() ?? '{}', true, 512, JSON_THROW_ON_ERROR);
    }

    protected static function assertStatusCode(int $httpCode): void
    {
        $response = self::$client->getResponse();

        self::assertSame($httpCode, $response->getStatusCode());
    }
}
