<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Api\TMDB\Method\GetMovieSearch as TmdbGetMovieSearch;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Service\Attribute\Required;

final class GetMovieSearchRoute extends AbstractFOSRestController
{
    #[Required]
    public TmdbGetMovieSearch $getMovieSearch;

    #[Route('/movies/search')]
    public function __invoke(Request $request): Response
    {
        $query = $request->query->get('query', '');
        $data = ($this->getMovieSearch)($query);
        $view = new View($data);

        return $this->handleView($view);
    }
}
