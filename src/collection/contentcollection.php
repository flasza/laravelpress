<?php
/*
 *    Wordpress Content Collection
 *
 *    Written by Christopher Baptista
 */

namespace Asianchris\Laravelpress;

use Illuminate\Database\Eloquent\Collection as Collection;

class ContentCollection extends Collection {
    public function __construct(array $items = array())
	{
        for($i=0; $i<count($items); $i++) {
            $items[$i]->tags = $this->getTags($items[$i]);
        }
		$this->items = $items;
	}

    protected function getTags($item) {
        $tags = array();

        $tags[] = $item->ID;
        $tags[] = $item->post_title;

        return $tags;
    }

}
