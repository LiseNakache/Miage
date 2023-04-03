<?php
namespace MS\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MS\PlatformBundle\Entity\Student;

class LoadStudent implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter
        $names = array(
            'Lise Nakache',
            'Simon Nakache',
            'Daniel Nakache',
        );


        foreach ($names as $name) {
            // On crée la catégorie
            $student = new Student();
            $student->setName($name);

            // On la persiste
            $manager->persist($student);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}