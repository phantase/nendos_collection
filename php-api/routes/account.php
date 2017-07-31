<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

define("A_SALT", "Sel de Guérande");

// Login
$app->post('/auth/login', function(Request $request, Response $response) {

    $data = $request->getParsedBody();
    $usermail = filter_var($data['usermail'], FILTER_SANITIZE_STRING);
    $password = filter_var($data['password'], FILTER_SANITIZE_STRING);
    $encpass = base64_encode(base64_encode(base64_encode($usermail.$password.A_SALT)));
    $data['encpass'] = $encpass;
    $this->applogger->addInfo("User $usermail try to login...");

    $mapper = new UserMapper($this->db);
    $user = $mapper->checkUser($usermail,$encpass);

    if($user){
        $mapper->updateUserLastViewDate($user->getInternalid());
        $user = $mapper->getByInternalid($user->getInternalid());

        $now = new DateTime();
        $future = new DateTime("now +24 hours");
        $jti = Tuupola\Base62::encode(random_bytes(16));

        $payload = [
          "iat" => $now->getTimeStamp(),
          "exp" => $future->getTimeStamp(),
          "jti" => $jti,
          "user" => $user
        ];

        $secret = $this["settings"]["jwt"]["secret"];
        $token = Firebase\JWT\JWT::encode($payload, $secret, "HS256");
        $repdata["status"] = "ok";
        $repdata["token"] = $token;
        $repdata["user"] = $user;

        $this->applogger->addInfo("User $usermail successfully log in");

        $newresponse = $response->withJson($repdata);
    } else {
        $this->applogger->addInfo("User $usermail failled to log in");
        $newresponse = $response->withStatus(401);
    }

    return $newresponse;
});

// ReLogin
$app->get('/auth/relogin', function(Request $request, Response $response) {
    $user = $request->getAttribute("token")->user;
    $this->applogger->addInfo("User $user->usermail try to relogin...");

    $mapper = new UserMapper($this->db);
    $mapper->updateUserLastViewDate($user->internalid);
    $user = $mapper->getByInternalid($user->internalid);

    if($user){
        $now = new DateTime();
        $future = new DateTime("now +24 hours");
        $jti = Tuupola\Base62::encode(random_bytes(16));

        $payload = [
          "iat" => $now->getTimeStamp(),
          "exp" => $future->getTimeStamp(),
          "jti" => $jti,
          "user" => $user
        ];

        $secret = $this["settings"]["jwt"]["secret"];
        $token = Firebase\JWT\JWT::encode($payload, $secret, "HS256");
        $repdata["status"] = "ok";
        $repdata["token"] = $token;
        $repdata["user"] = $user;

        $usermail = $user->getUsermail();
        $this->applogger->addInfo("User $usermail successfully relogin...");

        $newresponse = $response->withJson($repdata);
    } else {
        $this->applogger->addInfo("User $user->usermail failled to relogin...");

        $newresponse = $response->withStatus(401);
    }

    return $newresponse;
});

// Whoami
$app->get('/auth/whoami', function(Request $request, Response $response) {
    $user = $request->getAttribute("token")->user;
    $this->applogger->addInfo("User $user->usermail want to know whoishe");
    $newresponse = $response->withJson($user);
    return $newresponse;
});

// Register
$app->post('/auth/register', function(Request $request, Response $response) {

    $data = $request->getParsedBody();
    $usermail = filter_var($data['usermail'], FILTER_SANITIZE_STRING);
    $username = filter_var($data['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($data['password'], FILTER_SANITIZE_STRING);
    $encpass = base64_encode(base64_encode(base64_encode($usermail.$password.A_SALT)));
    $data['encpass'] = $encpass;
    $this->applogger->addInfo("A new user ($usermail/$username) want to register...");

    $mapper = new UserMapper($this->db);

    $user = $mapper->getByUsermail($usermail);
    if ($user) {
        // Usermail already exist in database
        $newresponse = $response->withStatus(409);
    } else {
        $registrationcode = $mapper->createUserStaged($usermail, $username, $encpass);

        if($registrationcode){
            $this->applogger->addInfo("User ($usermail/$username) successfully register in and went to staged, we are waiting for his email confirmation now");

            $mail = new PHPMailer;
            $mail->isSMTP();
            // $mail->SMTPDebug = 4;
            // $mail->Debugoutput = 'html';
            $mail->Host = $this["settings"]["smtp"]["host"];
            $mail->SMTPAuth = true;
            $mail->Username = $this["settings"]["smtp"]["user"];
            $mail->Password = $this["settings"]["smtp"]["pass"];
            $mail->SMTPSecure = 'tls';
            $mail->Port = $this["settings"]["smtp"]["port"];

            $mail->setFrom($this["settings"]["smtp"]["from"], $this["settings"]["smtp"]["name"]);
            $mail->addAddress($usermail, $username);
            $mail->addBCC($this["settings"]["smtp"]["bcc"]);

            $mail->isHTML(true);

            $mail->Subject = '[nendoroids-db.net] A confirmation is needed for your account at Nendoroids-db.net';
            $mail->Body    =  "Dear $username,<br>".
                "A new account has been created with your email <strong>$usermail</strong>. ".
                "To confirm this account, you will have to enter the following code in the appropriate page (the one you have reached just after your registration...<br>".
                "<br>".
                "<i>Registration code:</i> <code>$registrationcode</code><br>".
                "<br>".
                "If you are not at the origin of this new account you have just to ignore this mail and the account will not be confirmed and deleted in few days automatically.<br>".
                "<br>".
                "If you have closed the page with the confirmation form, you can go to <a href=\"https://www.nendoroids-db.net/#/confirm\">the confirmation page</a> and enter your email and the confirmation code.<br>".
                "<br>".
                "See you soon at Nendoroids-db.net.";
            $mail->AltBody =  "Dear $username, \r\n".
                "\r\n".
                "A new account has been created with your email <$usermail>. To confirm this account, you will have to enter the following code in the appropriate page (the one you have reached just after your registration...\r\n".
                "\r\n".
                "Registration code: $registrationcode\r\n".
                "\r\n".
                "If you are not at the origin of this new account you have just to ignore this mail and the account will not be confirmed and deleted in few days automatically.\r\n".
                "\r\n".
                "If you have closed the page with the confirmation form, you can go to <https://www.nendoroids-db.net/#/confirm> (the confirmation page) and enter your email and the confirmation code.\r\n".
                "\r\n".
                "See you soon at Nendoroids-db.net.\r\n";

            if(!$mail->send()) {
                $newresponse = $response->withJson($mail->ErrorInfo, 201);
            } else {
                $newresponse = $response->withStatus(201);
            }
        } else {
            $this->applogger->addInfo("User ($usermail/$username) failled to register...");
            $newresponse = $response->withStatus(500);
        }
    }

    return $newresponse;
});

// Confirm
$app->post('/auth/confirm', function(Request $request, Response $response) {

    $data = $request->getParsedBody();
    $usermail = filter_var($data['usermail'], FILTER_SANITIZE_STRING);
    $registrationcode = filter_var($data['registrationcode'], FILTER_SANITIZE_STRING);

    $this->applogger->addInfo("User $usermail want to confirm is account...");

    $mapper = new UserMapper($this->db);
    $user = $mapper->confirmUser($usermail, $registrationcode);

    if($user){
        $this->applogger->addInfo("User $usermail has successfully confirmed his mail and is now a real user");

        $newresponse = $response->withJson($user, 201);
    } else {
        $this->applogger->addInfo("User $usermail failled to confirm his account...");
        $newresponse = $response->withStatus(403);
    }

    return $newresponse;
});

// Edit
$app->put('/auth/user/{internalid:[0-9]+}', function(Request $request, Response $response, $args) {
    $userid = $request->getAttribute("token")->user->internalid;
    $internalid = (int)$args['internalid'];
    $data = $request->getParsedBody();
    if ($userid == $internalid) {
        $this->applogger->addInfo("User $userid edits his user information");

        $newelement = null;
        try {
            $usermail = filter_var($data['usermail'], FILTER_SANITIZE_STRING);
            if (strlen($usermail) == 0) {
                throw new Exception("No usermail provided");
            }
            $username = filter_var($data['username'], FILTER_SANITIZE_STRING);
            if (strlen($username) == 0) {
                throw new Exception("No username provided");
            }
            $oldpassword = filter_var($data['oldpassword'], FILTER_SANITIZE_STRING);
            if (strlen($oldpassword) == 0) {
                throw new Exception("No previous password provided");
            }
            $encpass = base64_encode(base64_encode(base64_encode($request->getAttribute("token")->user->usermail.$oldpassword.A_SALT)));
            $user_mapper = new UserMapper($this->db);
            $user = $user_mapper->checkUser($request->getAttribute("token")->user->usermail,$encpass);
            if ($user) {
                // OK
            } else {
                throw new Exception("Previous password is wrong");
            }
            $encpass = base64_encode(base64_encode(base64_encode($usermail.$oldpassword.A_SALT)));

            $newpassword = filter_var($data['newpassword'], FILTER_SANITIZE_STRING);
            if (strlen($newpassword) > 0) {
                $encpass = base64_encode(base64_encode(base64_encode($usermail.$newpassword.A_SALT)));
            }

            $newelement = $user_mapper->update($usermail, $username, $encpass, $userid);

            if( is_null($newelement) ){
                $newresponse = $response->withStatus(500);
            } else {
                $now = new DateTime();
                $future = new DateTime("now +24 hours");
                $jti = Tuupola\Base62::encode(random_bytes(16));

                $payload = [
                  "iat" => $now->getTimeStamp(),
                  "exp" => $future->getTimeStamp(),
                  "jti" => $jti,
                  "user" => $newelement
                ];

                $secret = $this["settings"]["jwt"]["secret"];
                $token = Firebase\JWT\JWT::encode($payload, $secret, "HS256");
                $repdata["status"] = "ok";
                $repdata["token"] = $token;
                $repdata["user"] = $newelement;

                $this->applogger->addInfo("User $usermail successfully update his info and generates a new token");

                $newresponse = $response->withJson($repdata,200);
            }
        } catch (Exception $e){
            $this->applogger->addInfo($e);
            $newresponse = $response->withStatus(400);
        }
    } else if($request->getAttribute("token")->user->administrator) {
        $this->applogger->addInfo("Administrator $userid edits user $internalid rights");

        $newelement = null;

        try {
            $administrator = filter_var($data['administrator'], FILTER_SANITIZE_NUMBER_INT );
            $validator = filter_var($data['validator'], FILTER_SANITIZE_NUMBER_INT );
            $editor = filter_var($data['editor'], FILTER_SANITIZE_NUMBER_INT );

            $user_mapper = new UserMapper($this->db);
            $newelement = $user_mapper->updateRights($administrator, $validator, $editor, $internalid);

            if( is_null($newelement) ){
                $newresponse = $response->withStatus(500);
            } else {
                $newresponse = $response->withJson($newelement,200);
            }

        } catch (Exception $e){
            $this->applogger->addInfo($e);
            $newresponse = $response->withStatus(400);
        }
    } else {
        $this->applogger->addInfo("User $userid tries to edit user $internalid without right to do it (not himself and not administrator)");
        $newresponse = $response->withStatus(403);
    }
    return $newresponse;
});
