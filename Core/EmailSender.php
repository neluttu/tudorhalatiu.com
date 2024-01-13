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
        $this->mailer->Host = 'mail.consultinov.ro';
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'office@consultinov.ro';
        $this->mailer->Password = '^P,wx-p79T6k';
        $this->mailer->SMTPSecure = 'tls';
        $this->mailer->Port = 587;
        $this->mailer->setFrom('office@consultinov.ro', 'Consultinov');
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