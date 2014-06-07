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
        return $this->whereExists(function($query) use ($slug, $taxonomy){
            $query->select(DB::raw(1))
                ->from( 'terms' )
                ->join( 'term_taxonomy' , 'terms.term_id', '=', 'term_taxonomy.term_id' )
                ->join( 'term_relationships' , 'term_relationships.term_taxonomy_id', '=', 'term_taxonomy.term_taxonomy_id' )
                ->where( 'term_taxonomy.taxonomy', '=', $taxonomy )
                ->where( 'terms.slug', '=', $slug )
                ->whereRaw( DB::getTablePrefix().'posts.ID = '.DB::getTablePrefix().'term_relationships.object_id' );
        });
    }
}
