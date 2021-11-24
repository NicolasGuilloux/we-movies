<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;

#[
    ORM\Entity(repositoryClass: MovieRepository::class),
    ORM\Table('movie'),
]
class Movie
{
    #[
        ORM\Id,
        ORM\GeneratedValue,
        ORM\Column(type: 'integer'),
    ]
    protected int $id;

    public function getId(): ?int
    {
        return $this->id ?? null;
    }
}
