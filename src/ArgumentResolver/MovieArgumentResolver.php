<?php declare(strict_types=1);

namespace App\ArgumentResolver;

use App\Api\TMDB\ApiClient;
use App\Api\TMDB\Model\Movie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Contracts\Service\Attribute\Required;

final class MovieArgumentResolver implements ArgumentValueResolverInterface
{
    #[Required]
    public ApiClient $tmdbApi;

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        $supportedType = $argument->getType() === Movie::class || is_subclass_of($argument->getType(), Movie::class);

        return $supportedType && $this->findMovie($request) !== null;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        yield $this->findMovie($request);
    }

    private function findMovie(Request $request): ?Movie
    {
        $movieId = (int) $request->get('id');

        return $this->tmdbApi->getMovie($movieId);
    }
}
