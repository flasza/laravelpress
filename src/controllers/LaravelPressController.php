<?php

class LaravelPressController extends BaseController {

    public function Home($slug = null)
    {
        $post = Content::slug( $slug )->published()->first();

        return json_encode( $post );
    }

}
