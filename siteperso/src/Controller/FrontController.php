<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\ContactType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
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
     * @Route({
     *     "fr": "/",
     *     "en": "/en"
     * }, name="app_homepage")
     */
    public function home(){
        return $this->render('front/home.html.twig');
    }

    /**
     * @Route("/paulinsc/competences", name="skillz_page")
     */
    public function skills(){
        return $this->render('front/skills.html.twig');
    }

    /**
     * @Route("/paulinsc/porfolio", name="porfolio_page")
     */
    public function porfolio(){
        return $this->render('front/porfolio.html.twig');
    }

    /**
     * @Route("/contact", name="contact_page")
     */
    public function registration(Request $request, ObjectManager $manager, \Swift_Mailer $mailer){
        $message = new Message();
        $form = $this->createForm(ContactType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $manager->persist($message);
            $manager->flush();
            $mail = (new \Swift_Message('Test'))
                ->setFrom('p.stclivier@gmail.com')
                ->setTo('p.stclivier@gmail.com')
                ->setBody('Vous avez reçu un nouveau message');
            $mailer->send($mail);
//            return $this->redirectToRoute('app_homepage');
        }
        return $this->render('front/contact.html.twig', [
            'formContact' => $form->createView()
        ]);
    }

    /**
     * @Route("/lang=en", name="app_en")
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        // some logic to determine the $locale
        $request->setLocale('en');

    }
}
