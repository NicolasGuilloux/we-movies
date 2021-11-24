<?php declare(strict_types=1);

namespace App\Controller;

use App\Api\TMDB\Model\Genre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class GenreRoute extends AbstractController
{
    #[Route('/genre/{id}', name: 'genre')]
    public function __invoke(Genre $genre): Response
    {
        return $this->render('pages/genre.html.twig', [
            'currentGenre' => $genre,
        ]);
    }
}
