<?php declare(strict_types=1);

namespace App\Controller\Api;

use App\Api\TMDB\ApiClient;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Service\Attribute\Required;

final class GetGenresRoute extends AbstractFOSRestController
{
    #[Required]
    public ApiClient $tmdbApi;

    #[Route('/genres')]
    public function __invoke(): Response
    {
        $genres = $this->tmdbApi->getGenres();
        $view = new View($genres);

        return $this->handleView($view);
    }
}
