<?php
namespace MS\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MS\PlatformBundle\Entity\Teacher;

class LoadTeacher implements FixtureInterface
{
     public function load(ObjectManager $manager)
        {
            // Liste des noms de catégorie à ajouter
            $names = array(
                'Lolo Bobo',
                'Lala Baba',
                'Lili Bibi',
            );


            for ($i = 0; $i < 3; $i++) {
                $teacher = new Teacher();
                $teacher->setName($names[$i]);
                $manager->persist($teacher);
            }

            // On déclenche l'enregistrement de toutes les catégories
            $manager->flush();
    }
}