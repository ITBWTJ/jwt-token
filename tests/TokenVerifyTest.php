<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 20.10.2018
 * Time: 19:04
 */

class TokenVerifyTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \ITBWTJohnnyJWT\TokenVerify
     */
    private $verifyObj;

    public  function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {

        $this->verifyObj = new \ITBWTJohnnyJWT\TokenVerify();
        $this->verifyObj->setSecret('secret');
    }

    public function testVerifySuccess()
    {
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE1MTYyMzkwMjJ9.ygbbkdw2ZRJSTyNSL5o8fKNLngAIQTkGsDCM8g6sGrg';
        $this->verifyObj->setToken($token);
        $this->assertTrue($this->verifyObj->verify());
    }

    /**
     *
     */
    public function testVerifyFailed()
    {
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE1MTYyfQ.ygbbkdw2ZRJSTyNSL5o8fKNLngAIQTkGsDCM8g6sGrg';
        $this->verifyObj->setToken($token);
        $this->assertNotTrue($this->verifyObj->verify());
    }

    public function testVerifyTokenWithoutSecret()
    {
        $header = json_encode(["alg" => "HS256","typ" =>  "JWT"]);
        $payload = json_encode(["iat" =>  1516239022]);
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


        $tokenObj
            ->create();

        $fakeToken = $tokenObj->getToken();

        $verifyObj->setToken($originToken);
        $this->assertTrue($verifyObj->verify());

        $verifyObj->setToken($fakeToken);
        $this->assertNotTrue($verifyObj->verify());



    }
}