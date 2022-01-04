<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Copiesmovies
 *
 * @ORM\Table(name="copiesMovies")
 * @ORM\Entity
 */
class Copiesmovies
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ref", type="string", length=100, nullable=false, unique=true)
     */
    private $ref;

    /**
     * @var \Movies
     *
     * @ORM\ManyToOne(targetEntity="Movies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_movie", referencedColumnName="id")
     * })
     */
    private $idMovie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getIdMovie(): ?Movies
    {
        return $this->idMovie;
    }

    public function setIdMovie(?Movies $idMovie): self
    {
        $this->idMovie = $idMovie;

        return $this;
    }


}
