<?php declare(strict_types=1);

namespace App\Api\TMDB;

use App\Api\TMDB\Exception\ApiBadDataException;
use App\Api\TMDB\Exception\ApiRequestException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\Service\Attribute\Required;

final class ApiClient
{
    #[Required]
    public HttpClientInterface $client;

    #[Required]
    public ParameterBagInterface $parameterBag;

    #[Required]
    public RequestStack $requestStack;

    #[Required]
    public SerializerInterface $serializer;

    #[Required]
    public ValidatorInterface $validator;

    public function request(string $endpoint, string $expectedClass, array $queryParams = []): object
    {
        $response = $this->executeRequest($endpoint, $queryParams);
        $content = $response->getContent();
        $model = $this->serializer->deserialize($content, $expectedClass, 'json');
        $violations = $this->validator->validate($model);

        if ($violations->count() > 0) {
            throw new ApiBadDataException($response, $violations);
        }

        return $model;
    }

    private function executeRequest(
        string $endpoint,
        array $queryParams = []
    ): ResponseInterface {
        $request = $this->requestStack->getMainRequest();
        $url = $this->parameterBag->get('tmdb.api.url');
        $queryParams['api_key'] = $this->parameterBag->get('tmdb.api.key');
        $queryParams['language'] = $request?->getLocale() ?? $this->parameterBag->get('kernel.default_locale');

        $response = $this->client->request(
            'GET',
            trim($url, '/') . $endpoint,
            [
                'query' => $queryParams,
            ]
        );

        if ($response->getStatusCode() !== Response::HTTP_OK) {
            throw new ApiRequestException($response);
        }

        return $response;
    }
}
