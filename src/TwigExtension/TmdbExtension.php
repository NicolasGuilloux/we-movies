<?php declare(strict_types=1);

namespace App\TwigExtension;

use App\Api\TMDB\Model\Movie;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\Service\Attribute\Required;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

final class TmdbExtension extends AbstractExtension
{
    #[Required]
    public ParameterBagInterface $parameterBag;

    /** @return TwigFilter[] */
    public function getFilters(): array
    {
        return [
            new TwigFilter('tmdbMovieUrl', [$this, 'getMovieUrl']),
            new TwigFilter('tmdbImage', [$this, 'getImageUrl']),
        ];
    }

    public function getMovieUrl(Movie $movie): string
    {
        $baseUrl = $this->parameterBag->get('tmdb.url');

        return sprintf(
            '%s/movie/%d',
            trim($baseUrl, '/'),
            $movie->id
        );
    }

    public function getImageUrl(string $path, int $size = 500): string
    {
        $baseUrl = $this->parameterBag->get('tmdb.image.url');

        return sprintf(
            '%s/t/p/w%d/%s',
            trim($baseUrl, '/'),
            $size,
            trim($path, '/')
        );
    }
}
