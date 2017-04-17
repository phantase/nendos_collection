<?php

// Arbitrary set
date_default_timezone_set('Europe/Paris');

require '../vendor/autoload.php';

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 4;
            $mail->Debugoutput = 'html';
            $mail->Host = 'smtp.gmail.com';
            // $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'phantakun@gmail.com';
            $mail->Password = '__PUTHEREYOURPASSWORD__';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('phantakun@gmail.com');
            $mail->addAddress('fxbt@free.fr', 'fxbt');
            $mail->addBCC('phantakun@gmail.com');

            $mail->isHTML(true);

            $mail->Subject = 'A confirmation is needed for your account at Nendoroids-db.net';
            $mail->Body    =  "Dear fxbt,<br>".
                "A new account has been created with your email <strong>fxbt@free.fr</strong>. ".
                "To confirm this account, you will have to enter the following code in the appropriate page (the one you have reached just after your registration...<br>".
                "<br>".
                "<i>Registration code:</i> <code>Here is the code</code><br>".
                "<br>".
                "If you are not at the origin of this new account you have just to ignore this mail and the account will not be confirmed and deleted in few days automatically<br>".
                "<br>".
                "See you soon at Nendoroids-db.net.";
            $mail->AltBody =  "Dear fxbt, \r\n".
                "\r\n".
                "A new account has been created with your email <fxbt@free.fr>. To confirm this account, you will have to enter the following code in the appropriate page (the one you have reached just after your registration...\r\n".
                "\r\n".
                "Registration code: Here is the code\r\n".
                "\r\n".
                "If you are not at the origin of this new account you have just to ignore this mail and the account will not be confirmed and deleted in few days automatically.\r\n".
                "\r\n".
                "See you soon at Nendoroids-db.net.\r\n";

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
