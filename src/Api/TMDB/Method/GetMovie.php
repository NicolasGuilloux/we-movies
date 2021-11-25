<?php declare(strict_types=1);

namespace App\Api\TMDB\Method;

use App\Api\TMDB\ApiClient;
use App\Api\TMDB\Exception\ApiRequestException;
use App\Api\TMDB\Model\MovieDetails;
use Symfony\Contracts\Service\Attribute\Required;

final class GetMovie extends AbstractMethod
{
    public const ENDPOINT = '/movie/%d';

    #[Required]
    public ApiClient $apiClient;

    public function __invoke(int $genreId): ?MovieDetails
    {
        if ($this->hasCache($genreId)) {
            return $this->getCache($genreId);
        }

        $model = $this->getMovieDetails($genreId);
        $this->setCache($model, $genreId);

        return $model;
    }

    private function getMovieDetails(int $genreId): ?MovieDetails
    {
        try {
            /** @var MovieDetails|null $model */
            $model = $this->apiClient->request(
                sprintf(self::ENDPOINT, $genreId),
                MovieDetails::class
            );

            return $model;
        } catch (ApiRequestException $e) {
            return null;
        }
    }
}
