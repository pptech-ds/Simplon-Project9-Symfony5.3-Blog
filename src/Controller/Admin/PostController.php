<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    /**
     * @Route("/admin/post/add", name="admin_post_add")
     */
    public function addPost(Request $request): Response
    {
        $post = new Post();
        // dd($post);
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($form);
            // dd($post);
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $this->addFlash('success', 'Votre Cetegorie a été ajouté avec succes !');

            return $this->redirectToRoute('admin_post_index');
        }

        return $this->render('admin/post/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/admin/post/", name="admin_post_index")
     */
    public function indexPost(PostRepository $postRepository): Response
    {
        return $this->render('admin/post/index.html.twig', [
            'posts' => $postRepository->findAll(),
        ]);
    }



    /**
     * @Route("/admin/post/update/{id}", name="admin_post_update", requirements={"id"="\d+"})
     */
    public function updatePost(Post $post, Request $request): Response
    {
        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            $this->addFlash('success', 'Votre article a été modifié avec succes !');

            return $this->redirectToRoute('admin_post_index');
        }

        return $this->render('admin/post/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
