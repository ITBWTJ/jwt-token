<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 14.10.2018
 * Time: 01:14
 */

namespace ITBWTJohnnyJWT;


use ITBWTJohnnyJWT\Exceptions\ITBWTJohnnyJWTException;
use ITBWTJohnnyJWT\Helpers\AuthConfig;

class AuthorizationService
{
    /**
     * @var
     */
    private $config;

    /**
     * @var
     */
    private $userId;

    /**
     * @var TokenBuilder
     */
    private $tokenBuilder;

    /**
     * @var TokenVerify
     */
    private $tokenVerify;

    /**
     * AuthorizationService constructor.
     */
    public function __construct()
    {
        $this->config = new AuthConfig();
    }

    /**
     * @param int $userId
     * @return AuthorizationService
     */
    public function setUserId(int $userId) : self
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return string
     * @throws Exceptions\NotSetConfigException
     * @throws Exceptions\TokenException
     */
    public function auth(): string
    {
        $this->initTokenBuilder();
        $token = $this->tokenBuilder
            ->buildToken()
            ->getToken();

        return $token;
    }

    /**
     * @param string $token
     * @return bool
     */
    public function verify(string $token): bool
    {
        $this->initTokenVerify();
        $this->tokenVerify->setToken($token);

        return $this->tokenVerify->verify();
    }

    /**
     *
     */
    private function initTokenBuilder()
    {
        $this->tokenBuilder = new TokenBuilder();
        $this->tokenBuilder->setConfig($this->config);
    }

    /**
     *
     */
    private function initTokenVerify()
    {
        $this->tokenVerify = new TokenVerify();
        $this->tokenVerify->setConfig($this->config);
    }


}