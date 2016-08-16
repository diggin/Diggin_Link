<?php

namespace Diggin\Link;

use Psr\Link\LinkInterface;

class Link implements LinkInterface
{
    /**
     * @var string
     */
    private $href;

    /**
     * @var bool
     */
    private $isTemplated;

    /**
     * @var array
     */
    private $rels;

    /**
     * @var array
     */
    private $attributes;

    public function __construct($href = '', $isTemplated = false, $rels = [], $attributes = [])
    {
        $this->href = $href;
        $this->isTemplated = $isTemplated;
        $this->rels = $rels;
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
    public function isTemplated()
    {
        return $this->isTemplated;
    }

    /**
     * @inheritdoc
     */
    public function getRels()
    {
        return $this->rels;
    }

    /**
     * @inheritdoc
     */
    public function getAttributes()
    {
        return $this->attributes;
    }
}