<?php
/**
 * FilteredFilesystemIterator.php
 */

namespace Facebook\Collections;

class FiletypeFilterIterator extends \FilterIterator
{
    private $ext;

    public function __construct(\FilesystemIterator $itr, $ext)
    {
        parent::__construct($itr);
        $this->ext = $ext;
    } 

    public function accept()
    {
        return $this->current()->getExtension() === $this->ext;
    }
}
