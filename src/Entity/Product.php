<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Column;

#[Entity]
#[Table(name: 'product')]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Column(type: 'integer')]
    private ?int $id = null;

    #[Column(type: 'string', length: 255)]
    private ?string $name = null;

    #[Column(type: 'text')]
    private ?string $description = null;

    #[Column(type: 'float')]
    private ?float $price = null;

    public function getId(): ?int
    {
        return $this->id;
    }

}
