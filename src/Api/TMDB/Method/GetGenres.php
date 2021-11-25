<?php declare(strict_types=1);

namespace App\Api\TMDB\Method;

use App\Api\TMDB\ApiClient;
use App\Api\TMDB\Model\Genre;
use App\Api\TMDB\Model\GenreResponse;
use Symfony\Contracts\Service\Attribute\Required;

final class GetGenres extends AbstractMethod
{
    public const ENDPOINT = '/genre/movie/list';

    #[Required]
    public ApiClient $apiClient;

    /** @return Genre[] */
    public function __invoke(): array
    {
        if ($this->hasCache()) {
            return $this->getCache();
        }

        /** @var GenreResponse $model */
        $model = $this->apiClient->request(self::ENDPOINT, GenreResponse::class);
        $genres = $model->genres;
        $this->setCache($genres);

        return $genres;
    }
}
