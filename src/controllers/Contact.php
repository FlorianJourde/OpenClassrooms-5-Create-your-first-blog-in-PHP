<?php

namespace Application\Controllers;

use Application\Lib\ManageSession;
use Application\Lib\RenderFront;

class Contact
{
    public function execute(?array $input)
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        if (!empty($input)) {
            $receiver = "jourdeflorian@gmail.com";
            $message = "Prénom : " . $input['firstname'] . "\r\n";
            $message .= "Nom : " . $input['lastname'] . "\r\n";
            $message .= "Email : " . $input['email'] . "\r\n";
            $message .= "Message : " . $input['message'] . "\r\n";
            $subject = "Nouveau message de florianjourde.com";
            $headers = "From: contact@florianjourde.com";

            if (!empty($input['firstname']) & !empty($input['lastname']) & !empty($input['email']) & !empty($input['message']))
            if (mail($receiver, $subject, $message, $headers)) {
                ?>
                <section class="navbar-notification navbar-notification-success">
                    <div class="wrapper">
                        Votre message a bien été envoyé !
                    </div>
                </section>
                <?php
            } else {
                ?>
                <section class="navbar-notification navbar-notification-error">
                    <div class="wrapper">
                        Échec de l'envoi de l'email...
                    </div>
                </section>
                <?php
            }
        }

        $twig = new RenderFront();
        echo $twig->render('contact.twig', ['session' => $_SESSION]);
    }
}
