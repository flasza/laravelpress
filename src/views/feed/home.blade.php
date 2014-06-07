@extends( Config::get("laravelpress::settings.layout") )

@section('meta')
    <title>{{ Option::getOption('blogname') }}</title>
@stop

@section('content')
    @include('laravelpress::includes.feed')
@stop
