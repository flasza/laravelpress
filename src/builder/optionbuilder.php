<?php

/**
 * PostBuilder
 *
 */

namespace Asianchris\Laravelpress;

use Illuminate\Database\Eloquent\Builder as Builder;

class OptionBuilder extends Builder
{

    public function option($name)
    {
        return $this->where('option_name', $name);
    }

    public function getOption($name) {
        $opt = $this->where('option_name', $name)->first();
        return $opt->option_value;
    }

}
