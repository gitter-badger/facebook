<?php
/**
 * FilteredFilesystemIterator.php
 */

namespace Facebook;

class FilteredFilesystemIterator extends \FilterIterator
{
    private $ext;

    public function __construct($itr, $ext)
    {
        parent::__construct(new \FilesystemIterator($itr));
        $this->ext = $ext;
    } 

    public function accept()
    {
        return $this->current()->getExtension() === $this->ext;
    }
}
