<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionRepository::class)
 */
class Question
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $decription;

    /**
     * @ORM\ManyToOne(targetEntity=Qcm::class, inversedBy="questions")
     */
    private $qcm;

    /**
     * @ORM\OneToMany(targetEntity=QOptions::class, mappedBy="question")
     */
    private $qOptions;

    public function __construct()
    {
        $this->qOptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDecription(): ?string
    {
        return $this->decription;
    }

    public function setDecription(string $decription): self
    {
        $this->decription = $decription;

        return $this;
    }

    public function getQcm(): ?Qcm
    {
        return $this->qcm;
    }

    public function setQcm(?Qcm $qcm): self
    {
        $this->qcm = $qcm;

        return $this;
    }

    /**
     * @return Collection|QOptions[]
     */
    public function getQOptions(): Collection
    {
        return $this->qOptions;
    }

    public function addQOption(QOptions $qOption): self
    {
        if (!$this->qOptions->contains($qOption)) {
            $this->qOptions[] = $qOption;
            $qOption->setQuestion($this);
        }

        return $this;
    }

    public function removeQOption(QOptions $qOption): self
    {
        if ($this->qOptions->removeElement($qOption)) {
            // set the owning side to null (unless already changed)
            if ($qOption->getQuestion() === $this) {
                $qOption->setQuestion(null);
            }
        }

        return $this;
    }
}
