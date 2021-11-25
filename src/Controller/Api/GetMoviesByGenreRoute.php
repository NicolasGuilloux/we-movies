<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Api\TMDB\Method\GetMoviesByGenre;
use App\Api\TMDB\Model\Genre;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Service\Attribute\Required;

final class GetMoviesByGenreRoute extends AbstractFOSRestController
{
    #[Required]
    public GetMoviesByGenre $getMoviesByGenre;

    #[
        Route('/genres/{id}/movies'),
    ]
    public function __invoke(Genre $genre, Request $request): Response
    {
        $page = (int) $request->query->get('page', 1);
        $movies = ($this->getMoviesByGenre)($genre, $page);
        $view = new View($movies);

        return $this->handleView($view);
    }
}
