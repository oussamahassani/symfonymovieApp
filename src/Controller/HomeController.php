<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home", methods={"GET"})
     */
    public function index(MovieRepository $movieRepository): Response
    {
        $data = $movieRepository->findAll();
        shuffle($data);
        $result = array_slice($data, 0, 3); 

        return $this->render('home/home.html.twig', [
            'result' => $result,
        ]);
    }
}
