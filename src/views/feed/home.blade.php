@extends( Config::get("laravelpress::view.layout") )

@section('meta')
    <title>{{ Option::getOption('blogname') }}</title>
@stop

@section('content')
    @include('laravelpress::includes.feed')
@stop
