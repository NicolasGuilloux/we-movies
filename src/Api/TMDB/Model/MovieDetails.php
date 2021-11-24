<?php declare(strict_types=1);

namespace App\Api\TMDB\Model;

use Symfony\Component\Validator\Constraints as Assert;

final class MovieDetails extends Movie
{
    #[Assert\NotNull]
    public int $budget;

    #[Assert\NotNull]
    public array $genres;

    #[Assert\NotNull]
    public array $production_companies;

    #[Assert\NotNull]
    public array $production_countries;

    #[Assert\NotNull]
    public int $revenue;

    #[Assert\NotNull]
    public array $spoken_languages;

    #[Assert\NotNull]
    public string $status;

    public ?int $runtime;
    public ?string $tagline;
    public ?string $homepage;
    public ?string $imdb_id;
    public ?array $belongs_to_collection;
}
