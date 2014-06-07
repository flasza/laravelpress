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
            $items[$i]->post_author = Author::find( $items[$i]->post_author );
        }
		$this->items = $items;
	}
    protected function getAttachment($item) {
        $alt = Meta::where('post_id', $item->ID)->where('meta_key','_wp_attachment_image_alt')->first();
        if($alt != null) { $item->post_image_alt = $alt->meta_value; }
        return $item;
    }

    protected function getPost($item) {

        $data = DB::table( 'term_relationships' )
            ->join( 'term_taxonomy' , "term_relationships.term_taxonomy_id", "=", "term_taxonomy.term_taxonomy_id" )
            ->join( 'terms' , "term_taxonomy.term_id", "=", "terms.term_id")
            ->where( 'term_relationships.object_id', $item->ID )
        //    ->where( $tax.'.taxonomy', 'post_tag' )
            ->select( 'terms.term_id as ID', 'terms.name', 'terms.slug', 'term_taxonomy.taxonomy')
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

        $thumb = Meta::where('post_id', $item->ID)->where('meta_key','_thumbnail_id')->first();
        if($thumb != null ) { $t = Media::find($thumb->meta_value); $item->post_thumbnail = $t->guid; }

        return $item;
    }

}
