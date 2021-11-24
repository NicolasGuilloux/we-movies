<?php declare(strict_types=1);

namespace App\Api\TMDB\Model;

use Symfony\Component\Validator\Constraints as Assert;

final class Genre
{
    #[Assert\NotNull]
    public int $id;

    #[Assert\NotBlank]
    public string $name;
}
