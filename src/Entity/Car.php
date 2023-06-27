<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarRepository::class)
 */
class Car
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
    private $make;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    /**
     * @ORM\Column(type="bigint")
     */
    private $travelledDistance;

    /**
     * @ORM\OneToMany(targetEntity=Carsup::class, mappedBy="cars", orphanRemoval=true)
     */
    private $cs;

    public function __construct()
    {
        $this->cs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMake(): ?string
    {
        return $this->make;
    }

    public function setMake(string $make): self
    {
        $this->make = $make;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getTravelledDistance(): ?string
    {
        return $this->travelledDistance;
    }

    public function setTravelledDistance(string $travelledDistance): self
    {
        $this->travelledDistance = $travelledDistance;

        return $this;
    }

    /**
     * @return Collection<int, Carsup>
     */
    public function getCs(): Collection
    {
        return $this->cs;
    }

    public function addC(Carsup $c): self
    {
        if (!$this->cs->contains($c)) {
            $this->cs[] = $c;
            $c->setCars($this);
        }

        return $this;
    }

    public function removeC(Carsup $c): self
    {
        if ($this->cs->removeElement($c)) {
            // set the owning side to null (unless already changed)
            if ($c->getCars() === $this) {
                $c->setCars(null);
            }
        }

        return $this;
    }

    public function getName():?string{
        return $this->getMake() . '-' . $this->getModel();
    }
}
