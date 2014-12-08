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
