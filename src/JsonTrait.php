<?php
/**
 * Result.php
 */
namespace Facebook;


trait JsonTrait
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
}
