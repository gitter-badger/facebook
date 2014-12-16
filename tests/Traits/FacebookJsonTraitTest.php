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

namespace Facebook\Tests\Traits;
use \Facebook\Tests\ClientTestCase;
use Facebook\Client;

class FacebookJsonTraitTest extends ClientTestCase
{
    protected $session;

    protected function setUp()
    {
        $this->session = new Traitor;
    }
    
    protected function tearDown()
    {
        $this->session = $this->session = null;
    }
     
    public function testJsonSerializeReturnsArray()
    {
        $result = $this->session->jsonSerialize();
        return $this->assertInternalType('array', $result);
    }

    public function testJsonEncodeReturnsJson()
    {
        $result = $this->session->jsonSerialize();
        return $this->assertJsonStringEqualsJsonString(json_encode($result), json_encode($this->session));
    }

    public function testToJsonReturnsValidJson()
    {
        $result = $this->session->toJson();
        return $this->assertJsonStringEqualsJsonString(json_encode($this->session), $result);
    }
  
    public function testInvokeReturnsArray()
    {
        $sess = $this->session;
        return $this->assertEquals($this->session->jsonSerialize(), $sess());
    }
    

    public function testToString()
    {
        return $this->assertEquals(json_encode($this->session), $this->session->__toString());
    }
}
