<?php
/**
 * Result.php
 */
namespace Facebook\Traits;


trait JsonTrait
{
    public function jsonSerialize()
    {
        return (array) $this;
    }

    public function toJson($pretty = false)
    {
        return json_encode($this, $pretty);
    }

    public function __invoke()
    {
        return $this->jsonSerialize();
    }

    public function __toString()
    {
        return $this->toJson();
    }
}
