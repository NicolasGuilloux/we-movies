<?php declare(strict_types=1);

namespace App\Api\TMDB\Method;

use App\Api\TMDB\ApiClient;
use App\Api\TMDB\Model\DiscoverResponse;
use App\Api\TMDB\Model\Movie;
use App\Api\TMDB\Model\Video;
use App\Api\TMDB\Model\VideosResponse;
use Symfony\Contracts\Service\Attribute\Required;

final class GetVideosByMovie extends AbstractMethod
{
    public const ENDPOINT = '/movie/%d/videos';

    #[Required]
    public ApiClient $apiClient;

    /** @return Video[] */
    public function __invoke(Movie $movie): array
    {
        if ($this->hasCache($movie)) {
            return $this->getCache($movie);
        }

        /** @var DiscoverResponse $model */
        $model = $this->apiClient->request(
            sprintf(self::ENDPOINT, $movie->id),
            VideosResponse::class
        );
        $this->setCache($model, $movie);

        return $model->results;
    }
}
