<?php declare(strict_types=1);

namespace App\TwigExtension;

use App\Api\TMDB\ApiClient;
use Symfony\Contracts\Service\Attribute\Required;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class GenreTwigExtension extends AbstractExtension
{
    #[Required]
    public ApiClient $tmdbApi;

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getGenres', [$this->tmdbApi, 'getGenres']),
        ];
    }
}
