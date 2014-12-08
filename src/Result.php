<?php
/**
 * Result.php
 */
namespace Facebook;


class Result extends \ArrayObject implements \JsonSerializable
{
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function toJson()
    {
        return json_encode($this->jsonSerialize());
    }

    public function __toString()
    {
        return $this->toJson();
    }

    public function toArray()
    {
        return $this->getArrayCopy();
    } 
}
