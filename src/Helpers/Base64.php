<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 10.10.2018
 * Time: 23:18
 */

namespace ITBWTJohnnyJWT\Helpers;

class Base64
{
    /**
     * @param string $data
     * @return string
     */
    public function encode(string $data) : string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * @param string $data
     * @return string
     */
    public function decode(string $data) : string
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
}