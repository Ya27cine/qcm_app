<?php

namespace App\Entity;

use App\Repository\QOptionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QOptionsRepository::class)
 */
class QOptions
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
     * @ORM\Column(type="boolean")
     */
    private $is_answer;

    /**
     * @ORM\ManyToOne(targetEntity=Question::class, inversedBy="qOptions")
     */
    private $question;

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

    public function getIsAnswer(): ?bool
    {
        return $this->is_answer;
    }

    public function setIsAnswer(bool $is_answer): self
    {
        $this->is_answer = $is_answer;

        return $this;
    }

    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): self
    {
        $this->question = $question;

        return $this;
    }
}
