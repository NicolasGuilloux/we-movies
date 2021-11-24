<?php declare(strict_types=1);

namespace App\Api\TMDB\Model;

use Symfony\Component\Validator\Constraints as Assert;

final class Video
{
    #[Assert\NotNull]
    public string $id;

    #[Assert\NotNull]
    public string $name;

    #[Assert\NotNull]
    public string $iso_639_1;

    #[Assert\NotNull]
    public string $iso_3166_1;

    #[Assert\NotNull]
    public string $key;

    #[Assert\NotNull]
    public string $site;

    #[Assert\NotNull]
    public int $size;

    #[Assert\NotNull]
    public string $type;

    #[Assert\NotNull]
    public bool $official;

    #[Assert\NotNull]
    public string $published_at;
}
