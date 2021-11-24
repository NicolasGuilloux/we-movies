<?php declare(strict_types=1);

namespace App\Controller;

use App\Api\TMDB\ApiClient;
use App\Api\TMDB\Model\Genre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Service\Attribute\Required;

final class GenreRoute extends AbstractController
{
    #[Required]
    public ApiClient $tmdbApi;

    #[Route('/genre/{id}', name: 'genre')]
    public function __invoke(Genre $genre): Response
    {
        $movies = $this->tmdbApi->getMoviesByGenre($genre);

        return $this->render('pages/genre.html.twig', [
            'currentGenre' => $genre,
            'movies'       => $movies,
        ]);
    }
}
