<?php declare(strict_types=1);

namespace App\ArgumentResolver;

use App\Api\TMDB\Method\GetGenres;
use App\Api\TMDB\Model\Genre;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Contracts\Service\Attribute\Required;

final class GenreArgumentResolver implements ArgumentValueResolverInterface
{
    #[Required]
    public GetGenres $getGenres;

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === Genre::class;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        $value = $this->findGenre($request);

        if ($value === null && !$argument->isNullable()) {
            throw new NotFoundHttpException();
        }

        yield $value;
    }

    private function findGenre(Request $request): ?Genre
    {
        $genreId = (int) $request->get('id');
        $genres = ($this->getGenres)();

        foreach ($genres as $genre) {
            if ($genre->id === $genreId) {
                return $genre;
            }
        }

        return null;
    }
}
