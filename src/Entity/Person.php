<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PersonRepository")
 */
class Person
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Movie", mappedBy="producer")
     */
    private $producer_movies;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Movie", inversedBy="actors")
     */
    private $actors_movie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gender;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $biography;

    public function __construct()
    {
        $this->producer_movies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Movie[]
     */
    public function getMovies(): Collection
    {
        return $this->movies;
    }

    public function addMovie(Movie $movie): self
    {
        if (!$this->movies->contains($movie)) {
            $this->movies[] = $movie;
            $movie->setProducer($this);
        }

        return $this;
    }

    public function removeMovie(Movie $movie): self
    {
        if ($this->movies->contains($movie)) {
            $this->movies->removeElement($movie);
            // set the owning side to null (unless already changed)
            if ($movie->getProducer() === $this) {
                $movie->setProducer(null);
            }
        }

        return $this;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setMovie(?Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }

    /**
     * @return Collection|Movie[]
     */
    public function getProducerMovies(): Collection
    {
        return $this->producer_movies;
    }

    public function addProducerMovie(Movie $producerMovie): self
    {
        if (!$this->producer_movies->contains($producerMovie)) {
            $this->producer_movies[] = $producerMovie;
            $producerMovie->setProducer($this);
        }

        return $this;
    }

    public function removeProducerMovie(Movie $producerMovie): self
    {
        if ($this->producer_movies->contains($producerMovie)) {
            $this->producer_movies->removeElement($producerMovie);
            // set the owning side to null (unless already changed)
            if ($producerMovie->getProducer() === $this) {
                $producerMovie->setProducer(null);
            }
        }

        return $this;
    }

    public function getActorsMovie(): ?Movie
    {
        return $this->actors_movie;
    }

    public function setActorsMovie(?Movie $actors_movie): self
    {
        $this->actors_movie = $actors_movie;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }
}
