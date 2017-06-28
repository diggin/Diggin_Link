<?php

declare(strict_types=1);

namespace Diggin\Link;

use Psr\Link\LinkInterface;

final class Link implements LinkInterface
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

    public function __construct(string $href = '', bool $isTemplated = false, array $rels = [], array $attributes = [])
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
