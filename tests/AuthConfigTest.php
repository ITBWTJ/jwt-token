<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 22.10.2018
 * Time: 04:10
 */

class AuthConfigTest extends \PHPUnit\Framework\TestCase
{
    public function testAlg()
    {
        $conf = new \ITBWTJohnnyJWT\Helpers\AuthConfig();

        // check default alg value
        $this->assertNotNull($conf->getAlg());

        // check sets alg value
        $conf->setAlg('bcrypt');
        $this->assertEquals('bcrypt', $conf->getAlg());
    }

    public function testSecret()
    {
        $conf = new \ITBWTJohnnyJWT\Helpers\AuthConfig();

        // check default secret value
        $this->assertNotNull($conf->getSecret());

        // check sets secret value
        $conf->setSecret('newsecret');
        $this->assertEquals('newsecret', $conf->getSecret());
    }

    public function testTtl()
    {
        $conf = new \ITBWTJohnnyJWT\Helpers\AuthConfig();

        // check default ttl value
        $this->assertNotNull($conf->getTtl());

        // check sets ttl value
        $conf->setTtl(60);
        $this->assertEquals(60, $conf->getTtl());
    }
}