<?php

namespace DigginTest\Link;

use DOMDocument;
use DOMXPath;
use Diggin\Link\DomLinkCollection;

use PHPUnit_Framework_TestCase;

class DomLinkCollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var DomLinkCollection
     */
    private $linkCollection;

    public function setUp()
    {
        $html = file_get_contents(__DIR__.'/_files/sample-html.html');

        $dom = new DOMDocument('1.0');
        $dom->loadHTML($html);
        $domXpath = new DOMXPath($dom);
        $this->linkCollection = new DomLinkCollection($domXpath);
    }

    public function testFindByGetLinksMethod()
    {
        $links = $this->linkCollection->getLinks();

        $this->assertNotEmpty($links);

        // check 1st link   <link rel="alternate" href="/topic/rss" type="application/rss+xml">
        $first = $links->current();
        $this->assertInstanceOf('Psr\\Http\Link\\LinkInterface', $first);
        $this->assertArrayHasKey('type', $first->getAttributes());
        $this->assertSame('application/rss+xml', $first->getAttributes()['type']);
        $this->assertSame('/topic/rss', $first->getHref());
        $this->assertSame('alternate', $first->getRel());
    }

    public function testFindByGetLinksByRelMethod()
    {
        $links = $this->linkCollection->getLinksByRel('stylesheet');

        $this->assertNotEmpty($links);

        $this->assertTrue($links->valid());
        $first = $links->current();
        $this->assertInstanceOf('Psr\\Http\Link\\LinkInterface', $first);
        $this->assertSame('/bootstrap/css/bootstrap.min.css', $first->getHref());
        $this->assertSame('stylesheet', $first->getRel());
    }

}