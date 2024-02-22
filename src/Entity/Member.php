<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;




#[ORM\Entity(repositoryClass: MemberRepository::class)]
class Member extends User
{
    //protected ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $biography = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): static
    {
        $this->biography = $biography;

        return $this;
    }
}
