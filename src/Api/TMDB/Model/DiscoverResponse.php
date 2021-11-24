<?php declare(strict_types=1);

namespace App\Api\TMDB\Model;

use Symfony\Component\Validator\Constraints as Assert;

final class DiscoverResponse
{
    /**
     * @var Movie[]
     *
     * @Assert\NotNull()
     * @Assert\Count(min="1")
     * @Assert\All({
     *     @Assert\Type(Movie::class)
     * })
     */
    public array $results;

    #[Assert\NotNull]
    public int $page;

    #[Assert\NotNull]
    public int $total_results;

    #[Assert\NotNull]
    public int $total_pages;
}
