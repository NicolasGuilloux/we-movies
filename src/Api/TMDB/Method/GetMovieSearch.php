<?php declare(strict_types=1);

namespace App\Api\TMDB\Method;

use App\Api\TMDB\ApiClient;
use App\Api\TMDB\Model\DiscoverResponse;
use Symfony\Contracts\Service\Attribute\Required;

final class GetMovieSearch extends AbstractMethod
{
    public const ENDPOINT = '/search/movie';

    #[Required]
    public ApiClient $apiClient;

    public function __invoke(string $query): DiscoverResponse
    {
        if ($this->hasCache($query)) {
            return $this->getCache($query);
        }

        /** @var DiscoverResponse $model */
        $model = $this->apiClient->request(
            self::ENDPOINT,
            DiscoverResponse::class,
            ['query' => $query]
        );

        $this->setCache($model, $query);

        return $model;
    }
}
