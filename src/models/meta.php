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
    protected $table = 'postmeta';

    protected $primaryKey = 'ID';

    public function __construct( array $attributes = array() ) {
        $this->connection = Config::get("laravelpress::settings.database_connection");
    }

}
