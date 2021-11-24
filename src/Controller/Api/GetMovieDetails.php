<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Api\TMDB\ApiClient;
use App\Api\TMDB\Model\MovieDetails;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Service\Attribute\Required;

final class GetMovieDetails extends AbstractFOSRestController
{
    #[Required]
    public ApiClient $tmdbApi;

    #[
        Route('/movies/{id}/details'),
    ]
    public function __invoke(MovieDetails $movie): Response
    {
        $data = ['details' => $movie, 'videos' => []];

        if ($movie->video) {
            $data['videos'] = $this->tmdbApi->getVideosByMovie($movie);
        }

        $view = new View($data);

        return $this->handleView($view);
    }
}
