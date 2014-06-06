@extends( Config::get("laravelpress::view.layout") )

@section('meta')
    <title>{{ $post->post_title }} | {{ Option::getOption('blogname') }}</title>
@stop

@section('content')
<div id='lp-content' class='lp-post'>
    <h1>{{ $post->post_title }}</h1>

    {{ $post->post_author->display_name }}

    {{ $post->post_content }}

    @if( count($post->post_tags) > 0 )
        @include('laravelpress::includes.tags', array('tags'=>$post->post_tags))
    @endif
</div>
@stop
