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
    $this->applogger->addInfo("POST /auth/login", array('usermail' => $usermail));

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

        $this->applogger->addDebug("POST /auto/login - log in success", array('usermail'=>$usermail));

        $newresponse = $response->withJson($repdata);
    } else {
        $this->applogger->addDebug("POST /auto/login - log in fail", array('usermail'=>$usermail));
        $newresponse = $response->withStatus(401);
    }

    return $newresponse;
});

// ReLogin
$app->get('/auth/relogin', function(Request $request, Response $response) {
    $user = $request->getAttribute("token")->user;
    $this->applogger->addInfo("GET /auth/relogin", array('usermail'=>$user->usermail));

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
        $this->applogger->addDebug("GET /auth/relogin - relogin success", array('usermail'=>$user->getUsermail()));

        $newresponse = $response->withJson($repdata);
    } else {
        $this->applogger->addDebug("GET /auth/relogin - relogin fail", array('usermail'=>$user->getUsermail()));

        $newresponse = $response->withStatus(401);
    }

    return $newresponse;
});

// Whoami
$app->get('/auth/whoami', function(Request $request, Response $response) {
    $user = $request->getAttribute("token")->user;
    $this->applogger->addInfo("GET /auth/whoami", array('usermail'=>$user->usermail));
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
    $this->applogger->addInfo("POST /auth/register", array('usermail' => $usermail, 'username' => $username));

    $mapper = new UserMapper($this->db);

    $user = $mapper->getByUsermail($usermail);
    if ($user) {
        $this->applogger->addNotice("POST /auth/register - user already exists", array('usermail' => $usermail));
        $newresponse = $response->withStatus(409);
    } else {
        $registrationcode = $mapper->checkUserStaged($usermail);

        if($registrationcode){
            $this->applogger->addDebug("POST /auth/register - user already staged", array('usermail' => $usermail));
        } else {
            $registrationcode = $mapper->createUserStaged($usermail, $username, $encpass);
            if($registrationcode) {
                $this->applogger->addDebug("POST /auth/register - user staged", array('usermail' => $usermail));
            }
        }

        if($registrationcode){
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
                $this->applogger->addCritical("POST /auth/register - confirmation code not sent", array('usermail' => $usermail, 'errorinfo' => $mail->ErrorInfo));
                $newresponse = $response->withJson($mail->ErrorInfo, 201);
            } else {
                $this->applogger->addDebug("POST /auth/register - confirmation code sent", array('usermail' => $usermail));
                $newresponse = $response->withStatus(201);
            }
        } else {
            $this->applogger->addError("POST /auth/register - user not staged", array('usermail' => $usermail));
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

    $this->applogger->addInfo("POST /auth/confirm", array('usermail'=>$usermail));

    $mapper = new UserMapper($this->db);
    $user = $mapper->confirmUser($usermail, $registrationcode);

    if($user){
        $this->applogger->addDebug("POST /auth/confirm - confirmation success", array('usermail'=>$usermail));
        $newresponse = $response->withJson($user, 201);
    } else {
        $this->applogger->addDebug("POST /auth/confirm - confirmation fail", array('usermail'=>$usermail));
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
        $this->applogger->addInfo("PUT /auth/user - standard user", array('userid'=>$userid));

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

                $this->applogger->addDebug("PUT /auth/user - update success", array('usermail'=>$usermail));

                $newresponse = $response->withJson($repdata,200);
            }
        } catch (Exception $e){
            $this->applogger->addError("PUT /auth/user - user update fail", array('userid'=>$userid, 'error'=>$e));
            $newresponse = $response->withStatus(400);
        }
    } else if($request->getAttribute("token")->user->administrator) {
        $this->applogger->addInfo("PUT /auth/user - administrator", array('adminid'=>$userid, 'userid'=>$internalid));

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
            $this->applogger->addError("PUT /auth/user - administrator update fail", array('admin'=>$userid, 'userid'=>$internalid, 'error'=>$e));
            $newresponse = $response->withStatus(400);
        }
    } else {
        $this->applogger->addInfo("PUT /auth/user - error, not user, not administrator", array('userid'=>$internalid));
        $newresponse = $response->withStatus(403);
    }
    return $newresponse;
});

// Forgot password
$app->post('/auth/forgotpass', function(Request $request, Response $response) {

    $data = $request->getParsedBody();
    $usermail = filter_var($data['usermail'], FILTER_SANITIZE_STRING);
    $this->applogger->addInfo("POST /auth/forgotpass", array('usermail'=>$usermail));

    $mapper = new UserMapper($this->db);

    $user = $mapper->getByUsermail($usermail);
    if ($user) {
        $requestcode = $mapper->checkUserStagedForgot($usermail);

        if($requestcode){
            $this->applogger->addDebug("POST /auth/forgotpass - user already staged", array('usermail' => $usermail));
        } else {
            $requestcode = $mapper->createUserStagedForgot($user->getInternalid(),$usermail,$user->getUsername());
            if($requestcode) {
                $this->applogger->addDebug("POST /auth/forgotpass - user staged", array('usermail' => $usermail));
            }
        }

        if($requestcode){
            $username = $user->getUsername();

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

            $mail->Subject = '[nendoroids-db.net] A new password has been requested for your account at Nendoroids-db.net';
            $mail->Body    =  "Dear $username,<br>".
                "Somebody has requested a new password for your account with your email <strong>$usermail</strong>. ".
                "If you are at the origin of this request, please confirm it, you will have to enter the following code in the appropriate page (the one you have reached just after your request...<br>".
                "<br>".
                "<i>Confirmation code:</i> <code>$requestcode</code><br>".
                "<br>".
                "If you are not at the origin of this request you have just to ignore this mail and the request will be deleted in few days automatically.<br>".
                "<br>".
                "If you have closed the page with the confirmation form, you can go to <a href=\"https://www.nendoroids-db.net/#/confirmforgot\">the confirmation page</a> and enter your email and the confirmation code.<br>".
                "<br>".
                "See you soon at Nendoroids-db.net.";
            $mail->AltBody =  "Dear $username, \r\n".
                "\r\n".
                "Somebody has requested a new password for your account with your email <$usermail>. ".
                "If you are at the origin of this request, please confirm it, you will have to enter the following code in the appropriate page (the one you have reached just after your request...\r\n".
                "\r\n".
                "Confirmation code: $requestcode\r\n".
                "\r\n".
                "If you are not at the origin of this request you have just to ignore this mail and the request will be deleted in few days automatically..\r\n".
                "\r\n".
                "If you have closed the page with the confirmation form, you can go to <https://www.nendoroids-db.net/#/confirmforgot> (the confirmation page) and enter your email and the confirmation code.\r\n".
                "\r\n".
                "See you soon at Nendoroids-db.net.\r\n";

            if(!$mail->send()) {
                $this->applogger->addCritical("POST /auth/forgotpass - confirmation code not sent", array('usermail' => $usermail, 'errorinfo' => $mail->ErrorInfo));
                $newresponse = $response->withJson($mail->ErrorInfo, 201);
            } else {
                $this->applogger->addDebug("POST /auth/forgotpass - confirmation code sent", array('usermail' => $usermail));
                $newresponse = $response->withStatus(201);
            }
        } else {
            $this->applogger->addError("POST /auth/forgotpass - user not staged", array('usermail' => $usermail));
            $newresponse = $response->withStatus(500);
        }
    } else {
        $this->applogger->addDebug("POST /auth/register - user not exists", array('usermail' => $usermail));
        $newresponse = $response->withStatus(404);
    }

    return $newresponse;
});

// Confirm forgot
$app->post('/auth/confirmforgot', function(Request $request, Response $response) {

    $data = $request->getParsedBody();
    $usermail = filter_var($data['usermail'], FILTER_SANITIZE_STRING);
    $requestcode = filter_var($data['requestcode'], FILTER_SANITIZE_STRING);

    $this->applogger->addInfo("POST /auth/confirmforgot", array('usermail'=>$usermail));

    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $newpassword = ''; $i < 8; $i++) {
        $index = rand(0, $count - 1);
        $newpassword .= mb_substr($chars, $index, 1);
    }

    $encpass = base64_encode(base64_encode(base64_encode($usermail.$newpassword.A_SALT)));

    $mapper = new UserMapper($this->db);
    $result = $mapper->confirmUserForgot($usermail, $requestcode, $encpass);

    if($result){
        $this->applogger->addDebug("POST /auth/confirmforgot - confirmation success", array('usermail'=>$usermail));

        $user = $mapper->getByUsermail($usermail);
        $username = $user->getUsername();

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

        $mail->Subject = '[nendoroids-db.net] Your new password for Nendoroids-db.net';
        $mail->Body    =  "Dear $username,<br>".
            "You have requested a new password for Nendoroids-db.net.<br>".
            "<br>".
            "<i>This new password is:</i> <code>$newpassword</code><br>".
            "<br>".
            "You can go to <a href=\"https://www.nendoroids-db.net/#/login\">the login page</a> and enter it to access your account.<br>".
            "<br>".
            "Please change this temporary password as soon as possible.<br>".
            "<br>".
            "See you soon at Nendoroids-db.net.";
        $mail->AltBody =  "Dear $username, \r\n".
            "\r\n".
            "You have requested a new password for Nendoroids-db.net.\r\n".
            "\r\n".
            "This new password is: $newpassword\r\n".
            "\r\n".
            "You can go to <https://www.nendoroids-db.net/#/login> (the login page) and enter it to access your account.\r\n".
            "\r\n".
            "Please change this temporary password as soon as possible.\r\n".
            "\r\n".
            "See you soon at Nendoroids-db.net.\r\n";

        if(!$mail->send()) {
            $this->applogger->addCritical("POST /auth/confirmforgot - new password not sent", array('usermail' => $usermail, 'errorinfo' => $mail->ErrorInfo));
            $newresponse = $response->withJson($mail->ErrorInfo, 201);
        } else {
            $this->applogger->addDebug("POST /auth/confirmforgot - new password sent", array('usermail' => $usermail));
            $newresponse = $response->withStatus(201);
        }
    } else {
        $this->applogger->addDebug("POST /auth/confirmforgot - confirmation fail", array('usermail'=>$usermail));
        $newresponse = $response->withStatus(403);
    }

    return $newresponse;
});

