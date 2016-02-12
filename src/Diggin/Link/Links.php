<?php
namespace Diggin\Link;

use IteratorIterator;

class Links extends IteratorIterator
{
    public function valid()
    {
        $node = parent::current();
        if (!$node instanceof \DOMElement) {
            return false;
        }

        return parent::valid();
    }

    public function current()
    {
        $node = parent::current();

        if (!$node instanceof \DOMElement) {
            return null;
        }

        if (!$node->hasAttributes()) {
            return new Link();
        }

        $href = '';
        if ($node->hasAttribute('href')) {
            $href = $node->getAttribute('href');
        }

        $rel = '';
        if ($node->hasAttribute('rel')) {
            $rel = $node->getAttribute('rel');
        }

        $attributes = [];
        foreach ($node->attributes as $domAttr) {
            if (in_array($domAttr->name, ['href', 'rel'])) {
                continue;
            }
            $attributes[$domAttr->name] = $domAttr->value;
        }

        return new Link($href, $rel, $attributes);
    }
}
