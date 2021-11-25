<?php declare(strict_types=1);

namespace App\Tests\Resources\Spy;

use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\ResponseStreamInterface;

final class HttpClientSpy implements HttpClientInterface
{
    /** @var array<string, array> */
    public array $requestStubQueue = [];

    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        $key = $method . ' ' . $url;
        $stack = $this->requestStubQueue[$key] ?? [];
        $responseData = array_shift($stack) ?? [];

        $mockResponse = new MockResponse(
            $responseData['content'] ?? '',
            [
                'http_code' => $responseData['status'] ?? 200,
                'headers' => $responseData['headers'] ?? [],
            ]
        );
        $mockClient = new MockHttpClient($mockResponse);

        return $mockClient->request($method, $url, $options);
    }

    public function stream($responses, float $timeout = null): ResponseStreamInterface
    {
        throw new \LogicException('Not implemented');
    }

    public function withOptions(array $options): void
    {
    }

    public function stubRequest(
        string $method,
        string $url,
        ?string $content = '',
        int $status = 200,
        array $headers = []
    ): void {
        $key = $method . ' ' . $url;
        $this->requestStubQueue[$key] = $this->requestStubQueue[$key] ?? [];
        $this->requestStubQueue[$key][] = [
            'content' => $content,
            'status'  => $status,
            'headers' => $headers,
        ];
    }

    public function stubJsonRequest(
        string $method,
        string $url,
        ?array $data = [],
        int $status = 200,
        array $headers = []
    ): void {
        $content = json_encode($data, JSON_THROW_ON_ERROR);

        $this->stubRequest($method, $url, $content, $status, $headers);
    }

    public function stubRequestFromFile(
        string $method,
        string $url,
        string $file,
        int $status = 200,
        array $headers = []
    ): void {
        $path = __DIR__ . '/../Files/TMDB/' . $file;
        $content = file_get_contents($path);

        $this->stubRequest($method, $url, $content, $status, $headers);
    }
}
