<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "themes")]
class ThemArt
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: MangArt::class, mappedBy: "theme")]
    private Collection $mangArts;

    public function __construct()
    {
        $this->mangArts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMangArts(): Collection
    {
        return $this->mangArts;
    }

    public function addMangArt(MangArt $mangArt): self
    {
        if (!$this->mangArts->contains($mangArt)) {
            $this->mangArts[] = $mangArt;
            $mangArt->setTheme($this);
        }

        return $this;
    }

    public function removeMangArt(MangArt $mangArt): self
    {
        if ($this->mangArts->removeElement($mangArt)) {
            if ($mangArt->getTheme() === $this) {
                $mangArt->setTheme(null);
            }
        }

        return $this;
    }
    
    public function __toString()
    {
        return $this->name ?? '';
    }
        
    
}
