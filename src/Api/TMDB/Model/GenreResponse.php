<?php declare(strict_types=1);

namespace App\Api\TMDB\Model;

use Symfony\Component\Validator\Constraints as Assert;

final class GenreResponse
{
    /**
     * @var Genre[]
     *
     * @Assert\Count(min="1")
     * @Assert\All(
     *     @Assert\Type(Genre::class)
     * )
     */
    public array $genres;
}
