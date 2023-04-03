<?php
namespace MS\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MS\PlatformBundle\Entity\Subject;

class LoadSubject implements FixtureInterface
{
    // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
    public function load(ObjectManager $manager)
    {
        // Liste des noms de catégorie à ajouter

        $types = array(
            'A',
            'B',
            'C',
        );


        $names = array(
            'Mathématiques',
            'Base de données',
            'Statistiques',
        );

        $coefs = array(
            '8',
            '2',
            '4',
        );


        for ($i = 0; $i < 3; $i++) {
            $subject = new Subject();
            $subject->setType($types[$i]);
            $subject->setName($names[$i]);
            $subject->setCoef($coefs[$i]);
            $manager->persist($subject);
        }

        // On déclenche l'enregistrement de toutes les catégories
        $manager->flush();
    }
}