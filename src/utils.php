<?php
/**
 * Short description for utils.php
 *
 * @package utils
 * @author cfralick <cfralick@Beast.local>
 * @version 0.1
 * @copyright (C) 2014 cfralick <cfralick@Beast.local>
 * @license MIT
 */

namespace Facebook;
use Facebook\Collections\Collection;
use ConnorVG\Transform\Transform;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Log\LogSubscriber;

function clientFactory($descriptionLocation, array $config = []) {
    $description = new Description(jsonLoad($descriptionLocation));
    $client = new Client;
    $client->getEmitter()->attach(new LogSubscriber);
    return new GuzzleClient($client, $description, $config);
}


function path() {
    return join(DIRECTORY_SEPARATOR, func_get_args());
}

function abspath() {
    return realpath(call_user_func_array('path', func_get_args()));
}

function jsonLoads($data, $as = true) {
    $json = json_decode($data, $as);
    if(JSON_ERROR_NONE === json_last_error()) {
        return $json;
    }
    throw new \InvalidArgumentException('json_decode resulted in error %s', json_last_error());
}

function jsonLoad($resource, $as = true) {
    if($str = file_get_contents($resource)) {
        return jsonLoads($str, $as);
    }
    throw new \InvalidArgumentException('fail');
}

function jsonDumps(array $arr, $fmt = false) {
    $json = json_encode($arr, $fmt);
    if(JSON_ERROR_NONE === json_last_error()) {
        return $json;
    }
    throw new \InvalidArgumentException('fuck');
}

function jsonDump(\SplFileObject $resource, array $data) {
    if($json = jsonDumps($data)) {
        return $resource->fwrite($json);
    }
}

function jsonToPhp($path) {
    $rawPhp = jsonLoad($path);
    $phpFile = preg_replace('/(\.json)/', '.php', $path);
    return file_put_contents($phpFile, "<?php\n\nreturn " . var_export($rawPhp, true) . ";");
}

function transformResult(array $object, array $types = [], array $aliases = []) {
    return new Result(Transform::make($object, $types, $aliases));
}

function mapResult(array $objects, array $types = [], array $aliases = []) {
    $fn = function($x) use ($types, $aliases) {
        return transformResult($x, $types, $aliases);
    };
    
    return new Collection(array_map($fn, $objects));
}

function parseQs($query, $qs = []) {
    parse_str($query, $qs);
    return $qs;
}

function parseUrl($url) {
    $parsed = parse_url($url);
    if(array_key_exists('query', $parsed)) {
        $parsed['query'] = parseQs($parsed['query']);
    }
    return $parsed;
}
