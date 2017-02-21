<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Login
$app->post('/auth/login', function(Request $request, Response $response) {

    $A_SALT = "Sel de Guérande";

    $data = $request->getParsedBody();
    $usermail = filter_var($data['usermail'], FILTER_SANITIZE_STRING);
    $password = filter_var($data['password'], FILTER_SANITIZE_STRING);
    $encpass = base64_encode(base64_encode(base64_encode($usermail.$password.$A_SALT)));
    $data['encpass'] = $encpass;
    $this->applogger->addInfo("User $usermail try to connect...");

    $mapper = new UserMapper($this->db);
    $user = $mapper->checkUser($usermail,$encpass);

    if($user){
        $now = new DateTime();
        $future = new DateTime("now +2 hours");
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

        $newresponse = $response->withJson($repdata);
    } else {
        $newresponse = $response->withJson(null,401);
    }

    return $newresponse;
});

// Whoami
$app->get('/auth/whoami', function(Request $request, Response $response) {
    $newresponse = $response->withJson($request->getAttribute("token")->user);
    return $newresponse;
});
