<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 11.10.2018
 * Time: 21:40
 */

namespace ITBWTJohnnyJWT;


use ITBWTJohnnyJWT\Helpers\Base64;

class Signature
{
    /**
     * @var
     */
    private $signature;

    /**
     * Signature constructor.
     * @param string $alg
     * @param $header
     * @param $payload
     * @param $secret
     */
    public function __construct($alg, $header, $payload, $secret)
    {
        $this->signature = hash_hmac($alg, $header . '.' . $payload, $secret, true);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getSignature();
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }
}