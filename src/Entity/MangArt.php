<?php

namespace App\Entity;

use App\Repository\MangArtRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ThemArt;

#[ORM\Entity(repositoryClass: MangArtRepository::class)]
class MangArt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageFile = null;

    #[ORM\ManyToOne(targetEntity: ThemArt::class)]
    #[ORM\JoinColumn(name: "theme_id", referencedColumnName: "id")]
    private ?ThemArt $theme = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $calqMangart = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImageFile(): ?string
    {
        return $this->imageFile;
    }

    public function setImageFile(?string $imageFile): self
    {
        $this->imageFile = $imageFile;

        return $this;
    }

    public function getTheme(): ?ThemArt
    {
        return $this->theme;
    }

    public function setTheme(?ThemArt $theme): self
    {
        $this->theme = $theme;

        return $this;
    }

    public function getCalqMangart(): ?string
    {
        return $this->calqMangart;
    }

    public function setCalqMangart(?string $calqMangart): static
    {
        $this->calqMangart = $calqMangart;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
