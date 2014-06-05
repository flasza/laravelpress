<?php

class LaravelPressController extends BaseController {

    public function Home($slug = null)
    {
        $post = Content::slug( $slug )->published()->remember(5)->first();

        if( $post != null )
            return $post->toJson();

        return "NOTHING";
    }

}
