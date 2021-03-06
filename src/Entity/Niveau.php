<?php

namespace App\Entity;

use App\Repository\NiveauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NiveauRepository::class)
 */
class Niveau
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveau;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordre;

    /**
     * @ORM\OneToMany(targetEntity=MatiereNiveauFiliere::class, mappedBy="niveau", orphanRemoval=true)
     */
    private $matiereNiveauFilieres;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="niveau", orphanRemoval=true)
     */
    private $etudiants;

    public function __construct()
    {
        $this->matiereNiveauFilieres = new ArrayCollection();
        $this->etudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau(): ?int
    {
        return $this->niveau;
    }

    public function setNiveau(int $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getOrdre(): ?int
    {
        return $this->ordre;
    }

    public function setOrdre(int $ordre): self
    {
        $this->ordre = $ordre;

        return $this;
    }

    /**
     * @return Collection|MatiereNiveauFiliere[]
     */
    public function getMatiereNiveauFilieres(): Collection
    {
        return $this->matiereNiveauFilieres;
    }

    public function addMatiereNiveauFiliere(MatiereNiveauFiliere $matiereNiveauFiliere): self
    {
        if (!$this->matiereNiveauFilieres->contains($matiereNiveauFiliere)) {
            $this->matiereNiveauFilieres[] = $matiereNiveauFiliere;
            $matiereNiveauFiliere->setNiveau($this);
        }

        return $this;
    }

    public function removeMatiereNiveauFiliere(MatiereNiveauFiliere $matiereNiveauFiliere): self
    {
        if ($this->matiereNiveauFilieres->removeElement($matiereNiveauFiliere)) {
            // set the owning side to null (unless already changed)
            if ($matiereNiveauFiliere->getNiveau() === $this) {
                $matiereNiveauFiliere->setNiveau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->setNiveau($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getNiveau() === $this) {
                $etudiant->setNiveau(null);
            }
        }

        return $this;
    }
}
