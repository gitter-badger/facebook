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
    
    private $session;
    
    private $appAccessToken;

    public function __construct(Session $session, GuzzleClient $client)
    {
        $this->client = $client;
        $this->session = $session;
        $this->client->setConfig('defaults', $this->getAccessToken());
    }

    public function getAccessToken()
    {
        if(!$this->appAccessToken) {
            $params = $this->session->jsonSerialize();
            $this->appAccessToken = $this->client->getAppAccessToken($params);
        }
        return $this->appAccessToken;
    }

    public function getSession()
    {
        return $this->session;
    }

    public function getClient()
    {
        return $this->client;
    }
    
    public function __call($method, $arguments) 
    {
        if(!$this->client->getDescription()->hasOperation($method)) {
            return;
        }
        try {
            $result = call_user_func_array([$this->getClient(), $method], $arguments);
        } catch(\Exception $e) {
            $result = $e->getMessage();
        }
        return $result;
    }
}
