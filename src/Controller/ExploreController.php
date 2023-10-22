<?php

namespace App\Controller;

use DateTime;

use App\Entity\Blog;
use App\Entity\Comment;

use App\Form\CommentType;
use App\Form\FilterBlogType;
use App\Repository\BlogRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/explore')]
class ExploreController extends AbstractController
{
    #[Route('/', name: 'app_explore', methods: ['GET', 'POST'])]
    public function index(Request $request, BlogRepository $blogRepository,): Response
    {

        // $form = $this->createForm(FilterBlogType::class);
        
        // if ($form->isSubmitted() && $form->isValid()) {
            
        //     dump();

        //     $blogs = $blogRepository->findBy(array('title' => $form->get('text')->getData()));
            
        //     dump($blogs);
            
        //     return $this->render('app_blog_index', [
        //         'title' => 'Motivator Explore',
        //         'blogs' => $blogs,
        //         'form'  => $form,
        //     ]);
        // }
        
        $cat = $request->getPayload()->get('category');
        $text = $request->getPayload()->get('text');
        
        if ($cat !== "null") {
            $blogs = $blogRepository->filterByCategory($cat, $text !== "null" ? $text : "%" );
        } else {
            $blogs = $blogRepository->findAll();
        }
        

        return $this->render('explore/index.html.twig', [
            'title' => 'Motivator Explore',
            'blogs' => $blogs,
            // 'form'  => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_explore_show', methods: ['GET', 'POST'])]
    public function show(Blog $blog, Request $request, EntityManagerInterface $entityManager): Response
    {
        $comments = $blog->getComments();

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreated(new DateTime());
            $comment->setApproved(1);
            $comment->setBlog($blog);
            $comment->setUser($this->getUser());

            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('app_explore_show', ['id' => $blog->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('blog/show.html.twig', [
            'title' => 'Blog',
            'blog' => $blog,
            'comments' => $comments,
            'form' => $form,
            'comment' => $comment,
        ]);
     }
}


