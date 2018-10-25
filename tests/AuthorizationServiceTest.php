<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 25.10.2018
 * Time: 22:12
 */

class AuthorizationServiceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws \ITBWTJohnnyJWT\Exceptions\NotSetConfigException
     * @throws \ITBWTJohnnyJWT\Exceptions\TokenException
     */
    public function testValidAuth()
    {
        $authService = new \ITBWTJohnnyJWT\AuthorizationService();
        $userId = 12;

        $token = $authService->setData(['user_id' => $userId])->auth();

        $this->assertTrue(is_string($token));
        $this->assertTrue($authService->verify($token));
    }

    /**
     * @throws \ITBWTJohnnyJWT\Exceptions\NotSetConfigException
     * @throws \ITBWTJohnnyJWT\Exceptions\TokenException
     */
    public function testNotValidAuth()
    {
        $authService = new \ITBWTJohnnyJWT\AuthorizationService();
        $userId = 12;

        $token = $authService->setData(['user_id' => $userId])->auth();
        $wrongToken = $token . 'asfasfs';
        $this->assertFalse($authService->verify($wrongToken));
    }
}