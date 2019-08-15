<?php

namespace App\Controller;


use App\Entity\Student;
use App\Form\StudentForm;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends Controller
{
    /**
     * Render main page with list of students
     * @Route("/{page<\d+>?}", name="list", methods={"GET"})
     * @param $page
     * @param StudentRepository $studentRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list($page, StudentRepository $studentRepository){
        return $this->render('student_list.html.twig', [
            // TODO: Add pagination
            'students' => $studentRepository->findAll(),
        ]);
    }

    /**
     * Renders create/update student page with form
     * @Route("/edit/student/{id<\d+>?}", name="edit_student", methods={"GET","POST"})
     * @param $id
     * @param StudentRepository $studentRepository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editOrCreateStudent($id, StudentRepository $studentRepository, Request $request){

        $student = $id ? $studentRepository->find($id) : new Student();

        // If student is not found (has been deleted in between for example)
        if (null === $student){
            return $this->redirectToRoute('list');
        }

        $form = $this->createForm(StudentForm::class, $student);
        $form->handleRequest($request);

        // Test if form is submitted and and valid, if so save object and return to list
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($student);
            $entityManager->flush();
            return $this->redirectToRoute('list');
        }

        return $this->render('student_edition.html.twig', [
                'form' => $form->createView(),
            ]
        );

    }

    /**
     * Delete a student. No csrf or symfony form validation needed since you can't csrf DELETE method (TODO: look it up further and make real sure)
     * @Route("/remove/student/{id<\d+>}", name="remove_student", methods={"DELETE"})
     * @param int $id
     * @param StudentRepository $studentRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function removeStudent(int $id, StudentRepository $studentRepository){
        $student = $studentRepository->find($id);
        if (empty($student)){
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($student);
        $entityManager->flush();
        return new JsonResponse();
    }

}