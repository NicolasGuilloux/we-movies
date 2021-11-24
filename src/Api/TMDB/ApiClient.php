<?php declare(strict_types=1);

namespace App\Api\TMDB;

use App\Api\TMDB\Exception\ApiBadDataException;
use App\Api\TMDB\Exception\ApiRequestException;
use App\Api\TMDB\Model\DiscoverResponse;
use App\Api\TMDB\Model\Genre;
use App\Api\TMDB\Model\GenreResponse;
use App\Api\TMDB\Model\Movie;
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

    /** @return Genre[] */
    public function getGenres(): array
    {
        $response = $this->request('/genre/movie/list');
        $content = $response->getContent();
        /** @var GenreResponse $model */
        $model = $this->serializer->deserialize($content, GenreResponse::class, 'json');
        $violations = $this->validator->validate($model);

        if ($violations->count() > 0) {
            throw new ApiBadDataException($response, $violations);
        }

        return $model->genres;
    }

    /** @return Movie[] */
    public function getMoviesByGenre(Genre $genre): array
    {
        $response = $this->request('/discover/movie', ['with_genres' => $genre->id]);
        $content = $response->getContent();
        /** @var DiscoverResponse $model */
        $model = $this->serializer->deserialize($content, DiscoverResponse::class, 'json');
        $violations = $this->validator->validate($model);

        if ($violations->count() > 0) {
            throw new ApiBadDataException($response, $violations);
        }

        return $model->results;
    }

    private function request(
        string $endpoint,
        array $queryParams = []
    ): ResponseInterface {
        $request = $this->requestStack->getMainRequest();

        if ($request === null) {
            throw new \LogicException('Fail to fetch the main request.');
        }

        $url = $this->parameterBag->get('tmdb.api.url');
        $queryParams['api_key'] = $this->parameterBag->get('tmdb.api.key');
        $queryParams['language'] = $request->getLocale();

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