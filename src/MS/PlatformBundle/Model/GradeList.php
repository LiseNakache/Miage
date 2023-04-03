<?php

namespace MS\PlatformBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class GradeList
 * @package MS\PlatformBundle\Model
 * @ORM\Entity()
 */
class GradeList
{

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\ManyToMany(targetEntity="\MS\PlatformBundle\Entity\Grade")
     */
    private $grades;

    public function __construct()
    {
        $this->grades = new ArrayCollection();
    }


    /**
     * Add grade
     *
     * @param \MS\PlatformBundle\Entity\Grade $grade
     *
     * @return $this
     */
    public function addGrade(\MS\PlatformBundle\Entity\Grade $grade)
    {
        $this->grades[] = $grade;

        return $this;
    }

    /**
     * Remove grade
     *
     * @param \MS\PlatformBundle\Entity\Grade $grade
     */
    public function removeGrade(\MS\PlatformBundle\Entity\Grade $grade)
    {
        $this->grades->removeElement($grade);
    }


    /**
     * @param \Doctrine\Common\Collections\Collection $grades
     * @return $this
     */
    public function setGrades(\Doctrine\Common\Collections\Collection $grades)
    {
        $this->grades = $grades;

        return $this;
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
