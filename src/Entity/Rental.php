<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rental
 *
 * @ORM\Table(name="rental", indexes={@ORM\Index(name="rental_FK_user", columns={"id_user"}), @ORM\Index(name="rental_FK_copiesMovies", columns={"id_copie_movie"}), @ORM\Index(name="rental_FK_user", columns={"id_user"})})
 * @ORM\Entity
 */

class Rental
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
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */   
    private $idUser; 

    /**
     * @var \Copiesmovies
     *
     * @ORM\ManyToOne(targetEntity="Copiesmovies")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_copie_movie", referencedColumnName="id")
     * })
     */
    private $idCopieMovie;

    /**
     * @var \State
     *
     * @ORM\ManyToOne(targetEntity="State")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_state", referencedColumnName="id")
     * })
     */
    private $idState;

    /**
     * @ORM\Column(type="datetime")
     */
    private $rentalAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $returnAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getIdCopieMovie(): ?CopiesMovies
    {
        return $this->idCopieMovie;
    }

    public function setIdCopieMovie(?CopiesMovies $idCopieMovie): self
    {
        $this->idCopieMovie = $idCopieMovie;

        return $this;
    }

    public function getIdState(): ?State
    {
        return $this->idState;
    }

    public function setIdState(?State $idState): self
    {
        $this->idState = $idState;

        return $this;
    }

    public function getRentalAt(): ?\DateTimeInterface
    {
        return $this->rentalAt;
    }

    public function setRentalAt(\DateTimeInterface $rentalAt): self
    {
        $this->rentalAt = $rentalAt;

        return $this;
    }

    public function getReturnAt(): ?\DateTimeInterface
    {
        return $this->returnAt;
    }

    public function setReturnAt(?\DateTimeInterface $returnAt): self
    {
        $this->returnAt = $returnAt;

        return $this;
    }

    

}
