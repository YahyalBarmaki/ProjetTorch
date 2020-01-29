<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CritereRepository")
 */
class Critere
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
     * @ORM\Column(type="boolean")
     */
    private $type_value;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Personne", mappedBy="idPers")
     */
    private $personnes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ValCritere", mappedBy="critere")
     */
    private $idCritere;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Domaine", inversedBy="idDom")
     */
    private $domaine;

    public function __construct()
    {
        $this->personnes = new ArrayCollection();
        $this->idCritere = new ArrayCollection();
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

    public function getTypeValue(): ?bool
    {
        return $this->type_value;
    }

    public function setTypeValue(bool $type_value): self
    {
        $this->type_value = $type_value;

        return $this;
    }

    /**
     * @return Collection|Personne[]
     */
    public function getPersonnes(): Collection
    {
        return $this->personnes;
    }

    public function addPersonne(Personne $personne): self
    {
        if (!$this->personnes->contains($personne)) {
            $this->personnes[] = $personne;
            $personne->addIdPer($this);
        }

        return $this;
    }

    public function removePersonne(Personne $personne): self
    {
        if ($this->personnes->contains($personne)) {
            $this->personnes->removeElement($personne);
            $personne->removeIdPer($this);
        }

        return $this;
    }

    /**
     * @return Collection|ValCritere[]
     */
    public function getIdCritere(): Collection
    {
        return $this->idCritere;
    }

    public function addIdCritere(ValCritere $idCritere): self
    {
        if (!$this->idCritere->contains($idCritere)) {
            $this->idCritere[] = $idCritere;
            $idCritere->setCritere($this);
        }

        return $this;
    }

    public function removeIdCritere(ValCritere $idCritere): self
    {
        if ($this->idCritere->contains($idCritere)) {
            $this->idCritere->removeElement($idCritere);
            // set the owning side to null (unless already changed)
            if ($idCritere->getCritere() === $this) {
                $idCritere->setCritere(null);
            }
        }

        return $this;
    }

    public function getDomaine(): ?Domaine
    {
        return $this->domaine;
    }

    public function setDomaine(?Domaine $domaine): self
    {
        $this->domaine = $domaine;

        return $this;
    }
}
