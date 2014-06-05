<?php
/*
 *    Wordpress Content Collection
 *
 *    Written by Christopher Baptista
 */

namespace Asianchris\Laravelpress;

use Illuminate\Database\Eloquent\Collection as Collection;
use Illuminate\Support\Facades\Config as Config;
use Illuminate\Support\Facades\DB as DB;

class ContentCollection extends Collection {
    public function __construct(array $items = array())
	{
        for($i=0; $i<count($items); $i++) {
            if( $items[$i]->post_type == "post" ) {
                $items[$i]->post_tags = $this->getTags($items[$i]);
            }
        }
		$this->items = $items;
	}

    protected function getTags($item) {
        $tags = array();

        $rel = Config::get("laravelpress::database.prefix")."term_relationships";
        $tax = Config::get("laravelpress::database.prefix").'term_taxonomy';
        $term = Config::get("laravelpress::database.prefix").'terms';
        $data = DB::table( $rel )
            ->join( $tax , $rel.".term_taxonomy_id", "=", $tax.".term_taxonomy_id" )
            ->join( $term , $tax.".term_id", "=", $term.".term_id")
            ->where( $rel.'.object_id', $item->ID )
            ->where( $tax.'.taxonomy', 'post_tag' )
            ->select( $term.'.term_id', $term.'.name', $term.'.slug')
            ->remember(5)
            ->get();

        foreach($data as $dat) {
            $tags[] = $dat;
        }

        return $tags;
    }

}
