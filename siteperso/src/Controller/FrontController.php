<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

    /**
     * @Route("/paulinsc/contact", name="contact_page")
     */
    public function contact(){
        $form = $this->createForm(ContactType::class);
        return $this->render('front/contact.html.twig', [
            'formContact' => $form->createView(),
        ]);

    }
}
