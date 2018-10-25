<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 25.10.2018
 * Time: 22:32
 */

class TokenReaderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var
     */
    private $authService;

    /**
     * @var
     */
    private $token;

    /**
     *
     */
    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->authService = new \ITBWTJohnnyJWT\AuthorizationService();
        $this->authService->setData(['user_id' => 42, 'user_role' => 12]);
        $this->token = $this->authService->auth();
    }

    /**
     *
     */
    public function testReadData()
    {
        $reader = new \ITBWTJohnnyJWT\TokenReader();
        $reader->setToken($this->token);
        $reader->read();

        $this->assertEquals(42, $reader->get('user_id'));
        $this->assertEquals(12, $reader->get('user_role'));
        $this->assertNull( $reader->get('admin'));
    }
}