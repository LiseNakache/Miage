<?php

namespace MS\PlatformBundle\Controller;


use MS\PlatformBundle\Entity\Subject;
use MS\PlatformBundle\Entity\Teacher;
use MS\PlatformBundle\Entity\Student;
use MS\PlatformBundle\Entity\Grade;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//to get the data from ajax call post
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class TeacherController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $teacher = $em->getRepository('MSPlatformBundle:Teacher')->find(4);
        return $this->render("@MSPlatform/Teacher/homepage.html.twig",
            array('teacher' => $teacher));
    }

    public function addGradesAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $gradeExist = false;

        $subjectId = $request->request->get('subjectId');
        $subject = $em->getRepository('MSPlatformBundle:Subject')->find($subjectId);
        $subjectGrade = $subject -> getGrades();

            if(count($subjectGrade) < 1) {
                $gradeExist = false;
            } else {
                $gradeExist = true;
            }




            if ($request->isXmlHttpRequest() && ($gradeExist == false)){
                $grades = $request->request->get('allGrades');
                if (!empty($grades)) {
                    $length = count($grades);
                    for($i = 0; $i <  $length ; $i++ ) {
                        $grade = $request->request->get('allGrades')[$i]['grade'];
                        $studentId = $request->request->get('allGrades')[$i]['student'];

                        $student = $em->getRepository('MSPlatformBundle:Student')->find($studentId);

                        $newGrade = new Grade();
                        $newGrade -> setGrade($grade);
                        $newGrade -> setStudent($student);
                        $newGrade -> setSubject($subject);

                        $em->persist($newGrade);
                        $em->flush();
                    }
                }
                $result = ['output' => 'Les notes ont bien été ajoutées'];
                return new JsonResponse($result) ;

            } else {
                $result = ['output' => 'Les notes ont déjà été ajoutées'];
                return new JsonResponse($result) ;
            }



    }
}

