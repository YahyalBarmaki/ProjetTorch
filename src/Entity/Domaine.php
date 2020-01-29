<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DomaineRepository")
 */
class Domaine
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Critere", mappedBy="domaine")
     */
    private $idDom;

    public function __construct()
    {
        $this->idDom = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Critere[]
     */
    public function getIdDom(): Collection
    {
        return $this->idDom;
    }

    public function addIdDom(Critere $idDom): self
    {
        if (!$this->idDom->contains($idDom)) {
            $this->idDom[] = $idDom;
            $idDom->setDomaine($this);
        }

        return $this;
    }

    public function removeIdDom(Critere $idDom): self
    {
        if ($this->idDom->contains($idDom)) {
            $this->idDom->removeElement($idDom);
            // set the owning side to null (unless already changed)
            if ($idDom->getDomaine() === $this) {
                $idDom->setDomaine(null);
            }
        }

        return $this;
    }
}
