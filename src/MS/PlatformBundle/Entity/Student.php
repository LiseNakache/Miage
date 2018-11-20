<?php

namespace MS\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Student
 *
 * @ORM\Table(name="student")
 * @ORM\Entity(repositoryClass="MS\PlatformBundle\Repository\StudentRepository")
 */
class Student
{
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
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $name;




    /**
     * @ORM\ManyToMany(targetEntity="MS\PlatformBundle\Entity\Course", mappedBy="students")
     */
    private $courses;

    /**
     * @ORM\OneToMany(targetEntity="MS\PlatformBundle\Entity\Grade", mappedBy="student")
     */
    private $grades;

    /**
     * Constructor
     */
    public function __construct() {
        $this->courses = new ArrayCollection();
    }


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
     * Set name
     *
     * @param string $name
     *
     * @return Student
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
     * Add course
     *
     * @param \MS\PlatformBundle\Entity\Course $course
     *
     * @return Student
     */
    public function addCourse($course)
    {
        $this->courses[] = $course;

        return $this;
    }

    /**
     * Remove course
     *
     * @param \MS\PlatformBundle\Entity\Course $course
     */
    public function removeCourse($course)
    {
        $this->courses->removeElement($course);
    }

    /**
     * Get courses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * Add grade
     *
     * @param \MS\PlatformBundle\Entity\Grade $grade
     *
     * @return Student
     */
    public function addGrade($grade)
    {
        $this->grades[] = $grade;

        return $this;
    }

    /**
     * Remove grade
     *
     * @param \MS\PlatformBundle\Entity\Grade $grade
     */
    public function removeGrade($grade)
    {
        $this->grades->removeElement($grade);
    }

    /**
     * Get grades
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGrades()
    {
        return $this->grades;
    }
}
