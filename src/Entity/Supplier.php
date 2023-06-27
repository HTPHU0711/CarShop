<?php

namespace App\Entity;

use App\Repository\SupplierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SupplierRepository::class)
 */
class Supplier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isImporter;

    /**
     * @ORM\OneToMany(targetEntity=Carsup::class, mappedBy="sups", orphanRemoval=true)
     */
    private $sc;

    public function __construct()
    {
        $this->sc = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function isIsImporter(): ?bool
    {
        return $this->isImporter;
    }

    public function setIsImporter(bool $isImporter): self
    {
        $this->isImporter = $isImporter;

        return $this;
    }

    /**
     * @return Collection<int, Carsup>
     */
    public function getSc(): Collection
    {
        return $this->sc;
    }

    public function addSc(Carsup $sc): self
    {
        if (!$this->sc->contains($sc)) {
            $this->sc[] = $sc;
            $sc->setSups($this);
        }

        return $this;
    }

    public function removeSc(Carsup $sc): self
    {
        if ($this->sc->removeElement($sc)) {
            // set the owning side to null (unless already changed)
            if ($sc->getSups() === $this) {
                $sc->setSups(null);
            }
        }

        return $this;
    }
}
