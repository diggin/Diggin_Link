<?php

declare(strict_types=1);

namespace Diggin\Link;

use Iterator;
use DOMNodeList;

final class DOMNodeListIterator implements Iterator
{
    private $position = 0;
    private $domNodeList;

    public function __construct(DOMNodeList $domNodeList)
    {
        $this->domNodeList = $domNodeList;
    }

    public function current()
    {
        return $this->domNodeList->item($this->key());
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return $this->position < $this->domNodeList->length;
    }

    public function rewind()
    {
        $this->position = 0;
    }
}
