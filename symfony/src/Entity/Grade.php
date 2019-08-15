<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GradeRepository")
 * @ORM\Table(indexes={@ORM\Index(name="subject", columns={"subject"}),@ORM\Index(name="mark", columns={"mark"})})
 */
class Grade
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $mark;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subject;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="grades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMark(): ?float
    {
        return $this->mark;
    }

    public function setMark(float $mark): self
    {
        $this->mark = $mark;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getStudentId(): ?Student
    {
        return $this->student_id;
    }

    public function setStudentId(?Student $student_id): self
    {
        $this->student_id = $student_id;

        return $this;
    }
}
