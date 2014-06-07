@extends( Config::get("laravelpress::settings.layout") )

@section('meta')
    <title>{{ $page->post_title }} | {{ Option::getOption('blogname') }}</title>
@stop

@section('content')
<div id='lp-content' class='lp-page'>
    <h1>{{ $page->post_title }}</h1>

    {{ $page->post_content }}
</div>

@stop
