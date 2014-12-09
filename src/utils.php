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
use Doctrine\Common\Collections\ArrayCollection;
use ConnorVG\Transform\Transform;

function transformResult(array $object, array $types = [], array $aliases = []) {
    return new Result(Transform::make($object, $types, $aliases));
}

function mapResult(array $objects, array $types = [], array $aliases = []) {
    $fn = function($x) use ($types, $aliases) {
        return transformResult($x, $types, $aliases);
    };
    
    return new ArrayCollection(array_map($fn, $objects));
}

function parseQs($query) {
    $qs = [];
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

function jsonLoads($path) {
    return json_decode(file_get_contents($path), true);
}

function jsonToPhp($path) {
    return toPhpFile(jsonFileNameToPhpFileName($path), fromJsonFile($path));;
}

function fromJsonFile($path) {
    return json_decode(file_get_contents($path), true);
}

function jsonFileNameToPhpFileName($path) {
    return preg_replace('/(\.json)$/', '.php', $path);
}

function toPhpFile($outfile, array $php) {
    $content = "<?php\n\nreturn " . var_export($php, true) . ";";
    return file_put_contents($outfile, $content);
}
