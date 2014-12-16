<?php
/**
 * Short description for ProjectTestCase.php
 *
 * @package ProjectTestCase
 * @author cfralick <cfralick@Beast.local>
 * @version 0.1
 * @copyright (C) 2014 cfralick <cfralick@Beast.local>
 * @license MIT
 */

namespace Facebook\Tests;
use \Facebook\Tests\ClientTestCase;
use Facebook\Client;
use Facebook\Api\Session;

class FacebookClientTest extends ClientTestCase
{
    protected $session;

    protected function setUp()
    {
        $this->client = $this->getFacebookClient();
        $this->session = $this->client->getSession();
    }
    
    protected function tearDown()
    {
        $this->client = null;
        $this->session = null;
    }
    
   /**
    * @covers \Facebook\Client::getClient
    */ 
    public function testGetClient()
    {
        return $this->assertInstanceOf(get_class($this->getGuzzleClient()), $this->client->getClient());
    }

   /**
    * @covers \Facebook\Client::getSession
    */ 
    public function testGetSession()
    {
        return $this->assertInstanceOf("\\Facebook\\Api\\Session", $this->client->getSession());
    }
    /**
     * @covers \Facebook\Client::getAccessToken
     */
    public function testGetAccessToken()
    {
        return $this->assertInternalType('string', $this->client->getAccessToken());
    }
    /*
     * @covers \Facebook\Client::getAccessToken
     * @covers \Facebook\Client::__call
     */ 
    public function testCallReturnsArray()
    {
        return $this->assertInternalType('array', $this->client->page(['path' => ['mtv']]));
    }
    
    public function testCallReturnsApiData()
    {
        return $this->assertArrayHasKey('facebook_id', $this->client->page(['path' => ['mtv']]));
    }
    /**
     * @covers \Facebook\Client::__call
     * @covers \Facebook\Client::getAccessToken
     */    
    public function testCallNonexistentMethodReturnsNull()
    {
        return $this->assertNull($this->client->farts(['path' => ['mtv']]));
    }

}
