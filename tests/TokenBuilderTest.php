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
}