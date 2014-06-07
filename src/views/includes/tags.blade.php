<div class='lp-tags'>
@foreach($tags as $tag)
<div class='lp-tag'><a href="/tag/{{$tag->slug}}">{{$tag->name}}</a></div>
@endforeach
</div>
