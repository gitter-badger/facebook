<?php
/**
 * Session.php
 */

namespace Facebook;

class Session implements \JsonSerializable
{
    private $client_id;
    private $client_secret;

    final public static function fromEnv()
    {
        return new self(getenv('FACEBOOK_CLIENT_ID'), getenv('FACEBOOK_CLIENT_SECRET'));
    }
    
    final public static function fromJson($path)
    {
        list($clientId, $clientSecret)=json_decode(file_get_contents($path), true);
        return new self($clientId, $clientSecret);
    }

    final public static function factory($clientId, $clientSecret)
    {
        return new self($clientId, $clientSecret);
    }

    final private function __construct($clientId, $clientSecret)
    {
        $this->client_id = $clientId;
        $this->client_secret = $clientSecret;
    }

    final public function __invoke()
    {
        return get_object_vars($this);
    }

    final public function jsonSerialize()
    {
        return $this();
    }

    final public function __toString()
    {
        return json_encode($this());
    }

    final private function get($name)
    {
        return getenv(strtoupper($name));
    }
}
