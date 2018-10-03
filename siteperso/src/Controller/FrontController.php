<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\ContactType;
use App\Repository\MessageRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/front", name="front")
     */
    public function index()
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * @Route("/", name="app_homepage")
     */
    public function home(){
        return $this->render('front/home.html.twig', [
            'title' =>'bienvenue'
        ]);
    }

    /**
     * @Route("/paulinsc/competences", name="skillz_page")
     */
    public function skills(){
        return $this->render('front/skills.html.twig', [
            'title' =>'bienvenue'
        ]);
    }

    /**
     * @Route("/paulinsc/porfolio", name="porfolio_page")
     */
    public function porfolio(){
        return $this->render('front/porfolio.html.twig', [
            'title' =>'bienvenue'
        ]);
    }
//
//    /**
//     * @Route("/paulinsc/contact", name="contact_page")
//     */
//    public function contact(){
//        $form = $this->createForm(ContactType::class);
//        return $this->render('front/contact.html.twig', [
//            'formContact' => $form->createView(),
//        ]);
//
//    }

    /**
     * @Route("/contact", name="contact_page")
     */
    public function registration(Request $request, ObjectManager $manager){
        $message = new Message();

        $form = $this->createForm(ContactType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager->persist($message);
            $manager->flush();
            return $this->redirectToRoute('app_homepage');
        }
        return $this->render('front/contact.html.twig', [
            'formContact' => $form->createView()
        ]);
    }
}
