<?php
/**
 * JsonFileFilder.php
 */

namespace Facebook\Collections;

class JsonFileFinder extends FiletypeFilterIterator
{
    public function __construct($path)
    {
        parent::__construct(new \FilesystemIterator($path), 'json');
    }
}
