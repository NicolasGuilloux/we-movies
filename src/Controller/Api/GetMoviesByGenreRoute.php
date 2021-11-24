<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Api\TMDB\ApiClient;
use App\Api\TMDB\Model\Genre;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Service\Attribute\Required;

final class GetMoviesByGenreRoute extends AbstractFOSRestController
{
    #[Required]
    public ApiClient $tmdbApi;

    #[
        Route('/genres/{id}/movies'),
    ]
    public function __invoke(Genre $genre): Response
    {
        $movies = $this->tmdbApi->getMoviesByGenre($genre);
        $view = new View($movies);

        return $this->handleView($view);
    }
}
