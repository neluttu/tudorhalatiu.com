<?
use Core\EmailSender;

$emailSender = new EmailSender();
// Exemplu de folosire
$emailSender->sendEmail(
    'ionel.olariu@gmail.com',
    'Subject of the Email',
    '../views/emails/test.html',
    ['name' => 'John Doe', 'message' => 'Hello, world!']
);

?>