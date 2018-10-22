<?php

include_once 'vendor/autoload.php';

//$client = new \Predis\Client('tcp://127.0.0.1:6379');
//$client->auth('root');
//$client->set('foo', 'bar');
//$value = $client->get('foo');
//var_dump($value);


$tokenBuilder = new \ITBWTJohnnyJWT\TokenBuilder();

try {
    $header = json_encode(["alg" => "HS256","typ" =>  "JWT"]);
    $payload = json_encode(["iat" =>  time()]);
    $config = new \ITBWTJohnnyJWT\Helpers\AuthConfig();
    $tokenObj = new \ITBWTJohnnyJWT\Token();
    $verifyObj = new \ITBWTJohnnyJWT\TokenVerify();
    $verifyObj->setSecret($config->getSecret());

    $tokenObj->setConfig($config)
        ->setHeader($header)
        ->setPayload($payload)
        ->create();

    $originToken = $tokenObj->getToken();

    $config->setSecret('');
    $tokenObj->create();

    $fakeToken = $tokenObj->getToken();

    $verifyObj->setToken($originToken);
    dd($verifyObj->verify());
} catch (\ITBWTJohnnyJWT\Exceptions\ITBWTJohnnyJWTException $e) {
    echo $e->getMessage();
}
