<?php declare(strict_types=1);

namespace App\ArgumentResolver;

use App\Api\TMDB\ApiClient;
use App\Api\TMDB\Model\Genre;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Contracts\Service\Attribute\Required;

final class GenreArgumentResolver implements ArgumentValueResolverInterface
{
    #[Required]
    public ApiClient $tmdbApi;

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === Genre::class && $this->findGenre($request) !== null;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        yield $this->findGenre($request);
    }

    private function findGenre(Request $request): ?Genre
    {
        $genreId = (int) $request->get('id');
        $genres = $this->tmdbApi->getGenres();

        foreach ($genres as $genre) {
            if ($genre->id === $genreId) {
                return $genre;
            }
        }

        return null;
    }
}
