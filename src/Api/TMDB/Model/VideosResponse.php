<?php declare(strict_types=1);

namespace App\Api\TMDB\Model;

use Symfony\Component\Validator\Constraints as Assert;

final class VideosResponse
{
    /**
     * @var Video[]
     *
     * @Assert\NotNull()
     * @Assert\All({
     *     @Assert\Type(Video::class)
     * })
     */
    public array $results;
}
