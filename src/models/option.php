<?php
/*
 *    Wordpress Posts
 *
 *    Written by Christopher Baptista
 */

namespace Asianchris\Laravelpress;

use Illuminate\Support\Facades\Config as Config;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Option extends Eloquent {
    protected $table = "options";

    protected $primaryKey = 'option_id';

    public function __construct( array $attributes = array() ) {
        $this->connection = Config::get("laravelpress::settings.database_connection");
    }


    public function newQuery($excludeDeleted = true)
    {
        $builder = new OptionBuilder($this->newBaseQueryBuilder());
        $builder->setModel($this)->with($this->with);

        if ($excludeDeleted and $this->softDelete) {
            $builder->whereNull($this->getQualifiedDeletedAtColumn());
        }

        return $builder;
    }
}
