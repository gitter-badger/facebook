<?php
/**
 * Session.php
 */

namespace Facebook\Api;
use Facebook\Traits\JsonTrait;


final class Session extends \ArrayObject implements \JsonSerializable
{
    use JsonTrait;
    
    final public function __construct($client_id, $client_secret)
    {
        parent::__construct(get_defined_vars());
    }
    
    final public function offsetSet($name, $value)
    {
        throw new \LogicException(sprintf('Cannot set %s to %s. %s is immutable.', $name, $value, __CLASS__));
    }

    final public function offsetUnset($name)
    {
        throw new \LogicException(sprintf('Cannot unset %s. %s is immutable', $name, __CLASS__));
    }
}
