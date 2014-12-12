<?php
/**
 * Result.php
 */
namespace Facebook;
use nikic\iter\fn;

trait Paging
{
    public function pager($page = null)
    {
        $paging = isset($this['paging']) ?: [];
        return fn\index($page)($paging);
    }
}
