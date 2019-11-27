
@push ("load")
    @foreach ($response as $post)
        <div>
            <h3>{{$post->data->title}}</h3>
        </div>
        <div>
            <h5>{{$post->data->selftext}}</h5>

        </div>
        <div>
            @if (isset($post->data->post_hint))
                @if($post->data->post_hint == "image")
                    <img src= {{$post->data->url}} alt="image" style="width:250px;height:250px">
                @endif
            @endif

            @if ($post->data->is_video)
                <video width="320" height="240" controls>
                    <source src={{$post->data->media->reddit_video->fallback_url}} type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @endif
        </div>
        <hr>
    @endforeach
@endpush
