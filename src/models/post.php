<?php
/*
 *    Wordpress Posts
 *
 *    Written by Christopher Baptista
 */

namespace Asianchris\Laravelpress;

use Illuminate\Support\Facades\Config as Config;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Post extends Eloquent {
    protected $table;

    protected $primaryKey = 'ID';
    protected $postType = 'post';

    public function __construct( array $attributes = array() ) {
        $this->table = Config::get("laravelpress::database.prefix")."posts";
    }

    public function newQuery($excludeDeleted = true)
    {
        $builder = new PostBuilder($this->newBaseQueryBuilder());
        $builder->setModel($this)->with($this->with);
        $builder->orderBy('post_date', 'desc');

        if (isset($this->postType) and $this->postType) {
            $builder->type($this->postType);
        }

        if ($excludeDeleted and $this->softDelete) {
            $builder->whereNull($this->getQualifiedDeletedAtColumn());
        }

        return $builder;
    }

}
