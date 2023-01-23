<?php

namespace App\Entity;

use App\Repository\AgenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgenceRepository::class)]
class Agence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $Agence = null;

    #[ORM\OneToMany(mappedBy: 'agence', targetEntity: Employe::class, orphanRemoval: true)]
    private Collection $employes;

    #[ORM\ManyToMany(targetEntity: Logement::class, mappedBy: 'agences')]
    private Collection $logements;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $filename = null;

    public function __construct()
    {
        $this->employes = new ArrayCollection();
        $this->logements = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getAgence();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAgence(): ?string
    {
        return $this->Agence;
    }

    public function setAgence(string $Agence): self
    {
        $this->Agence = $Agence;

        return $this;
    }

    /**
     * @return Collection<int, Employe>
     */
    public function getEmployes(): Collection
    {
        return $this->employes;
    }

    public function addEmploye(Employe $employe): self
    {
        if (!$this->employes->contains($employe)) {
            $this->employes->add($employe);
            $employe->setAgence($this);
        }

        return $this;
    }

    public function removeEmploye(Employe $employe): self
    {
        if ($this->employes->removeElement($employe)) {
            // set the owning side to null (unless already changed)
            if ($employe->getAgence() === $this) {
                $employe->setAgence(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Logement>
     */
    public function getLogements(): Collection
    {
        return $this->logements;
    }

    public function addLogement(Logement $logement): self
    {
        if (!$this->logements->contains($logement)) {
            $this->logements->add($logement);
            $logement->addAgence($this);
        }

        return $this;
    }

    public function removeLogement(Logement $logement): self
    {
        if ($this->logements->removeElement($logement)) {
            $logement->removeAgence($this);
        }

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }
}
