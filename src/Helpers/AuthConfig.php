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
    private $secret = 'secret';

    private $alg = 'sha256';

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
    public function setSecret($secret)
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
    public function setAlg($alg)
    {
        $this->alg = $alg;
    }


}