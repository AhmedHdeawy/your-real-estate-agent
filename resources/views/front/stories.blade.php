@section('style')
<style>
    .stories.list .story>.item-link {
        text-align: {{ $currentLangDir == 'rtl' ? 'right' : 'left' }} !important
    }
    .stories.facesnap .story {
        margin-left: .25rem !important;
        margin-right: .25rem !important;
    }

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

    .stories.list .story>.item-link>.item-preview {
        background: #423c6f;
        height: 60px !important;
        width: 60px !important;
        max-width: 60px !important;
    }

    .stories.list .story>.item-link>.info {
        margin-left: .5rem!important;
        margin-right: .5rem!important;
    }
    .stories.list .story>.item-link>.info .name {
        font-weight: bold !important
    }

    #zuck-modal-content .story-viewer .head .left .info *,
    #zuck-modal-content .story-viewer .head .back,
    #zuck-modal-content .story-viewer .head .right .close,
    #zuck-modal-content .story-viewer .head .right .time {
        color: #FFF;
        opacity: 1;
    }

    #zuck-modal-content .story-viewer .head .right .close {
        font-size: 50px;
        margin: 0 20px;
    }

    #zuck-modal-content .story-viewer .head .left {
        float: {{ $currentLangDir == 'rtl' ? 'right' : 'left' }} !important;
    }

    #zuck-modal-content .story-viewer .head .right {
        float: {{ $currentLangDir == 'rtl' ? 'left' : 'right' }} !important;
    }

    .add_new_story_container {
        display: inline-block;
    }
    .add_new_story {
        display: inline-block;
        width: 90px;
        height: 90px;
        margin: 0 6px;
        line-height: 100px;
        border: 2px solid #363062;
        border-radius: 50%;
        margin-right: .25rem;
        margin-left: .25rem;
        background: #f5f5f5;
    }

    @media(max-width: 1024px) {

        #zuck-modal-content .story-viewer .head .left {
            float: {{ $currentLangDir == 'rtl' ? 'right' : 'left' }} !important;
        }
        #zuck-modal-content .story-viewer .head .right {
            float: {{ $currentLangDir == 'rtl' ? 'left' : 'right' }} !important;
        }
        #zuck-modal-content .story-viewer .head .left {
            margin: 15px 12px !important;
        }
        #zuck-modal-content .story-viewer .head .left .back {
            margin: -9px -20px 0 !important;
        }
        #zuck-modal-content .story-viewer.with-back-button .head .left .item-preview {
            margin-left: 0px !important
        }
    }
</style>

@endsection

<div class='row text-center'>
    <div class='col-md-3 mx-auto'>
        <h2 class="mb-5 color-rbzgo"> {{ __('lang.stories') }} </h2>
        <div id="stories" class="storiesWrapper">
            <div class="add_new_story_container">
                <button class="add_new_story" href="#">
                    <i class="fas fa-plus fa-2x color-rbzgo" aria-hidden="true"></i>
                </button>
            </div>
        </div>

    </div>
</div>

@section('script')

<script src="{{ asset('vendors/zuck/zuck.js') }}"></script>

<script>
    function timestamp(){
        var timeIndex=0;
        var shifts=[35,60,60*3,60*60*2,60*60*25,60*60*24*4,60*60*24*10];
        var now=new Date();
        var shift=shifts[timeIndex++]||0;
        var date=new Date(now-shift*1000);
        return date.getTime()/1000;
    }

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
                    '{{ $story->created_at->diffForHumans() }}',
                    [
                        @foreach ($story->items as $item)
                            [
                                '{{ $item->id }}',
                                '{{ $item->type }}',
                                '{{ $item->length }}',
                                '/uploads/stories/{{ $item->media }}',
                                '',
                                '',
                                false,
                                false,
                                timestamp(),
                            ],
                        @endforeach
                    ]
                ),
            );
        @endforeach

        return storItems;
    }

    console.log(buildStoryItems(Zuck));

    var stories = new Zuck('stories', {
    backNative: true,
    previousTap: true,
    skin: "FaceSnap",
    autoFullScreen: true,
    avatars: true,
    list: true,
    cubeEffect: true,
    localStorage: false,
    rtl: {{ $currentLangDir == 'rtl' ? 'true' : 'false' }},
    stories: buildStoryItems(Zuck),
    language: {
        unmute: '{{ __('lang.unmute') }}',
        keyboardTip: '{{ __('lang.keyboardTip') }}',
        visitLink: '{{ __('lang.visitLink') }}',
            time: {
            ago:'{{ __('lang.ago') }}',
            hour:'{{ __('lang.hour') }}',
            hours:'{{ __('lang.hours') }}',
            minute:'{{ __('lang.minute') }}',
            minutes:'{{ __('lang.minutes') }}',
            fromnow: '{{ __('lang.fromnow') }}',
            seconds:'{{ __('lang.seconds') }}',
            yesterday: '{{ __('lang.yesterday') }}',
            tomorrow: '{{ __('lang.tomorrow') }}',
            days:'{{ __('lang.days') }}',
        }
    }
    });

    console.log(stories);

</script>
@endsection