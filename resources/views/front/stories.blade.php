@section('style')
<link rel="stylesheet" href="{{ asset('vendors/dropzone/dropzone.css') }}">
<style>
    .stories.list .story>.item-link {
        text-align: {{ $currentLangDir=='rtl'? 'right': 'left' }} !important
    }

    .stories.facesnap .story {
        margin-left: .25rem !important;
        margin-right: .25rem !important;
        padding: 6px !important;
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
                    @if (auth()->user()->avatar)
                        <img src="{{  asset('uploads/users/' . auth()->user()->avatar) }}" class="rounded-circle img-fluid">
                    @else
                        <img src="{{  asset('uploads/no-img.png') }}" class="rounded-circle img-fluid">
                    @endif
                </span>
                <span class="info mx-1">
                    <strong class="name d-block font-weight-bold" itemprop="name"> {{ __('lang.myStories') }} </strong>
                    <span class="time d-inline-block"> {{ __('lang.addStory') }} </span>
                </span>
                <span class="status_types mx-1">
                    <i class="fas fa-camera mx-2 color-rbzgo add_story_image" data-toggle="modal" data-target="#mediaModal"></i>
                    <i class="fas fa-pen mx-2 color-rbzgo add_story_text" data-toggle="modal" data-target="#textModal"></i>
                </span>

            </div>
        </div>

    </div>
</div>

<!-- Story Text Modal -->
<div class="modal fade" id="textModal" tabindex="-1" role="dialog" aria-labelledby="textModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="error_message"></div>
                <form action="{{ route('storeStory') }}" method="POST" id="saveStoryText">
                    @csrf
                    <div class='form-group mt-3'>
                        <textarea maxlength="120" rows="5" name="storyText" class='form-control story_text'></textarea>
                        <small class="text-secondary">
                            <span class="text_count"> 120 </span> {{ __('lang.character') }}
                        </small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    {{ __('lang.close') }}
                </button>
                <button type="button" class="btn btn-rbzgo save_story_text">
                    {{ __('lang.save') }}
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Story Media Modal -->
<div class="modal fade" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="mediaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="error_media_message"></div>
                <form action="{{ route('storeStory') }}" method="POST" class="dropzone" id="storyMedia"></form>
            </div>
        </div>
    </div>
</div>

@section('script')

<script src="{{ asset('vendors/zuck/zuck.js') }}"></script>
<script src="{{ asset('vendors/dropzone/dropzone.js') }}"></script>
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
                    '{{ $story->user->avatar ? "/uploads/users/" . $story->user->avatar : "/uploads/no-img.png" }}',
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

    // Initialize ZuckJS
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
    });

    Dropzone.autoDiscover = false;
    $(document).ready(function() {

        // Initialize Dropzone
        $("#storyMedia").dropzone({
            paramName: 'storyMedia',
            uploadMultiple: false,
            maxFiles: 1,
            maxFilesize: 5,
            acceptedFiles: "image/*,video/*",
            dictDefaultMessage: "<i class='fas fa-cloud-upload-alt mx-2'></i> {{ __('lang.storyImagesVideos') }} ",
            dictFileTooBig: "{{ __('lang.maxFileSize') }}",
            dictInvalidFileType: "{{ __('lang.invalid_filetype') }}",
            dictCancelUpload: "{{ __('lang.cancel') }}",
            headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function (file, response) {
                location.reload();
            }
        });

        // Limit Textarea typing
        var max = 120;
        $('textarea.story_text').keyup(function(e) {

            $('.text_count').text(max - $(this).val().length);

            if (e.which < 0x20) { return; }
            if ($(this).val().length == max) {
                e.preventDefault();

            } else if ($(this).val().length > max) {
                // Maximum exceeded
                $(this).val($(this).value.substring(0, max));
            }
        });

        // Save New Story from Text
        $('.save_story_text').click(function (e) {
            e.preventDefault();

            // $('#saveStoryText').submit();
            // return;

            var thisBtn = $(this);
            var storyText = $('.story_text').val();

            $.ajax({
                type: "POST",
                url: "{{ route('storeStory') }}",
                dataType: "json",
                data: {
                    storyText
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function(){
                    $( '.error_message' ).children().remove();
                    // hide Text
                    $('.story_text').attr('readonly', 'readonly');
                    thisBtn.attr('disabled', 'disabled');
                },
                success: function (response) {
                    location.reload();
                    // Show Text
                    $('.story_text').removeAttr('readonly');
                    thisBtn.removeAttr('disabled');
                },
                error: function (err) {

                    // Show Text
                    $('.story_text').removeAttr('readonly');
                    thisBtn.removeAttr('disabled');

                    var errors = err.responseJSON.errors;
                    errorsHtml = '<div class="alert alert-danger p-0"><ul class="mb-0">';
                            $.each(errors,function (k,v) {
                                errorsHtml += '<li>'+ v + '</li>';
                            });
                            errorsHtml += '</ul></di>';
                        $( '.error_message' ).html( errorsHtml );
                },

            });


        });

    });

</script>
@endsection
