<?php

namespace MS\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Subject
 *
 * @ORM\Table(name="subject")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="MS\PlatformBundle\Repository\SubjectRepository")
 */
class Subject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teachers = new ArrayCollection();
        $this->grades = new ArrayCollection();
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
     * @var int
     *
     * @ORM\Column(name="coef", type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 15,
     *      minMessage = "Le coefficient doit être supérieur à 0",
     *      maxMessage = "Le coefficient doit être inférieur à 20",
     *)
     */
    private $coef;

    /**
     * @ORM\ManyToMany(targetEntity="MS\PlatformBundle\Entity\Teacher", cascade={"persist"}, inversedBy="subjects")
     */
    private $teachers;


    /**
     * @ORM\ManyToMany(targetEntity="MS\PlatformBundle\Entity\Course", mappedBy="subjects")
     */
    private $courses;


    /**
     * @ORM\OneToMany(targetEntity="MS\PlatformBundle\Entity\Grade", mappedBy="subject")
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
     * Set type
     *
     * @param string $type
     *
     * @return Subject
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
     * @return Subject
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
     * Set coef
     *
     * @param integer $coef
     *
     * @return Subject
     */
    public function setCoef($coef)
    {
        $this->coef = $coef;

        return $this;
    }

    /**
     * Get coef
     *
     * @return integer
     */
    public function getCoef()
    {
        return $this->coef;
    }


    /**
     * Add teacher
     *
     * @param \MS\PlatformBundle\Entity\Teacher $teacher
     *
     * @return Subject
     */
    public function addTeacher($teacher)
    {
        $this->teachers[] = $teacher;

        return $this;
    }

    /**
     * Remove teacher
     *
     * @param \MS\PlatformBundle\Entity\Teacher $teacher
     */
    public function removeTeacher($teacher)
    {
        $this->teachers->removeElement($teacher);
    }

    /**
     * Get teachers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTeachers()
    {
        return $this->teachers;
    }

    /**
     * Add course
     *
     * @param \MS\PlatformBundle\Entity\Course $course
     *
     * @return Subject
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
     * @return Subject
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
