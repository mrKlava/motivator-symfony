<?php

namespace App\Controller;

use App\Form\EditProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile', methods: ['GET', 'POST'])]
    public function index(
        Request $request, 
        EntityManagerInterface $entityManager
    ): Response
    {
        // get current user data
        $user = $this->getUser();
        // create form from FormType using current user
        $form = $this->createForm(EditProfileType::class, $user);
        $form->handleRequest($request);

        
        // dump($form);

        // handle form if it is submitted and valid
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
        }



        return $this->render('profile/index.html.twig', [
            'form' => $form->createView()
            // 'user' => $test,
        ]);
    }
}




// <?php

// namespace App\Controller;

// use App\Entity\User;
// use App\Form\ProfileType;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Annotation\Route;

// class ProfileController extends AbstractController
// {
//     #[Route('/profile', name: 'app_profile', methods: ['GET', 'POST'])]
//     public function index(
//         Request $request, 
//         // User $user,
//         EntityManagerInterface $entityManager
//     ): Response
//     {
//         // get current user data
//         $user = $this->getUser();
//         // create form from FormType using current user
//         $form = $this->createForm(ProfileType::class, $user);
//         $form->handleRequest($request);

        
//         // dump($form);

//         // handle form if it is submitted and valid
//         if ($form->isSubmitted() && $form->isValid()) {

//             $entityManager->persist($user);
//             $entityManager->flush();

//             return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
//         }



//         return $this->render('profile/index.html.twig', [
//             'form' => $form->createView()
//             // 'user' => $test,
//         ]);
//     }
// }
