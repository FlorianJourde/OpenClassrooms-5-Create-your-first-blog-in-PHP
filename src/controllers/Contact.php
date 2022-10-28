<?php

namespace Application\Controllers;

use Application\Lib\ManageSession;
use Application\Lib\Vue;

class Contact
{
    public function execute()
    {
        $manageSession = new ManageSession();
        $manageSession->execute();

        // Secure datas before sending them to database
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (is_string($_POST['firstname'])) {
                $firstname = strip_tags($_POST['firstname']);
            }

            if (is_string($_POST['lastname'])) {
                $lastname = strip_tags($_POST['lastname']);
            }

            if (is_string($_POST['email'])) {
                // Check if valid email address
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $email = strip_tags($_POST['email']);
                }
            }

            if (is_string($_POST['message'])) {
                $message = strip_tags($_POST['message']);
            }

            $receiver = "jourdeflorian@gmail.com";
            $emailMessage = "Prénom : " . $firstname . "\r\n";
            $emailMessage .= "Nom : " . $lastname . "\r\n";
            $emailMessage .= "Email : " . $email . "\r\n";
            $emailMessage .= "Message : " . $message . "\r\n";
            $subject = "Nouveau message de florianjourde.com";
            $headers = "From: contact@florianjourde.com";

            if (!empty($firstname) & !empty($lastname) & !empty($email) & !empty($message))
            if (mail($receiver, $subject, $emailMessage, $headers)) {
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

        $twig = new Vue();
        echo $twig->render('contact.twig', ['session' => $_SESSION]);
    }
}
