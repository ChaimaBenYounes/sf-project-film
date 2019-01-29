<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;

use Doctrine\ORM\EntityManagerInterface;

use App\Entity\{Movie, Person};
use App\Form\MovieType;


class MovieController extends AbstractController
{
    /**
     * @Route("/movies", name="home_movies")
     */
    public function showAllMovies(EntityManagerInterface $em )
    {
        $movies = $em->getRepository(Movie::class)->findAll();

        return $this->render('movies/movies.html.twig',[
            'movies' => $movies
        ]);
    }

     /**
     * @Route("/movie/add", name="add_movie")
     * @Route("/movie/{id}/edit", name="edit_movie")
     */
    public function addMovie(Movie $movie = null, Request $request, ObjectManager $em)
    {
        if(!$movie) {
            $movie = new Movie();
        }

        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($movie);
            $em->flush();
      
                return $this->redirectToRoute('home_movies', ['id' => $movie->getId()]);
        }

        return $this->render('movies/add_movie.html.twig',[
            'form' => $form->createView(), 
            'editMode' => $movie->getId() !== null
        ]);

    }


}