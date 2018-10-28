<?php

namespace MS\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Course
 *
 * @ORM\Table(name="course")
 * @ORM\Entity(repositoryClass="MS\PlatformBundle\Repository\CourseRepository")
 */
class Course
{
    public function __construct()
    {
        $this->dateStart = new \Datetime();
        $this->dateEnd = new \Datetime('+1 year');
        $this->subjects = new ArrayCollection();
        $this->students = new ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateStart", type="date")
     * @Assert\DateTime()
     */
    private $dateStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnd", type="date")
     * @Assert\DateTime()
     */
    private $dateEnd;

    /**
     * @ORM\ManyToMany(targetEntity="MS\PlatformBundle\Entity\Subject", cascade={"persist"}, inversedBy="courses")
     */
    private $subjects;

    /**
     * @ORM\ManyToMany(targetEntity="MS\PlatformBundle\Entity\Student", cascade={"persist"}, inversedBy="courses")
     */
    private $students;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Course
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Course
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return Course
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return Course
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Add subject
     *
     * @param \MS\PlatformBundle\Entity\Subject $subject
     *
     * @return Course
     */
    public function addSubject(\MS\PlatformBundle\Entity\Subject $subject)
    {
        $this->subjects[] = $subject;

        return $this;
    }

    /**
     * Remove subject
     *
     * @param \MS\PlatformBundle\Entity\Subject $subject
     */
    public function removeSubject(\MS\PlatformBundle\Entity\Subject $subject)
    {
        $this->subjects->removeElement($subject);
    }

    /**
     * Get subjects
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubjects()
    {
        return $this->subjects;
    }

    /**
     * Add student
     *
     * @param \MS\PlatformBundle\Entity\Student $student
     *
     * @return Course
     */
    public function addStudent(\MS\PlatformBundle\Entity\Student $student)
    {
        $this->students[] = $student;

        return $this;
    }

    /**
     * Remove student
     *
     * @param \MS\PlatformBundle\Entity\Student $student
     */
    public function removeStudent(\MS\PlatformBundle\Entity\Student $student)
    {
        $this->students->removeElement($student);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudents()
    {
        return $this->students;
    }

    public function getTotalCoef()
    {
        $this->totalCoef = 0;
        foreach($this->getSubjects() as $subject) {
            $this->totalCoef += $subject->getCoef();
        }

        return $this->totalCoef;
    }

    public function getTotalSubjects()
    {
        $this->totalSubjects = $this->subjects->count();

        return $this->totalSubjects;
    }

    public function getTotalStudents()
    {
        $this->totalStudents = $this->students->count();

        return $this->totalStudents;
    }
}
