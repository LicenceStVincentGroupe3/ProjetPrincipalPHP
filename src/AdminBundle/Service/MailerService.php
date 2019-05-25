<?php

namespace App\AdminBundle\Service;

use Twig\Environment;
use Symfony\Component\Routing\RouterInterface;
use App\AdminBundle\Entity\Operations;
use App\AdminBundle\Entity\Contact;
use Proxies\__CG__\App\AdminBundle\Entity\OperationSettings;

class MailerService
{
    private $mailer;
    private $template;
    private $router;

    public function __construct(\Swift_Mailer $mailer, \Twig\Environment $template, RouterInterface $router)
    {
        $this->mailer = $mailer;
        $this->template = $template;
        $this->router = $router;
    }

    public function sendOperation(Operations $operation, Contact $contact, OperationSettings $operationSettings, $uniqid)
    {
        $message = (new \Swift_Message($operationSettings->getOperationSettingsEmailObject()))
            ->setFrom('gradi-60@outlook.fr')
            ->setTo("gradi-60@outlook.fr")
            ->setBody(
                $this->template->render(
                    "operations/emailView.html.twig",
                    [
                        "nom" => $contact->getContactLastName(),
                        "prenom" => $contact->getContactFirstName(),
                        "texte" => $operationSettings->getOperationSettingsEmailText(),
                        "operationSettings" => $operationSettings,
                        "link" => $_SERVER['HTTP_REFERER'] . "/operation/" . $operation->getOperationName() . "/" . $uniqid
                    ]
                ),
                "text/html"
            );
        $this->mailer->send($message);
    }
}
