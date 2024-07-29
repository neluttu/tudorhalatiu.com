<?php

namespace Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailSender
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->initializeMailer();
    }

    private function initializeMailer()
    {
        // Configurare PHPMailer
        $this->mailer->isSMTP();
        $this->mailer->Host = 'mail.tudorhalatiu.com';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'contact@tudorhalatiu.com';
        $this->mailer->Password = '88#2l&mN+}uo';
        $this->mailer->SMTPSecure = 'ssl';
        $this->mailer->Port = 465;
        $this->mailer->setFrom('contact@tudorhalatiu.com', 'TudorHalatiu.com');
        $this->mailer->CharSet = "UTF-8";
    }

    public function sendEmail($to, $subject, $template, $variables = [])
    {
        try {
            // Configurare destinatar și subiect
            $this->mailer->addAddress($to);
            $this->mailer->Subject = $subject;

            // Încărcare conținut HTML din fișierul șablon
            $htmlContent = file_get_contents($template);

            // Înlocuirea variabilelor în conținutul HTML
            foreach ($variables as $key => $value) {
                $htmlContent = str_replace("{{" . $key . "}}", $value, $htmlContent);
            }

            // Adăugare conținut HTML
            $this->mailer->isHTML(true);
            $this->mailer->Body = $htmlContent;

            // Trimite email
            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}