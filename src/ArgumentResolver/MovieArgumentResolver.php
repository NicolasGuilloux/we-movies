<?php declare(strict_types=1);

namespace App\ArgumentResolver;

use App\Api\TMDB\Method\GetMovie;
use App\Api\TMDB\Model\Movie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Contracts\Service\Attribute\Required;

final class MovieArgumentResolver implements ArgumentValueResolverInterface
{
    #[Required]
    public GetMovie $getMovie;

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return $argument->getType() === Movie::class || is_subclass_of($argument->getType(), Movie::class);
    }

    public function resolve(Request $request, ArgumentMetadata $argument): \Generator
    {
        $value = $this->findMovie($request);

        if ($value === null && !$argument->isNullable()) {
            throw new NotFoundHttpException();
        }

        yield $value;
    }

    private function findMovie(Request $request): ?Movie
    {
        $movieId = (int) $request->get('id');

        return ($this->getMovie)($movieId);
    }
}
