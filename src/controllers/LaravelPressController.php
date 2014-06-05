<?php

class LaravelPressController extends BaseController {

    public function Home($slug = null)
    {
        $post = Content::slug( $slug )->published()->first();

        if( $post != null )
            return $post->toJson();

        return "NOTHING";
    }

}
