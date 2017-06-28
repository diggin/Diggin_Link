<?php

declare(strict_types=1);

namespace Diggin\Link;

use IteratorIterator;

final class Links extends IteratorIterator
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
        $rels = [];
        $attributes = [];
        foreach ($node->attributes as $domAttr) {
            if (strlen($href) === 0 && $domAttr->name === 'href') {
                $href = $domAttr->value;
            } else if ($domAttr->name === 'rel') {
                $rels[] = $domAttr->value;
            } else {
                $attributes[$domAttr->name] = $domAttr->value;
            }
        }

        return new Link($href, false, $rels, $attributes);
    }
}
