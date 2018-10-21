<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 20.10.2018
 * Time: 18:41
 */

class SignatureTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var string
     */
    private $alg = 'sha256';

    /**
     * @var
     */
    private $header;

    /**
     * @var
     */
    private $payload;

    /**
     * @var \ITBWTJohnnyJWT\Helpers\AuthConfig
     */
    private $config;

    /**
     * @var
     */
    private $payloadWithData;

    /**
     * @var  \ITBWTJohnnyJWT\Helpers\Base64
     */
    private $coder;

    /**
     *
     */
    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $this->coder = new \ITBWTJohnnyJWT\Helpers\Base64();
        $this->config = new \ITBWTJohnnyJWT\Helpers\AuthConfig();
        $this->header = $this->coder->encode(json_encode(["alg" => "HS256","typ" =>  "JWT"]));
        $this->payload = $this->coder->encode(json_encode(["iat" =>  1516239022]));
        $this->payloadWithData = json_encode(["iat" =>  1516239022, 'user_id' => 3, 'role_id' => 2]);
    }

    /**
     *
     */
    public function testGetSignature()
    {
        $signature = new \ITBWTJohnnyJWT\Signature($this->config->getAlg(), $this->header, $this->payload, $this->config->getSecret());

        $this->assertEquals('ygbbkdw2ZRJSTyNSL5o8fKNLngAIQTkGsDCM8g6sGrg', $this->coder->encode($signature->getSignature()));
        $this->assertEquals('ygbbkdw2ZRJSTyNSL5o8fKNLngAIQTkGsDCM8g6sGrg', $this->coder->encode((string)$signature));
    }
}