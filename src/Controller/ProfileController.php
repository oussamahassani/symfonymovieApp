<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use App\Repository\BookmarkRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="app_profile")
     */
    public function index(BookmarkRepository $bookmarkRepository, MovieRepository $movieRepository): Response
    {
        $bookmarks = $bookmarkRepository->findAll();
        $movies = $movieRepository->findAll();

        $user = $this->getUser();
        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'bookmarks' => $bookmarks,
            'movies' => $movies,
        ]);
    }
}
