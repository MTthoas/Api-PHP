<?php

require __DIR__ . "/../../library/json-response.php";
require __DIR__ . "/../../library/request.php";
require __DIR__ . "/../../models/users.php";

$json = Request::getJsonBody();

$user = UserModel::getByEmail($json["email"]);

// Si l'user existe

if (!$user) {
    Response::json(400, [], ["success" => false, "error" => "Bad request"]);
    die();
}

// Comparaison de mot de passe

if ($json["password"] !== $user["password"]) {
    Response::json(400, [], ["success" => false, "error" => "Bad request"]);
    die();
}

// Création du TOKEN

$token = bin2hex(random_bytes(16));
$user["token"] = $token;

// Stock le token pour l'utilisateur

UserModel::updateById($user);

// 7. Renvoyer le token dans la réponse

Response::json(200, [], ["success" => true, "token" => $token]);



