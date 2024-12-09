<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    // Grâce à MailerInterface qu'on rentre en paramètre à notre méthode
    // Installer grâce à composer require symfony/mailer
        // On changer une ligne dans le .env et on simule des envois de mail
        // avec MailTrap
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Générer le contenu HTML de l'email
            $emailTemplate = $this->renderView('contact/show.html.twig', [
                'contact' => $contact,
            ]);

            // Créer l'objet Email
            $email = (new Email())
                ->from('no-reply@example.com')
                ->to('test@example.com')
                ->subject('Une demande a été faite')
                ->html($emailTemplate);

            // Envoyer l'email
            $mailer->send($email);

            // Ajouter un flash message ou rediriger après l'envoi
            $this->addFlash('success', 'Votre message a été envoyé avec succès !');
        }

        return $this->render('contact/index.html.twig', [
            'formView' => $form->createView(),
        ]);
    }
}
