<?php
/**
 * Facebook.php
 */

namespace Facebook;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use Facebook\Collection;


class Client
{
    private $client;
    private $clientId;
    private $clientSecret;
    private $appAccessToken;

    public function __construct(GuzzleClient $client, $clientId, $clientSecret)
    {
        $this->client = $client;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->appAccessToken = $this->getAppAccessToken($clientId, $clientSecret);
        $this->client->setConfig('defaults', $this->appAccessToken);
    }
    
    public function getAccessToken()
    {
        return isset($this->accessToken) ? $this->accessToken : $this->appAccessToken['access_token'];
    }

    private function getAppAccessToken($client_id, $client_secret)
    {
        return $this->client->getAppAccessToken(get_defined_vars());
    }
    
    public function debugToken($accessToken)
    {
        return $this->client->debugToken(array(
            'access_token' => $accessToken, 
            'input_token' => $this->appAccessToken['access_token']
        )); 
    }
}
