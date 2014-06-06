<?php

class LaravelPressController extends BaseController {
    public function Home() {
        $posts = Post::published()->paginate();

        return View::make('laravelpress::feed.home', array('posts'=>$posts));
    }

    public function Content($slug = null)
    {
        $post = Content::slug( $slug )->published()->first();

        if( $post != null ){
            $post->post_content = $this->setGallery( $post->post_content );

            if($post->post_type == 'post') {
                return View::make('laravelpress::content.post', array('post'=>$post));
            } else {
                return View::make('laravelpress::content.page', array('page'=>$post));
            }
        }

        return "NOTHING";
    }
    public function Category($slug) {
        $posts = Post::categorySlug($slug)->published()->paginate();
        return View::make('laravelpress::feed.home', array('posts'=>$posts));
    }
    public function Tag($slug) {
        $posts = Post::tagSlug($slug)->published()->paginate();
        return View::make('laravelpress::feed.home', array('posts'=>$posts));
    }

    private function setGallery($content) {
        $regex = "/\[gallery ids=\"(.*?)\"\]/";
        preg_match_all($regex, $content, $matches);

        for($i = 0; $i < count($matches[1]); $i++)
        {
            $match = $matches[1][$i];
            $ids = explode(',', $match);
            $media = array();
            foreach($ids as $id) {
                $media[] = Media::find($id);
            }
            $newValue = View::make('laravelpress::includes.gallery' )->with('gallery', $media)->render();
            $content = str_replace($matches[0][$i], $newValue, $content);
        }
        return $content;
    }
}
