<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 14.10.2018
 * Time: 01:14
 */

namespace ITBWTJohnnyJWT;


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
     * @var
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
     * @param string $secret
     */
    public function setSecret(string $secret) : void
    {
        $this->config->setSecret($secret);
    }

    /**
     * @param string $alg
     */
    public function setAlg(string $alg) : void
    {
        $this->config->setAlg($alg);
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
     * @throws Exceptions\NotSetConfigException
     */
    public function auth(): string
    {
        $this->initTokenBuilder();
        $token = $this->tokenBuilder
            ->setConfig($this->config)
            ->buildToken()
            ->getToken();

        return $token;
    }

    /**
     *
     */
    private function initTokenBuilder()
    {
        $this->tokenBuilder = new TokenBuilder();
    }
}