<?php

/**
 * PostBuilder
 *
 */

namespace Asianchris\Laravelpress;

use Illuminate\Database\Eloquent\Builder as Builder;
use Illuminate\Support\Facades\Config as Config;
use Illuminate\Support\Facades\DB as DB;

class ContentBuilder extends Builder
{

    public function status($postStatus)
    {
        return $this->where('post_status', $postStatus);
    }


    public function published()
    {
        return $this->status('publish');
    }


    public function type($type)
    {
        return $this->where('post_type', $type);
    }


    public function slug($slug)
    {
        return $this->where('post_name', $slug);
    }

    public function categorySlug($slug) {
        return $this->getTaxonomy($slug, 'category');
    }
    public function tagSlug($slug) {
        return $this->getTaxonomy($slug, 'post_tag');
    }

    private function getTaxonomy($slug, $taxonomy) {
        $rel = Config::get("laravelpress::database.prefix")."term_relationships";
        $tax = Config::get("laravelpress::database.prefix").'term_taxonomy';
        $term = Config::get("laravelpress::database.prefix").'terms';
        $post = Config::get("laravelpress::database.prefix").'posts';

        return $this->whereExists(function($query) use ($rel, $tax, $term, $post, $slug, $taxonomy){
            $query->select(DB::raw(1))
                ->from( $term )
                ->join( $tax , $term.'.term_id', '=', $tax.'.term_id' )
                ->join( $rel , $rel.'.term_taxonomy_id', '=', $tax.'.term_taxonomy_id' )
                ->where( $tax.'.taxonomy', '=', $taxonomy )
                ->where( $term.'.slug', '=', $slug )
                ->whereRaw( $post.'.ID = '.$rel.'.object_id' );
        });
    }
}
