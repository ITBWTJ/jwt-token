<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 10.10.2018
 * Time: 22:23
 */

namespace ITBWTJohnnyJWT;

use ITBWTJohnnyJWT\Exceptions\NotSetConfigException;
use ITBWTJohnnyJWT\Exceptions\NotSetSecretException;
use ITBWTJohnnyJWT\Helpers\AuthConfig;

class TokenBuilder
{
    private $type = 'jwt';

    private $alg = 'HS256';

    private $token;

    private $exp;

    private $iss;

    private $sub;

    private $data;

    private $config;

    /**
     * @param AuthConfig $config
     * @return TokenBuilder
     */
    public function setConfig(AuthConfig $config): self
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return string
     */
    public function getType() : ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getAlg() : string
    {
        return $this->alg;
    }

    /**
     * @param string $alg
     */
    public function setAlg(string $alg)
    {
        $this->alg = $alg;
    }



    /**
     * @return mixed
     */
    public function getExp() : ?int
    {
        return $this->exp;
    }

    /**
     * @param mixed $exp
     */
    public function setExp(\DateTime $exp)
    {
        $this->exp = $exp;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIss() : ?string
    {
        return $this->iss;
    }

    /**
     * @param mixed $iss
     */
    public function setIss(string $iss)
    {
        $this->iss = $iss;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSub() : ?string
    {
        return $this->sub;
    }

    /**
     * @param mixed $sub
     */
    public function setSub(string $sub)
    {
        $this->sub = $sub;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getData() : ?array
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return int
     */
    private function getIat() : int
    {
        $time = time();

        return $time;
    }

    /**
     * TokenBuilder constructor.
     */
    public function __construct()
    {
        $this->token = new Token();
    }

    /**
     * @return TokenBuilder
     * @throws Exceptions\TokenException
     * @throws NotSetConfigException
     */
    public function buildToken() : self
    {
        $this->validateData();

        $this->token
            ->setConfig($this->config)
            ->setHeader($this->getHeader())
            ->setPayload($this->getPayload())
            ->create();

        return $this;
    }


    /**
     * @return string
     */
    public function getToken() : string
    {
        return $this->token->getToken();
    }

    /**
     * @throws NotSetConfigException
     */
    private function validateData() : void
    {
        $this->checkConfig();
    }

    /**
     *
     */
    private function checkConfig() : void
    {
        if (empty($this->config)) {
            throw new NotSetConfigException('Config Class for JWT token required');
        }
    }

    /**
     * @return string
     */
    private function getHeader() : string
    {
        return json_encode([
            'alg' => $this->alg,
            'typ' => $this->type,
        ]);
    }

    /**
     * @return sring
     */
    private function getPayload() : string
    {
        $payload = [];

        if ($this->iss) $payload = array_merge($payload, ['iss' => $this->getIss()]);
        if ($this->sub) $payload = array_merge($payload, ['sub' => $this->getSub()]);
        if ($this->exp) $payload = array_merge($payload, ['iss' => $this->getExp()]);
        if ($this->data) $payload = array_merge($payload, $this->getData());

        $payload['iat'] = $this->getIat();

        return json_encode($payload);
    }




}