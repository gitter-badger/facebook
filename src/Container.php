<?php
/**
 * Short description for Container.php
 */

namespace Facebook;
use Pimple\Container as BaseContainer;
use GuzzleHttp\Client as BaseClient;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Subscriber\Log\LogSubscriber;
use GuzzleHttp\Subscriber\Log\SimpleLogger;
use GuzzleHttp\Event\Emitter;

use Facebook\jsonLoads;

class Container extends BaseContainer
{
    public function __construct(FilteredFilesystemIterator $configDir = null)
    {
        parent::__construct();

        $this['guzzle.client'] = function($c) {
            return new BaseClient;
        };
        
        $this['guzzle.emitter'] = function($c) {
            return new Emitter;
        };
        
        $this['guzzle.config'] = function($c) {
            return array(
                'defaults' => array(),
                'emitter' => $c['guzzle.emitter']
            );
        };
        
        $this['guzzle.logger.file'] = function($c) {
            return fopen(__DIR__ . '/../log/facebook.log', 'a');
        };

        $this['guzzle.logger'] = function($c) {
            return new LogSubscriber($c['guzzle.logger.file']);
        };
        
        $this['guzzle.description'] = $this->protect(function($path) {
            return new Description(jsonLoads($path));
        });

        if(null === $configDir) {
            $configDir = new FilteredFilesystemIterator(__DIR__ . '/../config', 'json');
        }

        foreach($configDir as $path => $fileInfo) {
            $basename = $fileInfo->getBaseName('.json');
            
            $this[$basename] = function($c) use ($path) {
                return new GuzzleClient($c['guzzle.client'], $c['guzzle.description']($path), $c['guzzle.config']);
            };

            $this["$basename.client"] = function($c) use ($basename) {
                return new Client($c[$basename], getenv('FACEBOOK_CLIENT_ID'), getenv('FACEBOOK_CLIENT_SECRET'));
            };
        }
    }
}
