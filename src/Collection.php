<?php
/**
 * Collection.php
 */

namespace Facebook;
use Doctrine\Common\Collections\ArrayCollection;

class Collection extends ArrayCollection implements \JsonSerializable
{
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
