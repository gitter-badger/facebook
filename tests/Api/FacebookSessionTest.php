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

namespace Facebook\Tests\Api;
use \Facebook\Tests\ClientTestCase;
use Facebook\Api\Session;

class FacebookSessionTest extends ClientTestCase
{
    private $object;

    protected function setUp()
    {
        $this->object = self::getSession();
    }
    
    protected function tearDown()
    {
        $this->object = null;
    }
    /**
     * @expectedException \LogicException
     */
    public function testOffsetSetThrowsException()
    {
        return $this->object['x'] = 'y';
    }

    /**
     * @expectedException \LogicException
     */
    public function testOffsetUnsetThrowsException()
    {
        unset($this->object['client_id']);
    }
    /**
     * @covers \Facebook\Api\Session::jsonSerialize
     */
    public function testJsonSerializeReturnsArray()
    {
        $this->assertInternalType('array', $this->object->jsonSerialize());
    }
    
    /**
     * @covers \Facebook\Api\Session::__invoke
     */
    public function testInvokeReturnsArray()
    {
        $session = $this->object;

        $this->assertInternalType('array', $session());
    }

    /**
     * @covers \Facebook\Api\Session::toJson
     */
    public function testToJsonReturnsJson()
    {
        $session = $this->object;
        $this->assertEquals(json_encode($session), $session->toJson());
    }


}
