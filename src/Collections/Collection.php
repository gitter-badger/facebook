<?php
/**
 * Collection.php
 */

namespace Facebook\Collections;
use Doctrine\Common\Collections\ArrayCollection;
use Facebook\Traits\JsonTrait;


class Collection extends ArrayCollection implements \JsonSerializable
{
    use JsonTrait;

    public function __construct(array $data = array())
    {
        $data = array_map(function($i) { 
            return is_array($i) ? new Collection($i) : $i; 
        }, $data);
        parent::__construct($data);
    }
}
