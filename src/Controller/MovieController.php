<?php

namespace App\Controller;

use App\Entity\Bookmark;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use App\Repository\BookmarkRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MovieController extends AbstractController
{
    /**
     * @Route("/movie", name="app_movie", methods={"GET"})
     */
    public function getAllMovies(MovieRepository $movieRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $movies = $movieRepository->findAll();

        // PAGINANTION KNP/PAGINATOR
        $movieList = $paginator->paginate(
            $movies,
            $request->query->getInt('page', 1),
            20

        );
        
        return $this->render('movie/list.html.twig', [
            'movieList' => $movieList,
        ]);
    }

    /**
     * Get one movie
     *
     * @Route("/movie/{id}", name="movie_get_one", methods={"GET"})
     */
    public function getOneMovie(MovieRepository $movieRepository, BookmarkRepository $bookmarkRepository, CommentRepository $commentRepository, $id): Response
    {
        $bookmarks = $bookmarkRepository->findAll();
        //$value = $bookmarks[0]->getMovie()->getId();
        $comments = $commentRepository->findAll();

        //dump($comments[0]->getMovie()->getTitle());
        //dump($comments[0]->getUser()->getEmail());
        //dump($comments[0]->getContent());
        // die();

        $movie = $movieRepository->find($id);
        // 404 ?
        if ($movie === null) {
            // On envoie une vraie réponse en JSON
            throw $this->createNotFoundException("Movie not found.");
        }

        // for ($i = 0; ; $i++) {
        //     switch (($bookmarks[$i]->getMovie()->getId()) {
        //         case $id:
        //             $favorite = true;
        //             break;
        //         default:
        //         $favorite = false;
        //     }

        //     if ($i == count($bookmarks)) {
        //         break;
        //     }

        // }

        return $this->render('movie/detail.html.twig', [
            'movieDetail' => $movie,
            'comments' => $comments,
            //'favorite' => $favorite,
        ]);
    }
}
