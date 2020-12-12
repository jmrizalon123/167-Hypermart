<?php
require_once './vendor/autoload.php';


$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
    ->setUsername('SENDER_EMAIL')
    ->setPassword('SENDER_PASSWORD');

    
$mailer = new Swift_Mailer($transport);

function sendVerificationEmail($userEmail, $token)
{
    global $mailer;
    $body = '<!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <title>Test mail</title>
      <style>
        .wrapper {
          padding: 20px;
          color: #444;
          font-size: 1.3em;
        }
        a {
          background: #592f80;
          text-decoration: none;
          padding: 8px 15px;
          border-radius: 5px;
          color: #fff;
        }
      </style>
    </head>

    <body>
      <div class="wrapper">
        <p>Thank you for signing up on our site. Please click on the link below to verify your account:.</p>
        <a href="http://localhost/cwa/divimart/verify_email.php?token=' . $token . '">Verify Email!</a>
      </div>
    </body>

    </html>';

    
    $message = (new Swift_Message('Verify your email'))
        ->setFrom(SENDER_EMAIL)
        ->setTo($userEmail)
        ->setBody($body, 'text/html');

        
    $result = $mailer->send($message);

    if ($result > 0) {
        return true;
    } else {
        return false;
    }
}