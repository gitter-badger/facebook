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


class FacebookClientTest extends ClientTestCase
{
    protected function setUp()
    {
        $this->client = self::$container;
    }
    
    protected function tearDown()
    {
        $this->client = null;
    }

    public function testTest()
    {
        return $this->assertTrue(true);
    }
}
