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
use GuzzleHttp\Command\Guzzle;
use GuzzleHttp\Client;
use Facebook\Client as FacebookClient;
use Facebook\Api\Session;
use GuzzleHttp\Subscriber\Mock;
class ClientTestCase extends \PHPUnit_Framework_TestCase
{
    const CLIENT_CLASS = "\\Facebook\\Client";
    const GUZZLE_CLIENT_CLASS = "\\GuzzleHttp\\Command\\Guzzle\\GuzzleClient";

    protected static $jsonSchema;
    
    protected $client;
    protected static $guzzleClient;
    protected static $facebookClient;
    protected static $apiSession;

    private function getDescription()
    {
        return new Guzzle\Description(self::$jsonSchema);
    }
    
    public static function setUpBeforeClass()
    {
        self::$jsonSchema = json_decode(file_get_contents(JSON_SCHEMA), true);
        self::$guzzleClient = new Guzzle\GuzzleClient(new Client, new Guzzle\Description(self::$jsonSchema));
        self::$apiSession = new Session(FACEBOOK_CLIENT_ID, FACEBOOK_CLIENT_SECRET);
        self::$facebookClient = new FacebookClient(self::$apiSession, self::$guzzleClient);
    }

    protected function getGuzzleClient()
    {
        return self::$guzzleClient;
    }

    public static function tearDownAfterClass()
    {
        self::$jsonSchema = null;
    }

    protected function getSession()
    {
        return self::$apiSession;
    }

    protected function getFacebookClient()
    { 
        return self::$facebookClient;
    }
}
