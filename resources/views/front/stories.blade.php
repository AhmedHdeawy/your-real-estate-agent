@section('style')
<style>
    .stories.facesnap .story>.item-link {
        text-decoration: none;
        color: #333
    }

    .stories.facesnap .story>.item-link>.item-preview {
        border-radius: 50%;
        padding: 2px;
        background: #3b5998
    }

    .stories.facesnap .story>.item-link>.item-preview img {
        border-radius: 50%;
        border: 3px solid #fff
    }

    .stories.facesnap .story.seen {
        opacity: .7
    }

    .stories.facesnap .story.seen>a>.item-preview {
        background: #423c6f
    }
</style>

@endsection

<div class='row text-center'>
    <div class='col-md-10 mx-auto'>
        <h2 class="mb-5 color-rbzgo"> {{ __('lang.stories') }} </h2>
        <div id="stories" class="storiesWrapper"></div>

    </div>
</div>

@section('script')
<script src="https://ramon.codes/demo/zuck.js/dist/zuck.min.js"></script>
<script>
    var timestamp = function(){
        var timeIndex=0;
        var shifts=[35,60,60*3,60*60*2,60*60*25,60*60*24*4,60*60*24*10];
        var now=new Date();
        var shift=shifts[timeIndex++]||0;
        var date=new Date(now-shift*1000);
        return date.getTime()/1000;
    }

</script>

<script>

    /**
    * Build Story Items from DB
    */
    function buildStoryItems(Zuck) {
        let storItems = [];
        @foreach ($stories as $story)

            storItems.push(

                Zuck.buildTimelineItem(
                    '{{ $story->id }}',
                    '{{ $story->user->avatar ? "/uploads/users/" . $story->user->avatar : "/images/user.png" }}',
                    '{{ $story->user->name }}',
                    '',
                    '{{ $story->updated_at }}',
                    [
                        @foreach ($story->items as $item)
                            [
                                '{{ $item->id }}',
                                '{{ $item->type }}',
                                '{{ $item->length }}',
                                '/uploads/stories/{{ $item->media }}',
                                '',
                                false,
                                false,
                                '{{ $item->updated_at }}',
                            ],
                        @endforeach
                    ]
                ),
            );
        @endforeach

        return storItems;

    }

    var stories = new Zuck('stories', {
    backNative: true,
    previousTap: true,
    skin: "FaceSnap",
    autoFullScreen: true,
    avatars: true,
    paginationArrows: true,
    list: false,
    cubeEffect: false,
    localStorage: true,
    rtl: {{ $currentLangDir == 'rtl' ? 'true' : 'false' }},
    stories: buildStoryItems(Zuck)
    });
</script>
@endsection
