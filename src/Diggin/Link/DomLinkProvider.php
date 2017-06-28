<?php

declare(strict_types=1);

namespace Diggin\Link;

use DOMXPath;
use Psr\Link\LinkProviderInterface;

final class DomLinkProvider implements LinkProviderInterface
{
    /**
     * @var DOMXPath
     */
    protected $domXpath;

    private $links;

    private $linksByRel;

    /**
     * DomLinkProvider constructor.
     * @param DOMXPath $domXpath
     */
    public function __construct(DOMXPath $domXpath)
    {
        $this->domXpath = $domXpath;
    }

    /**
     * @inheritdoc
     */
    public function getLinks()
    {
        if (!$this->links) {
            $links = new Links(new DOMNodeListIterator($this->domXpath->query('/html/head//link')));
            $this->links = $links;
        }

        $this->links->rewind();

        return $this->links;
    }

    /**
     * @inheritdoc
     */
    public function getLinksByRel($rel)
    {
        if (!$this->linksByRel) {
            $domNodeList = $this->domXpath->query("/html/head//link[@rel='$rel']");
            if ($domNodeList->length > 0) {
                $this->linksByRel = new Links(new DOMNodeListIterator($domNodeList));
            } else {
                $this->linksByRel = new Links(new \EmptyIterator());
            }
        }

        $this->linksByRel->rewind();

        return $this->linksByRel;
    }
}
