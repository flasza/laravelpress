<?php
/*
 *    Wordpress Posts
 *
 *    Written by Christopher Baptista
 */

namespace Asianchris\Laravelpress;

use Illuminate\Support\Facades\Config as Config;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Content extends Eloquent {
    protected $table = "posts";

    protected $primaryKey = 'ID';

    protected $hidden = array('ping_status','post_password','comment_count', 'post_mime_type', 'post_content_filtered', 'pinged', 'to_ping');

    public function __construct( array $attributes = array() ) {
        $this->connection = Config::get("laravelpress::settings.database_connection");
        //$this->table = Config::get("laravelpress::database.prefix")."posts";
    }


    public function newCollection(array $models = array())
    {
        return new ContentCollection($models);
    }


    public function newQuery($excludeDeleted = true)
    {
        $builder = new ContentBuilder($this->newBaseQueryBuilder());
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
