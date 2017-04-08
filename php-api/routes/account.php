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
        $newresponse = $response->withJson(null,401);
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

        $newresponse = $response->withJson(null,401);
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

            $newresponse = $response->withJson($registrationcode, 201);
        } else {
            $this->applogger->addInfo("User ($usermail/$username) failled to register...");
            $newresponse = $response->withStatus(500);
        }
    }

    return $newresponse;
});

// Confirm
$app->get('/auth/confirm', function(Request $request, Response $response) {

    $data = $request->getParsedBody();
    $usermail = filter_var($request->getQueryParam('usermail'), FILTER_SANITIZE_STRING);
    $registrationcode = filter_var($request->getQueryParam('registrationcode'), FILTER_SANITIZE_STRING);

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
