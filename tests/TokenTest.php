<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 18.10.2018
 * Time: 22:47
 */

class TokenTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $config;

    /**
     * @var
     */
    private $header;

    /**
     * @var
     */
    private $payload;

    /**
     * @var
     */
    private $payloadWithData;

    /**
     *
     */
    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->config = $this->createMock(\ITBWTJohnnyJWT\Helpers\AuthConfig::class);
        $this->header = json_encode(["alg" => "HS256","typ" =>  "JWT"]);
        $this->payload = json_encode(["iat" =>  1516239022]);
        $this->payloadWithData = json_encode(["iat" =>  1516239022, 'user_id' => 3, 'role_id' => 2]);

        $this->config
            ->expects($this->any())
            ->method('getSecret')
            ->willReturn('testsecret2018');

        $this->config
            ->expects($this->any())
            ->method('getAlg')
            ->willReturn('sha256');




    }

    /**
     * @throws \ITBWTJohnnyJWT\Exceptions\NotSetConfigException
     * @throws \ITBWTJohnnyJWT\Exceptions\TokenException
     */
    public function testTokenCreate()
    {

        $tokenObj = new \ITBWTJohnnyJWT\Token();
        $tokenObj->setConfig($this->config)
            ->setHeader($this->header)
            ->setPayload($this->payload)
            ->create();

        $token = $tokenObj->getToken();

        $this->assertEquals('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE1MTYyMzkwMjJ9.a49FixANorROPxEum8sNXnNyokr7Y0zQ0dkwFCbzc34', $token);
    }

    /**
     * @throws \ITBWTJohnnyJWT\Exceptions\NotSetConfigException
     * @throws \ITBWTJohnnyJWT\Exceptions\TokenException
     * @expectedException  \ITBWTJohnnyJWT\Exceptions\TokenException
     */
    public function testNotSetPayload()
    {
        $tokenObj = new \ITBWTJohnnyJWT\Token();
        $tokenObj->setConfig($this->config)
            ->setHeader($this->header)
            ->create();

    }

    /**
     * @expectedException  \ITBWTJohnnyJWT\Exceptions\NotSetConfigException
     */
    public function testNotSetConfig()
    {
        $tokenObj = new \ITBWTJohnnyJWT\Token();
        $tokenObj->setHeader($this->header)
            ->setPayload($this->payload)
            ->create();

    }

    /**
     * @expectedException  \ITBWTJohnnyJWT\Exceptions\TokenException
     */
    public function testNotSetHeader()
    {
        $tokenObj = new \ITBWTJohnnyJWT\Token();
        $tokenObj->setConfig($this->config)
            ->setPayload($this->payload)
            ->create();

    }

    /**
     *
     */
    public function testSavingDataOnPayload()
    {

        $tokenObj = new \ITBWTJohnnyJWT\Token();
        $tokenObj->setConfig($this->config)
            ->setHeader($this->header)
            ->setPayload($this->payloadWithData)
            ->create();

        $token = $tokenObj->getToken();

        $this->assertEquals('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpYXQiOjE1MTYyMzkwMjIsInVzZXJfaWQiOjMsInJvbGVfaWQiOjJ9.iqt8anEdSzuNM4vpn891byZlLafdArzVxQ9rBdHuFQ4', $token);
    }
}