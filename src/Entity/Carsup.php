<?php

namespace App\Entity;

use App\Repository\CarsupRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarsupRepository::class)
 */
class Carsup
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Car::class, inversedBy="cs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cars;

    /**
     * @ORM\ManyToOne(targetEntity=Supplier::class, inversedBy="sc")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sups;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCars(): ?Car
    {
        return $this->cars;
    }

    public function setCars(?Car $cars): self
    {
        $this->cars = $cars;

        return $this;
    }

    public function getSups(): ?Supplier
    {
        return $this->sups;
    }

    public function setSups(?Supplier $sups): self
    {
        $this->sups = $sups;

        return $this;
    }

}
