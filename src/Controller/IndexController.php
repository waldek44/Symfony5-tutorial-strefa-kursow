<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $randomNumber = rand(0, 100);

        $numbers = [
            'first' => 1,
            'second' => 2,
            'third' => 3,
        ];
        return $this->render('index/index.html.twig', [
            'randomka' => $randomNumber,
            'listaNumerow' => $numbers,
        ]);
    }
}
