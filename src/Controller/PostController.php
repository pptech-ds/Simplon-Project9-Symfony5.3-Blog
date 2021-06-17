<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/", name="post_home")
     */
    public function home(): Response
    {
        return $this->render('post/index.html.twig', [
            'bg_image' => 'home-bg.jpg', 
        ]);
    }

     /**
     * @Route("/post/{id}", name="post_view", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function view($id): Response
    {
        return $this->render('post/view.html.twig', [
            'post' => [
                'title' => 'Le titre de l\'article',
                'content' => 'Le super contenu de notre article'
            ],
            'bg_image' => 'post-bg.jpg', 
        ]);
    }
}