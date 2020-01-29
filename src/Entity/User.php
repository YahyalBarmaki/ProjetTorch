<?php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Campagne", mappedBy="user")
     */
    private $idUser;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\AccountType", cascade={"persist", "remove"})
     */
    private $idUsr;

    public function __construct()
    {
        parent::__construct();
        $this->idUser = new ArrayCollection();
        // your own logic
    }

    /**
     * @return Collection|Campagne[]
     */
    public function getIdUser(): Collection
    {
        return $this->idUser;
    }

    public function addIdUser(Campagne $idUser): self
    {
        if (!$this->idUser->contains($idUser)) {
            $this->idUser[] = $idUser;
            $idUser->setUser($this);
        }

        return $this;
    }

    public function removeIdUser(Campagne $idUser): self
    {
        if ($this->idUser->contains($idUser)) {
            $this->idUser->removeElement($idUser);
            // set the owning side to null (unless already changed)
            if ($idUser->getUser() === $this) {
                $idUser->setUser(null);
            }
        }

        return $this;
    }

    public function getIdUsr(): ?AccountType
    {
        return $this->idUsr;
    }

    public function setIdUsr(?AccountType $idUsr): self
    {
        $this->idUsr = $idUsr;

        return $this;
    }
}