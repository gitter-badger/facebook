<?php
/**
 * Traitor.php
 */

namespace Facebook\Tests\Traits;
use Facebook\Traits as T;

class Traitor extends \stdClass implements \JsonSerializable
{
    use T\JsonTrait; 
}
