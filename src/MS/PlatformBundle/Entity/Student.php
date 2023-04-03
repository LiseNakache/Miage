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
     * Constructor
     */
    public function __construct() {
        $this->courses = new ArrayCollection();
    }


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $first_name;


    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $last_name;

    /**
     * @ORM\ManyToMany(targetEntity="MS\PlatformBundle\Entity\Course", mappedBy="students")
     */
    private $courses;

    /**
     * @ORM\OneToMany(targetEntity="MS\PlatformBundle\Entity\Grade", mappedBy="student")
     */
    private $grades;


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
     * Set id
     *
     * @param integer $id
     *
     * @return Student
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }



    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Student
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Student
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
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
