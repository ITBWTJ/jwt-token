<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 18.10.2018
 * Time: 00:01
 */

class Base64Test extends \PHPUnit\Framework\TestCase
{
    private $testString = 'teststring2018';

    /**
     * @covers \ITBWTJohnnyJWT\Helpers\Base64::encode()
     */
    public function testEncode()
    {
        $base = new \ITBWTJohnnyJWT\Helpers\Base64();
        $encode = $base->encode($this->testString);
        $this->assertSame('dGVzdHN0cmluZzIwMTg', $encode);

        return $encode;
    }

    /**
     * @depends testEncode
     */
    public function testDecode($string)
    {
       $base = new \ITBWTJohnnyJWT\Helpers\Base64();

       $this->assertSame($this->testString, $base->decode($string));
    }
}