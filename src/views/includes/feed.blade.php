@foreach($posts as $post)
    <div class="lp-feed-post">
        @if( $post->post_thumbnail )<div class="lp-feed-post-image"><a href="/{{$post->post_name}}"><img src="{{$post->post_thumbnail}}"/></a></div>@endif
        <div class="lp-feed-post-info">
            <a href="/{{$post->post_name}}">{{ $post->post_title}}</a>
            @if( $post->post_excerpt )
                <div class="lp-feed-post-excerpt">{{$post->post_excerpt}}</div>
            @endif
        </div>
    </div>
@endforeach
