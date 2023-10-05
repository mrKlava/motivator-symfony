<?php

namespace App\Controller;

use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ExploreController extends AbstractController
{
    #[Route('/explore', name: 'app_explore')]
    public function index(BlogRepository $blogRepository, UserInterface $user = null): Response
    {
        // $user_id = $user !== null ? $user->getId() : null; 
        // dump($user_id);

        $userTest = $this->getUser();
        
        $blogs = $blogRepository->findAll();
        dump($userTest);
        dump($blogs);

        return $this->render('explore/index.html.twig', [
            'title' => 'Motivator Explore',
            'blogs' => $blogs
        ]);
    }
}


