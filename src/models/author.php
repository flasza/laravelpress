<?php
/*
 *    Wordpress Posts
 *
 *    Written by Christopher Baptista
 */

namespace Asianchris\Laravelpress;

use Illuminate\Support\Facades\Config as Config;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Author extends Eloquent {
    protected $table = 'users';

    protected $primaryKey = 'ID';

    protected $hidden = array('user_pass','user_activation_key');

    public function __construct( array $attributes = array() ) {
        $this->connection = Config::get("laravelpress::settings.database_connection");
    }

}
