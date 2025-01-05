<?php

namespace App\Controller;

use App\Repository\BookmarkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookmarkController extends AbstractController
{
    /**
     * @Route("/bookmark", name="app_bookmark", methods={"GET"})
     */
    public function index(BookmarkRepository $bookmarkRepository): Response
    {
        $bookmarks = $bookmarkRepository->findAll();
        return $this->render('bookmark/index.html.twig', [
            'bookmarks' => $bookmarks,
        ]);
    }

    /**
     * Get one bookmark
     *
     * @Route("/bookmark/{id}", name="bookmark_get_one", methods={"GET"})
     */
    public function getOneMovie(BookmarkRepository $bookmarkRepository, $id): Response
    {
        $bookmark = $bookmarkRepository->find($id);
        // 404 ?
        if ($bookmark === null) {
            // On envoie une vraie réponse en JSON
            throw $this->createNotFoundException("Bookmark not found.");
        }

        return $this->render('movie/detail.html.twig', [
            'bookmark' => $bookmark,
        ]);
    }
}
