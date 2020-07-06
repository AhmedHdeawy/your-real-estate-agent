@section('style')
<style>
    .stories.list .story>.item-link {
        text-align: {{ $currentLangDir=='rtl'? 'right': 'left' }} !important
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
        border: 3px solid #ececec
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
        margin-left: .5rem !important;
        margin-right: .5rem !important;
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
        float: {{ $currentLangDir=='rtl'? 'right': 'left' }} !important;
    }

    #zuck-modal-content .story-viewer .head .right {
        float: {{ $currentLangDir=='rtl'? 'left': 'right' }} !important;
    }

    .add_new_story_container {
        display: block;
        width: auto;
        margin: 6px;
        background-color: #f5f5f5;
        padding: 6px;
        border-radius: 15px;
        text-align: {{ $currentLangDir=='rtl'? 'right': 'left' }};
    }

    .add_new_story_container .user-avatar {
        background: #423c6f;
        height: 60px !important;
        width: 60px !important;
        max-width: 60px !important;
        vertical-align: top;
        display: inline-block;
        box-sizing: border-box;
        font-size: 0;
        overflow: hidden;
        margin-left: 12px;
        padding: 2px;
        border-radius: 50%;
    }

    .add_new_story_container .user-avatar img {
        display: block;
        box-sizing: border-box;
        height: 100%;
        width: 100%;
        background-size: cover;
        background-position: 50%;
        border: 3px solid #ececec;
    }

    .add_new_story_container .info {
        display: inline-block;
        line-height: 1.6em;
        overflow: hidden;
        text-overflow: ellipsis;
        vertical-align: top;
        text-align: {{ $currentLangDir=='rtl'? 'right': 'left' }}
    }

    .add_new_story_container .status_types {
        display: inline-block;
        line-height: 3.6em;
        overflow: hidden;
        text-overflow: ellipsis;
        float: {{ $currentLangDir=='rtl'? 'left': 'right' }}
    }

    .add_new_story_container .status_types i {
        cursor: pointer;
    }

    @media(max-width: 1024px) {

        #zuck-modal-content .story-viewer .head .left {
            float: {{ $currentLangDir=='rtl'? 'right': 'left' }} !important;
        }

        #zuck-modal-content .story-viewer .head .right {
            float: {{ $currentLangDir=='rtl'? 'left': 'right' }} !important;
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
                <span class="user-avatar">
                    <img class="rounded-circle img-fluid"
                        src="/uploads/users/1590435030_business-man-1385050_19201.jpg">
                </span>
                <span class="info mx-1">
                    <strong class="name d-block font-weight-bold" itemprop="name">حالتي</strong>
                    <span class="time d-inline-block">إضافة حالة</span>
                </span>
                <span class="status_types mx-1">
                    <i class="fas fa-camera mx-2 color-rbzgo add_story_image"></i>
                    <i class="fas fa-pen mx-2 color-rbzgo add_story_text"></i>
                </span>

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
                    'story_{{ $story->id }}',
                    '{{ $story->user->avatar ? "/uploads/users/" . $story->user->avatar : "/images/user.png" }}',
                    '{{ $story->user->name }}',
                    '',
                    '{{ $story->created_at->diffForHumans() }}',
                    [
                        @foreach ($story->items as $item)
                            [
                                'story_item_{{ $item->id }}',
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
    },
    // template: {
    //     timelineItem (itemData) {
    //         itemData.items.forEach(item => {
    //             if (item.type == 'text') {
    //                 return `
    //                 <div class="story">
    //                     <a class="item-link" href="${itemData.link}">
    //                         <span class="item-preview">
    //                             <img lazy="eager" src="${itemData.phoot}" />
    //                         </span>
    //                         <span class="info" itemProp="author" itemScope itemType="http://schema.org/Person">
    //                             <strong class="name" itemProp="name">${itemData.name}</strong>
    //                             <span class="time">${itemData.lastUpdated}</span>
    //                         </span>
    //                     </a>

    //                     <ul class="items"></ul>
    //                 </div>`;
    //             }
    //         });
    //     },

    //     timelineStoryItem (itemData) {

    //         if (itemData.type === 'text') {

    //             const reserved = ['id', 'seen', 'src', 'link', 'linkText', 'time', 'type', 'length', 'preview'];
    //             let attributes = `
    //             href="${itemData.src}"
    //             data-link="${itemData.link}"
    //             data-linkText="${itemData.linkText}"
    //             data-time="${itemData.time}"
    //             data-type="${itemData.type}"
    //             data-length="${itemData.length}"
    //             `;

    //             for (const dataKey in itemData) {
    //                 if (reserved.indexOf(dataKey) === -1) {
    //                     attributes += ` data-${dataKey}="${itemData[dataKey]}"`;
    //                 }
    //             }

    //             return `<a ${attributes}>
    //                         <img loading="auto" src="${itemData.preview}" />
    //                     </a>`;
    //         }

    //     },

    //     viewerItem (storyData, currentStoryItem) {
    //         console.log(storyData);
    //         return '';

    //         return `<div class="story-viewer">
    //             <div class="head">
    //                 <div class="left">
    //                     <a class="back">&lsaquo;</a>
    //                     <span class="item-preview">
    //                         <img lazy="eager" class="profilePhoto" src="${storyData.photo}" />
    //                     </span>

    //                     <div class="info">
    //                         <strong class="name">${storyData.name}</strong>
    //                         <span class="time">${storyData.timeAgo}</span>
    //                     </div>
    //                 </div>

    //                 <div class="right">
    //                     <span class="time">${currentStoryItem.timeAgo}</span>
    //                     <span class="loading"></span>
    //                     <a class="close" tabIndex="2">&times;</a>
    //                 </div>
    //             </div>

    //             <div class="slides-pointers">
    //                 <div class="wrap"></div>
    //             </div>

    //     </div>`;
    //     },

    //     viewerItemPointer (index, currentIndex, item) {
    //         return '';
    //         return `<span class="${currentIndex === index ? 'active' : ''} ${item.seen === true ? 'seen' : ''}"
    //             data-index="${index}" data-item-id="${item.id}">
    //             <b style="animation-duration:${item.length === '' ? '3' : get(item, 'length')}s"></b>
    //         </span>`;
    //     },

    //     viewerItemBody (index, currentIndex, item) {
    //         return '';
    //             return `<div class="item ${item.seen === true ? 'seen' : ''} ${currentIndex === index ? 'active' : ''}"
    //                 data-time="${item.time}" data-type="${item.type}" data-index="${index}"
    //                 data-item-id="${item.id}">
    //             </div>`;
    //     }
    // },
    });

</script>
@endsection
