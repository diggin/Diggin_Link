<?php

namespace DigginTest\Link;

use DOMDocument;
use DOMXPath;
use Psr\Link\LinkInterface;
use Diggin\Link\DomLinkProvider;

use PHPUnit\Framework\TestCase;

class DomLinkProviderTest extends TestCase
{
    /**
     * @var DomLinkProvider
     */
    private $linkCollection;

    public function setUp()
    {
        $html = file_get_contents(__DIR__.'/_files/sample-html.html');

        $dom = new DOMDocument('1.0');
        $dom->loadHTML($html);
        $domXpath = new DOMXPath($dom);
        $this->linkCollection = new DomLinkProvider($domXpath);
    }

    public function testFindByGetLinksMethod()
    {
        $links = $this->linkCollection->getLinks();

        $this->assertNotEmpty($links);

        // check 1st link   <link rel="alternate" href="/topic/rss" type="application/rss+xml">
        $first = $links->current();
        $this->assertInstanceOf(LinkInterface::class, $first);
        $this->assertArrayHasKey('type', $first->getAttributes());
        $this->assertSame('application/rss+xml', $first->getAttributes()['type']);
        $this->assertSame('/topic/rss', $first->getHref());
        $this->assertSame('alternate', current($first->getRels()));
    }

    public function testFindByGetLinksByRelMethod()
    {
        $links = $this->linkCollection->getLinksByRel('stylesheet');

        $this->assertNotEmpty($links);

        $this->assertTrue($links->valid());
        $first = $links->current();
        $this->assertInstanceOf(LinkInterface::class, $first);
        $this->assertSame('/bootstrap/css/bootstrap.min.css', $first->getHref());
        $this->assertSame('stylesheet', current($first->getRels()));
    }
}