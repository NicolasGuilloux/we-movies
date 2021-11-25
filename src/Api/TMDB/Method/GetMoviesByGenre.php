<?php declare(strict_types=1);

namespace App\Api\TMDB\Method;

use App\Api\TMDB\ApiClient;
use App\Api\TMDB\Model\DiscoverResponse;
use App\Api\TMDB\Model\Genre;
use Symfony\Contracts\Service\Attribute\Required;

final class GetMoviesByGenre extends AbstractMethod
{
    public const ENDPOINT = '/discover/movie';

    #[Required]
    public ApiClient $apiClient;

    public function __invoke(Genre $genre, ?int $page = null): DiscoverResponse
    {
        if ($this->hasCache($genre, $page)) {
            return $this->getCache($genre, $page);
        }

        /** @var DiscoverResponse $model */
        $model = $this->apiClient->request(
            self::ENDPOINT,
            DiscoverResponse::class,
            ['with_genres' => $genre->id, 'page' => $page]
        );

        return $model;
    }
}
