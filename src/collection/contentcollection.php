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
                $items[$i] = $this->getPost($items[$i]);
            } elseif( $items[$i]->post_type == "attachment" ) {
                $items[$i] = $this->getAttachment($items[$i]);
            }
            $items[$i]->post_author = User::find( $items[$i]->post_author );
        }
		$this->items = $items;
	}
    protected function getAttachment($item) {
        $alt = Meta::where('post_id', $item->ID)->where('meta_key','_wp_attachment_image_alt')->first();
        if($alt != null) { $item->post_image_alt = $alt->meta_value; } 
        return $item;
    }

    protected function getPost($item) {

        $rel = Config::get("laravelpress::database.prefix")."term_relationships";
        $tax = Config::get("laravelpress::database.prefix").'term_taxonomy';
        $term = Config::get("laravelpress::database.prefix").'terms';
        $data = DB::table( $rel )
            ->join( $tax , $rel.".term_taxonomy_id", "=", $tax.".term_taxonomy_id" )
            ->join( $term , $tax.".term_id", "=", $term.".term_id")
            ->where( $rel.'.object_id', $item->ID )
        //    ->where( $tax.'.taxonomy', 'post_tag' )
            ->select( $term.'.term_id as ID', $term.'.name', $term.'.slug', $tax.'.taxonomy')
            ->get();

        $tags = array();
        $cats = array();

        foreach($data as $dat) {
            $tax = $dat->taxonomy; unset( $dat->taxonomy );
            if( $tax == 'post_tag' ){
                unset($dat->taxonomy);
                $tags[] = $dat;
            } elseif( $tax == 'category') {
                $cats[] = $dat;
            }
        }
        $item->post_tags = $tags;
        $item->post_categories = $cats;



        return $item;
    }

}
