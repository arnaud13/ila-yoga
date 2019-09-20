<?php
// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{

    /**
     * @Route("/contact", name="contact", methods={"GET"})
     * @Template()
     */
    public function contactAction()
    {

        return [];
    }
    /**
     * @Route("/contact", methods={"POST"})
     */
    public function messageAction(Request $request, \Swift_Mailer $mailer)
    {
        $firstname = $request->request->get('firstname');
        $lastname = $request->request->get('lastname');
        $email = $request->request->get('email');
        $cause = $request->request->get('cause');
        $subscribe = $request->request->get('subscribe');
        $reputation = $request->request->get('reputation');
        $message = (new \Swift_Message('nouveau contact sur le site'))
            ->setFrom('contact@ilayoga.com')
            ->setTo('arnaud.rouzier@yahoo.fr')
            ->setBody(
                $this->renderView(
                    // app/Resources/views/Emails/contact.html.twig
                    'Emails/contact.html.twig',
                    [
                        'firstname' => $firstname,
                        'lastname' => $lastname,
                        'email' => $email,
                        'cause' => $cause,
                        'subscribe' => $subscribe,
                        'reputation' => $reputation
                    ]
                ),
                'text/html'
            );

        $mailer->send($message);
        return $this->redirectToRoute('contact');
    }
}
