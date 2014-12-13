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
use Pimple\Container;

class ClientTestCase extends \PHPUnit_Framework_TestCase
{
    protected static $container;
    
    protected $client;

    public static function setUpBeforeClass()
    {
        self::$container= new Container;
    }

    public static function tearDownAfterClass()
    {
        self::$container = null;
    }
}
