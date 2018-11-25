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
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $currentUser = $user->getId();
        $teacher = $em->getRepository('MSPlatformBundle:Teacher')->find($currentUser);
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


    public function showGradesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $currentUser = $user->getId();
        $teacher = $em->getRepository('MSPlatformBundle:Teacher')->find($currentUser);
        return $this->render("@MSPlatform/Teacher/editGrades.html.twig",
            array('teacher' => $teacher));
    }

    public function editGradeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->isXmlHttpRequest()){
            $grades = $request->request->get('allGrades_edit');
            if (!empty($grades)) {
                $length = count($grades);
                for($i = 0; $i <  $length ; $i++ ) {
                    $gradeId = $request->request->get('allGrades_edit')[$i]['gradeId'];
                    $gradeValue = $request->request->get('allGrades_edit')[$i]['grade_edit'];
                    $editGrade = $em->getRepository('MSPlatformBundle:Grade')->find($gradeId);
                    $editGrade ->  setGrade($gradeValue);
                    $em->flush();
                }
            }
            $result = ['output' => 'La ou Les notes ont bien été modifiées'];
            return new JsonResponse($result) ;
        }

    }

}
