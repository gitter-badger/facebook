<?php
/**
 * Guzzler.php
 */
namespace Facebook\Traits;
use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;

trait Guzzler
{

    public function buildClient(array $jsonSchema, array $config = [])
    {
        return new GuzzleClient(new Client, $this->configFromFile($jsonSchema), $config);
    }

    private function configFromFile($path)
    {
       
        if(file_exists($path) && pathinfo($path, PATHINFO_EXTENSION) === 'json') {
            $path = new Description(json_decode(file_get_contents($path), true));
        }
        
        throw new \InvalidArgumentException('could not convert to array');
    }   
}
