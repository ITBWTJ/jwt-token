<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 18.10.2018
 * Time: 00:31
 */

use ITBWTJohnnyJWT\TokenBuilder;

class TokenBuilderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException \ITBWTJohnnyJWT\Exceptions\NotSetConfigException
     */
    public function testNotSetConfig()
    {
        $tokenBuilder = new TokenBuilder();
        $tokenBuilder->buildToken();
    }


    public function testTokenReturn()
    {
        $tokenBuilder = new TokenBuilder();
        $config = new \ITBWTJohnnyJWT\Helpers\AuthConfig();
        $tokenBuilder->setConfig($config)->buildToken();


        $token = $tokenBuilder->getToken();

        $this->assertTrue(is_string($token));
    }

    public function testIat()
    {
        $tokenBuilder = new TokenBuilder();
        $class = new ReflectionClass($tokenBuilder);
        $method = $class->getMethod ('getIat');
        $method->setAccessible(true);
        $iat = $method->invoke ($tokenBuilder);

        $this->assertTrue(is_int($iat));
    }

    public function testExp()
    {
        $tokenBuilder = new TokenBuilder();
        $confMock = $this->createMock(\ITBWTJohnnyJWT\Helpers\AuthConfig::class);
        $confMock->method('getTtl')->willReturn(30);
        $tokenBuilder->setConfig($confMock);
        $class = new ReflectionClass($tokenBuilder);
        $method = $class->getMethod ('getExp');
        $method->setAccessible(true);
        $exp = $method->invoke ($tokenBuilder);

        $this->assertTrue(is_int($exp));
    }
}