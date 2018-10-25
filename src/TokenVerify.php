<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 11.10.2018
 * Time: 21:37
 */

namespace ITBWTJohnnyJWT;

use ITBWTJohnnyJWT\Helpers\AuthConfig;
use ITBWTJohnnyJWT\Helpers\Base64;
use ITBWTJohnnyJWT\Exceptions\VerifyException;

class TokenVerify
{
    private $token;

    private $secret;

    private $explode;

    private $signature;

    /**
     * @var AuthConfig
     */
    private $config;

    private $error;

    private $payload;

    /**
     * @var Base64
     */
    private $coder;

    public function __construct()
    {
        $this->coder = new Base64();
    }

    /**
     * @param AuthConfig $config
     * @return TokenVerify
     */
    public function setConfig(AuthConfig $config) : self
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * @param string $token
     * @return TokenVerify
     */
    public function setToken(string $token) : self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return bool
     */
    public function verify()
    {
        try {
            $this->explode();
            $this->checkSignature();
            $this->checkTimeExpire();
        } catch (VerifyException $e) {
            $this->error = $e->getMessage();
//            var_dump($e->getMessage());die();
            return false;
        }

        return true;
    }

    /**
     * @throws VerifyException
     */
    private function checkSignature()
    {
        $this->buildSignature();
        $this->compareSignature();
    }

    /**
     * @throws VerifyException
     */
    private function checkTimeExpire()
    {
        $this->convertPayload();
        $this->compareTimeExpire();
    }

    /**
     *
     */
    private function buildSignature() : void
    {
        $this->signature = (new Signature($this->config->getAlg(), $this->explode[0], $this->explode[1], $this->config->getSecret()))->getSignature();

        $this->signature = (new Base64())->encode($this->signature);

    }

    /**
     *
     */
    private function explode()
    {

        $this->explode = explode('.', $this->token);
    }

    /**
     * @throws VerifyException
     */
    private function compareSignature()
    {

        if (!($this->signature === $this->explode[2])) {
            throw new VerifyException('Signature not equals');
        }
    }

    /**
     * @throws VerifyException
     */
    private function compareTimeExpire()
    {
        if (empty($this->payload['exp'])  || $this->payload['exp'] < time()) {
            throw new VerifyException('Expiration token');
        }
    }

    /**
     *
     */
    private function convertPayload()
    {
        $this->payload = json_decode($this->coder->decode($this->explode[1]), 1);
    }
}