<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 11.10.2018
 * Time: 21:37
 */

namespace ITBWTJohnnyJWT;


use ITBWTJohnnyJWT\Helpers\Base64;

class TokenVerify
{
    private $token;

    private $secret;

    private $explode;

    private $signature;

    private $alg = 'sha256';

    public function __construct()
    {
    }

    /**
     * @param $secret
     * @return TokenVerify
     */
    public function setSecret($secret) : self
    {
        $this->secret = $secret;

        return $this;
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
        $this->explode();
        $this->buildSignature();

        return $this->compare();
    }

    /**
     *
     */
    private function buildSignature() : void
    {
        $this->signature = (new Signature($this->alg, $this->explode[0], $this->explode[1], $this->secret))->getSignature();
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
     * @return bool
     */
    private function compare() : bool
    {
        return $this->signature === $this->explode[2];
    }
}