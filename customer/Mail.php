<?php
//
// UPDATE Username and Password fields.
//
require_once './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class Mail
{
    public static function send($to, $subject, $message, $name)
    {
        $mail = new PHPMailer(true);
        try {
            //SMTP Server settings
            $mail->isSMTP();
            $mail->Host       = 'asmtp.bilkent.edu.tr';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'muhammad.faizan@ug.bilkent.edu.tr';
            $mail->Password   = 'edugTPxs';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('muhammad.faizan@ug.bilkent.edu.tr', 'LAMBDA Admin');
            $mail->addAddress($to, 'To ' . $name);     //Add a recipient
            // You can add more than one address
            // See further option of recipients cc, bcc in phpmailer docs.

            // Attachment
            // See Documentation of phpmailer

            //Content
            $mail->isHTML(true);  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            echo 'Message has been sent to Administrator';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
