<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 14.10.2018
 * Time: 01:15
 */

namespace ITBWTJohnnyJWT\Helpers;


class AuthConfig
{
    /**
     * @var string
     */
    private $secret = 'secret';

    /**
     * @var string
     */
    private $alg = 'sha256';

    /**
     * Minutes
     * @var string
     */
    private $ttl = '30';

    /**
     * @return string
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * @param int $ttl
     */
    public function setTtl(int $ttl)
    {
        $this->ttl = $ttl;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret(string $secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return mixed
     */
    public function getAlg()
    {
        return $this->alg;
    }

    /**
     * @param mixed $alg
     */
    public function setAlg(string $alg)
    {
        $this->alg = $alg;
    }



}