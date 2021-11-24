<?php declare(strict_types=1);

namespace App\Api\TMDB\Model;

use Symfony\Component\Validator\Constraints as Assert;

final class Movie
{
    #[Assert\NotNull]
    public int $id;

    #[Assert\NotNull]
    public string $title;

    #[Assert\NotNull]
    public string $overview;

    public ?string $poster_path;

    #[Assert\NotNull]
    public bool $adult;

    #[Assert\NotNull]
    public string $release_date;

    /**
     * @Assert\All({
     *     @Assert\Type("integer")
     * })
     */
    public array $genre_ids;

    #[Assert\NotNull]
    public string $original_title;

    #[Assert\NotNull]
    public string $original_language;

    public ?string $backdrop_path;

    #[Assert\NotNull]
    public float $popularity;

    #[Assert\NotNull]
    public int $vote_count;

    #[Assert\NotNull]
    public float $vote_average;

    #[Assert\NotNull]
    public bool $video;
}
