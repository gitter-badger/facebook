<?php
/**
 * Facebook.php
 */

namespace Facebook;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use Facebook\Collections\Collection;
use Facebook\Api\Session;
use Facebook\Traits\Guzzler;

class Client
{
    use Guzzler;

    private $client;
    
    private $session;
    
    private $appAccessToken = null;

    public function __construct(Session $session, GuzzleClient $client)
    {
        $this->client = $client;
        $this->session = $session;
    }

    public function getAccessToken()
    {
        if($result = $this->getClient()->getAppAccessToken($this->getSession()->getArrayCopy())) {
            return isset($result['access_token']) ? $result['access_token'] : $result;
        }
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
        if(!$this->getClient()->getDescription()->hasOperation($method)) {
            return;
        }
        $arguments[0]['access_token'] = $this->getAccessToken();
        return $this->client->{$method}($arguments[0]);
    }
}
