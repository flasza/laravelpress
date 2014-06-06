@if( count($gallery) > 0 )
<div class="lp-gallery">
    @foreach($gallery as $media)
    <div class="lp-gallery-item"><img src="{{ $media->guid }}" @if($media->post_image_alt) alt="{{$media->post_image_alt}}" @endif /></div>
    @endforeach
</div>
@endif
