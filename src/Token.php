<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 10.10.2018
 * Time: 22:16
 */

namespace ITBWTJohnnyJWT;

use ITBWTJohnnyJWT\Exceptions\NotSetConfigException;
use ITBWTJohnnyJWT\Exceptions\NotSetSecretException;
use ITBWTJohnnyJWT\Exceptions\TokenException;
use ITBWTJohnnyJWT\Helpers\AuthConfig;
use ITBWTJohnnyJWT\Helpers\Base64;

class Token
{

    private $secret;

    private $header;

    private $payload;

    private $signature;

    private $token;

    /**
     * @var Base64
     */
    private $coder;

    /**
     * @var AuthConfig
     */
    private $config;


    public function __construct()
    {
        $this->coder = new Base64();
    }

    /**
     * @param $config
     * @return Token
     */
    public function setConfig($config): self
    {
        $this->config = $config;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getHeader() : string
    {
        return $this->header;
    }

    /**
     * @param string $header
     * @return Token
     */
    public function setHeader(string $header) : self
    {
        $this->header = $this->coder->encode($header);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayload() : string
    {
        return $this->payload;
    }

    /**
     * @param string $payload
     * @return $this
     */
    public function setPayload(string $payload)
    {
        $this->payload = $this->coder->encode($payload);
//        dd($this->payload, $payload);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }


    /**
     * @throws NotSetConfigException
     * @throws TokenException
     */
    public function create() : void
    {
        $this->checkParams();
        $this->addSignature();
        $this->token = $this->header . '.' . $this->payload . '.' . $this->signature;
    }

    /**
     * @throws NotSetConfigException
     * @throws TokenException
     */
    private function checkParams()
    {
        if (empty($this->payload)) {
            throw new TokenException('Need set Payload');
        }

        if (empty($this->header)) {
            throw new TokenException('Need set Header');
        }

        if (empty($this->config)) {
            throw new NotSetConfigException('Need set config classs - '. AuthConfig::class);
        }
    }

    /**
     * @return Token
     */
    private function addSignature() : self
    {
        $this->signature = $this->coder->encode(new Signature($this->config->getAlg(), $this->header, $this->payload, $this->config->getSecret()));

        return $this;
    }





}