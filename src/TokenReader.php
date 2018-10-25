<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 25.10.2018
 * Time: 22:26
 */

namespace ITBWTJohnnyJWT;


use ITBWTJohnnyJWT\Helpers\Base64;
use test\Mockery\Adapter\Phpunit\BaseClassStub;

class TokenReader
{
    private $token;

    private $payload;

    private $coder;

    private $data;

    /**
     * TokenReader constructor.
     */
    public function __construct()
    {
        $this->coder = new Base64();
    }

    /**
     * @param string $token
     * @return TokenReader
     */
    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }


    /**
     *
     */
    public function read()
    {
        $this->explodePayload();
        $this->readPayload();
    }

    /**
     * @param $name
     * @return bool
     */
    public function get($name)
    {
        if (!empty($this->data[$name])) {
            return $this->data[$name];
        }

        return null;
    }

    /**
     *
     */
    private function readPayload()
    {
        $json = $this->coder->decode($this->payload);
        $this->data = json_decode($json, true);
    }


    /**
     *
     */
    private function explodePayload(): void
    {
        $explode = explode('.', $this->token);
        $this->payload = $explode[1];
    }


}