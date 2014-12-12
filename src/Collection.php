<?php
/**
 * Collection.php
 */

namespace Facebook;
use Doctrine\Common\Collections\ArrayCollection;
use Facebook\JsonTrait;

class Collection extends ArrayCollection implements \JsonSerializable
{
    use JsonTrait; 
}
