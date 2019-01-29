<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\{Movie, Person};
use App\Form\PersonType;

class PersonController extends AbstractController
{
    /**
     * @Route("/persons", name="home_person")
     */
    public function index()
    {
        return $this->render('person/index_person.html.twig', [
            'controller_name' => 'PersonController',
        ]);
    }

    /**
     * @Route("/person/add", name="add_person")
     * @Route("/person/{id}/edit", name="edit_person")
     */
    public function addPerson(Person $person = null, Request $request, ObjectManager $em)
    {
        if(!$person) {
            $person = new Person();
        }
    
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($person);
            $em->flush();
      
                return $this->redirectToRoute('home_person');
        }


        //var_dump($person->getId() !== null); exit;
        return $this->render('person/add_person.html.twig',[
            'form' => $form->createView(), 
            'editMode' => $person->getId() !== null
        ]);

    }

    
    /*public function showAllPersons()
    {
        $em = $this->getDoctrine()->getManager();
        $persons = $em->getRepository(Person::class)->findAll();

        return  $persons;
        
    }*/
}
