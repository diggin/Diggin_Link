<?php

namespace Diggin\Link;

use Psr\Http\Link\LinkInterface;

class Link implements LinkInterface
{
    private $href;
    private $rel;
    private $attributes;

    public function __construct($href = null, $rel = null, $attributes = [])
    {
        $this->href = $href;
        $this->rel = $rel;
        $this->attributes = $attributes;
    }

    /**
     * @inheritdoc
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @inheritdoc
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * @inheritdoc
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}