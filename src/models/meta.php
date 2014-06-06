<?php
/*
 *    Wordpress Posts
 *
 *    Written by Christopher Baptista
 */

namespace Asianchris\Laravelpress;

use Illuminate\Support\Facades\Config as Config;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Meta extends Eloquent {
    protected $table;

    protected $primaryKey = 'ID';

    public function __construct( array $attributes = array() ) {
        $this->table = Config::get("laravelpress::database.prefix")."postmeta";
    }

}
