<?php

/**
 * PostBuilder
 *
 */

namespace Asianchris\Laravelpress;

use Illuminate\Database\Eloquent\Builder as Builder;

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

    public function paginate($perPage = 10, $currentPage = 1)
    {
        $skip = $currentPage * $perPage - $perPage;
        return $this->skip($skip)->take($perPage)->get();
    }
}
