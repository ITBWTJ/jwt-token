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

    private $header;

    private $payload;

    private $config;

    public  function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->header = json_encode(["alg" => "HS256","typ" =>  "JWT"]);
        $this->payload = json_encode(["iat" =>  time(), 'exp' => time() + 3600]);
        $this->config = new \ITBWTJohnnyJWT\Helpers\AuthConfig();
        $this->verifyObj = new ITBWTJohnnyJWT\TokenVerify();
        $this->verifyObj->setConfig($this->config);
    }

    /**
     * @throws \ITBWTJohnnyJWT\Exceptions\NotSetConfigException
     * @throws \ITBWTJohnnyJWT\Exceptions\TokenException
     */
//    public function testVerifySuccess()
//    {
//
//        $tokenObj = new \ITBWTJohnnyJWT\Token();
//        $verifyObj = new \ITBWTJohnnyJWT\TokenVerify();
//        $verifyObj->setConfig($this->config);
//
//        $tokenObj->setConfig($this->config)
//            ->setHeader($this->header)
//            ->setPayload($this->payload)
//            ->create();
//
//        $originToken = $tokenObj->getToken();
//        $verifyObj->setToken($originToken);
//        $this->assertTrue($verifyObj->verify());
//
//
//    }

    /**
     *
     */
//    public function testVerifyFailed()
//    {
//        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.auMjFnpM704c_YRViyTIEI93XETIb9lMFSqMzvmEXyc';
//        $this->verifyObj->setToken($token);
//        $this->assertNotTrue($this->verifyObj->verify());
//    }

    /**
     * @throws \ITBWTJohnnyJWT\Exceptions\NotSetConfigException
     * @throws \ITBWTJohnnyJWT\Exceptions\TokenException
     */
    public function testVerifyTokenWithoutSecret()
    {
        $tokenObj = new \ITBWTJohnnyJWT\Token();
        $verifyObj = new \ITBWTJohnnyJWT\TokenVerify();
        $verifyObj->setConfig($this->config);

        $tokenObj->setConfig($this->config)
            ->setHeader($this->header)
            ->setPayload($this->payload)
            ->create();

        $originToken = $tokenObj->getToken();
        $verifyObj->setToken($originToken);
        $this->assertTrue($verifyObj->verify());

        $this->config->setSecret('');
        $tokenObj->create();

        $fakeToken = $tokenObj->getToken();

        $verifyObj->setToken($fakeToken);

//        $this->assertNotTrue($verifyObj->verify());
        $this->config->setSecret('secret');
    }

    /**
     * @throws \ITBWTJohnnyJWT\Exceptions\NotSetConfigException
     * @throws \ITBWTJohnnyJWT\Exceptions\TokenException
     */
    public function testCheckExpirationFailed()
    {
        $this->payload = json_encode(["iat" =>  time() - 1000, 'exp' => time() - 500]);
        $tokenObj = new \ITBWTJohnnyJWT\Token();
        $verifyObj = new \ITBWTJohnnyJWT\TokenVerify();
        $verifyObj->setConfig($this->config);

        $tokenObj->setConfig($this->config)
            ->setHeader($this->header)
            ->setPayload($this->payload)
            ->create();

        $token = $tokenObj->getToken();

        $verifyObj->setToken($token);
        $this->assertFalse($verifyObj->verify());
    }

    /**
     * @throws \ITBWTJohnnyJWT\Exceptions\NotSetConfigException
     * @throws \ITBWTJohnnyJWT\Exceptions\TokenException
     */
    public function testCheckExpirationNotFailed()
    {
        $this->payload = json_encode(["iat" =>  time(), 'exp' => time() + 500]);
        $tokenObj = new \ITBWTJohnnyJWT\Token();
        $verifyObj = new \ITBWTJohnnyJWT\TokenVerify();
        $verifyObj->setConfig($this->config);

        $tokenObj->setConfig($this->config)
            ->setHeader($this->header)
            ->setPayload($this->payload)
            ->create();

        $token = $tokenObj->getToken();

        $verifyObj->setToken($token);
        $this->assertTrue($verifyObj->verify());
    }

}