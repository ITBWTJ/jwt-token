<?php

include_once 'vendor/autoload.php';

//$client = new \Predis\Client('tcp://127.0.0.1:6379');
//$client->auth('root');
//$client->set('foo', 'bar');
//$value = $client->get('foo');
//var_dump($value);


//$tokenBuilder = new \ITBWTJohnnyJWT\TokenBuilder();
//
//try {
//    $secret = 'secret';
//    $tokenBuilder->setSecret($secret)->buildToken();
//    $token = $tokenBuilder->getToken();
//    var_dump($token);
//    $verifyToken = new \ITBWTJohnnyJWT\TokenVerify();
//    $verify = $verifyToken->setSecret($secret)->setToken($token)->verify();
//    var_dump($verify);
//} catch (\ITBWTJohnnyJWT\Exceptions\ITBWTJohnnyJWTException $e) {
//    echo $e->getMessage();
//}
