@extends('layouts.master')

@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<link rel="stylesheet" href="{{ asset('vendors/lightslider/css/lightslider.css') }}">
@endsection

@section('content')
<main class='unit-page'>
    <div class='container'>

        {{-- Property Images --}}
        <div class='unit-gallery'>
            <div class='row'>
                @php
                    $imagesCount = count($property->images);
                    $take =  $imagesCount - 3 < 0 ? 0 : $imagesCount - 3;
                @endphp
                <div class="col-6">
                    <a style="width: 100%" data-fancybox="gallery" href="{{ $property->images->first()->image_url }}">
                        <img style="width: 100%; height: 450px;" src="{{ $property->images->first()->image_url }}" class="img-thumbnail">
                    </a>
                </div>
                <div class="col-6">
                    @foreach ($property->images()->limit(3)->get() as $image)
                        @if (!$loop->first)
                            <a data-fancybox="gallery" href="{{ $image->image_url }}">
                                <img style="height: 200px; width: 100%" src="{{ $image->image_url }}" class="img-thumbnail">
                            </a>
                        @endif
                    @endforeach
                </div>

                <div class='col-12 mt-3 d-none'>
                    <div class='unit-images-gallery'>
                        <ul id="lightSlider">
                            @foreach ($property->images()->skip(3)->take($take)->get() as $image)
                                    <li>
                                        <a data-fancybox="gallery" href="{{ $image->image_url }}">
                                            <img style="height: 150px; width: 200px" alt='{{ $property->title }}' class='img-fluid' src='{{ $image->image_url }}'>
                                        </a>
                                    </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>

        </div>
        {{-- Property Details --}}
        <div class='brief-data'>
            <div class='row'>
                <div class='col-12 mx-auto'>
                    <div class='row'>
                        <div class='col-12'>
                            <h6> {{ $property->address }} </h6>
                            <h1> {{ $property->title }} </h1>
                        </div>

                        <div class='col-md-8 mx-auto'>
                            <div class='unit-details'>
                                <div class='row'>
                                    @if ($property->type)
                                        <div class='col-12 col-md-6'>
                                            <p>
                                                <svg viewBox='0 0 18 16' xmlns='http://www.w3.org/2000/svg'>
                                                    <path
                                                            d='M-2.75-13.75a.5.5,0,0,0,.5-.5v-1a.5.5,0,0,0-.5-.5h-17a.5.5,0,0,0-.5.5v1a.5.5,0,0,0,.5.5h.5v12h-.5a.5.5,0,0,0-.5.5v1a.5.5,0,0,0,.5.5h7.5v-2.5a.5.5,0,0,1,.5-.5h1a.5.5,0,0,1,.5.5V.25h7.5a.5.5,0,0,0,.5-.5v-1a.5.5,0,0,0-.5-.5h-.5v-12Zm-9.5,1.4a.43.43,0,0,1,.4-.4h1.2a.43.43,0,0,1,.4.4v1.2a.43.43,0,0,1-.4.4h-1.2a.43.43,0,0,1-.4-.4Zm0,3a.43.43,0,0,1,.4-.4h1.2a.43.43,0,0,1,.4.4v1.2a.43.43,0,0,1-.4.4h-1.2a.43.43,0,0,1-.4-.4Zm-4-3a.43.43,0,0,1,.4-.4h1.2a.43.43,0,0,1,.4.4v1.2a.43.43,0,0,1-.4.4h-1.2a.43.43,0,0,1-.4-.4Zm1.6,4.6h-1.2a.43.43,0,0,1-.4-.4v-1.2a.43.43,0,0,1,.4-.4h1.2a.43.43,0,0,1,.4.4v1.2A.43.43,0,0,1-14.65-7.75Zm.4,4a3,3,0,0,1,3-3,3,3,0,0,1,3,3Zm8-4.4a.43.43,0,0,1-.4.4h-1.2a.43.43,0,0,1-.4-.4v-1.2a.43.43,0,0,1,.4-.4h1.2a.43.43,0,0,1,.4.4Zm0-3a.43.43,0,0,1-.4.4h-1.2a.43.43,0,0,1-.4-.4v-1.2a.43.43,0,0,1,.4-.4h1.2a.43.43,0,0,1,.4.4Z'
                                                            fill='#222'
                                                            id='floors' transform='translate(20.25 15.75)'/>
                                                </svg>
                                                {{ __('lang.type') }} :
                                                <span> {{ $property->type->name }} </span>
                                            </p>
                                        </div>
                                    @endif
                                    @if ($property->no_of_rooms)
                                        <div class='col-12 col-md-6'>
                                            <p>
                                                <svg viewBox='0 0 18 12' xmlns='http://www.w3.org/2000/svg'>
                                                    <path
                                                            d='M13.05-4.5A2.388,2.388,0,0,1,10.8-7a2.388,2.388,0,0,1,2.25-2.5A2.388,2.388,0,0,1,15.3-7,2.388,2.388,0,0,1,13.05-4.5Zm-9.9-4h6.3A.477.477,0,0,1,9.9-8v4.5h6.3V-10a.477.477,0,0,1,.45-.5h.9A.477.477,0,0,1,18-10V1a.477.477,0,0,1-.45.5h-.9A.477.477,0,0,1,16.2,1V-.5H1.8V1a.477.477,0,0,1-.45.5H.45A.477.477,0,0,1,0,1V-5A3.339,3.339,0,0,1,3.15-8.5Z'
                                                            data-name='Path 1036'
                                                            fill='#383837'
                                                            id='Path_1036' transform='translate(0 10.5)'/>
                                                </svg>
                                                {{ __('lang.no_of_rooms') }} :
                                                <span>
                                                    {{ $property->no_of_rooms }}
                                                    @if ($property->no_of_maidrooms)
                                                        +
                                                        {{ $property->no_of_maidrooms }}
                                                        {{ __('lang.maidrooms') }}
                                                    @endif
                                                </span>
                                            </p>
                                        </div>
                                    @endif
                                    @if ($property->no_of_bathrooms)

                                        <div class='col-12 col-md-6'>
                                            <p>
                                                <svg viewBox='0 0 18 15.75' xmlns='http://www.w3.org/2000/svg'>
                                                    <path
                                                            d='M.844-6.75H15.188v-5.062a1.126,1.126,0,0,0-1.125-1.125,1.125,1.125,0,0,0-.95.523,2.389,2.389,0,0,1-.24,2.919.422.422,0,0,1-.017.578l-.4.4a.422.422,0,0,1-.6,0L8.52-11.861a.422.422,0,0,1,0-.6l.4-.4a.422.422,0,0,1,.578-.017,2.385,2.385,0,0,1,2.256-.54,2.811,2.811,0,0,1,2.311-1.212,2.816,2.816,0,0,1,2.813,2.813V-6.75h.281A.844.844,0,0,1,18-5.906v.563a.844.844,0,0,1-.844.844h-.281v1.125A3.366,3.366,0,0,1,15.75-.86V.281a.844.844,0,0,1-.844.844h-.562A.844.844,0,0,1,13.5.281V0h-9V.281a.844.844,0,0,1-.844.844H3.094A.844.844,0,0,1,2.25.281V-.86A3.366,3.366,0,0,1,1.125-3.375V-4.5H.844A.844.844,0,0,1,0-5.344v-.562A.844.844,0,0,1,.844-6.75Z'
                                                            data-name='Path 1038'
                                                            fill='#383837'
                                                            id='Path_1038' transform='translate(0 14.625)'/>
                                                </svg>
                                                {{ __('lang.no_of_bathrooms') }} :
                                                <span>
                                                    {{ $property->no_of_bathrooms }}
                                                </span>
                                            </p>
                                        </div>
                                    @endif
                                    @if ($property->completing)
                                        <div class='col-12 col-md-6'>
                                            <p>
                                                <svg viewBox='0 0 18 18.002' xmlns='http://www.w3.org/2000/svg'>
                                                    <path
                                                            d='M-8.12-9.074V-6.68c-.932.207-1.761.548-2.629.784v-2.4C-9.821-8.5-8.985-8.838-8.12-9.074ZM-16.1-13.4a10.561,10.561,0,0,0,4.179,1.121c1.911,0,3.494-1.223,5.9-1.223a7.045,7.045,0,0,1,2.429.422,1.942,1.942,0,0,1-.129-.83A2,2,0,0,1-1.8-15.75,1.986,1.986,0,0,1,.281-13.781a1.955,1.955,0,0,1-.857,1.614V1.406a.849.849,0,0,1-.857.844H-2a.849.849,0,0,1-.857-.844V-1.913a10.1,10.1,0,0,0-4.087-.777c-1.915,0-3.494,1.223-5.9,1.223A7.543,7.543,0,0,1-17.226-2.9a1.117,1.117,0,0,1-.493-.928v-8.546A1.14,1.14,0,0,1-16.1-13.4ZM-5.491-4.307a11.408,11.408,0,0,1,2.629.584V-6.2a10.356,10.356,0,0,0-2.629-.612ZM-16.008-9.035a11.525,11.525,0,0,0,2.629.84v2.5a6.709,6.709,0,0,1-2.629-.914v2.479a5.83,5.83,0,0,0,2.629.953V-5.7a6.136,6.136,0,0,0,2.629-.2v2.37A21.1,21.1,0,0,1-8.12-4.271V-6.68a8.064,8.064,0,0,1,2.629-.134V-9.274a12.764,12.764,0,0,1,2.629.735v-2.479a10.355,10.355,0,0,0-2.629-.773v2.517a6.17,6.17,0,0,0-2.629.2v-2.37a20.583,20.583,0,0,1-2.629.749v2.4a6.913,6.913,0,0,1-2.629.095v-2.528a12.787,12.787,0,0,1-2.629-.791Z'
                                                            fill='#383837'
                                                            id='finish' transform='translate(17.719 15.752)'/>
                                                </svg>
                                                {{ __('lang.property_status') }} :
                                                <span>
                                                    {{ $property->completing->name }}
                                                </span>
                                            </p>
                                        </div>
                                    @endif
                                    @if ($property->height && $property->width)
                                        <div class='col-12 col-md-6'>
                                            <p>
                                                <svg viewBox='0 0 18 12' xmlns='http://www.w3.org/2000/svg'>
                                                    <path
                                                            d='M3.945-8.1q.285.53.658,1.309T5.38-5.1q.4.908.8,1.856l.745,1.783L7.67-3.245q.4-.948.8-1.856t.777-1.687q.373-.779.658-1.309H12.15q.158,1.109.292,2.482t.237,2.86q.1,1.486.19,2.98t.15,2.812h-2.4Q10.569,1.415,10.49-.5t-.237-3.856q-.286.675-.634,1.494T8.929-1.22Q8.588-.4,8.271.346T7.731,1.623H6.008q-.222-.53-.539-1.277T4.811-1.22q-.341-.819-.69-1.639T3.487-4.353Q3.329-2.409,3.249-.5T3.123,3.037H.72Q.783,1.72.87.226t.19-2.98q.1-1.486.237-2.86T1.59-8.1Zm14.581.99a1.743,1.743,0,0,1-.138.684,3.172,3.172,0,0,1-.36.633,5.161,5.161,0,0,1-.5.586q-.277.281-.544.534-.138.131-.3.3t-.309.333q-.148.169-.263.314a.782.782,0,0,0-.143.239H18.72v1.171H14.46a1.534,1.534,0,0,1-.018-.262q0-.159,0-.225a2.3,2.3,0,0,1,.143-.825,3.1,3.1,0,0,1,.373-.7,4.375,4.375,0,0,1,.521-.6q.29-.281.576-.562.221-.216.415-.408a4.62,4.62,0,0,0,.341-.375,1.714,1.714,0,0,0,.231-.365.887.887,0,0,0,.083-.37.673.673,0,0,0-.231-.581.942.942,0,0,0-.572-.169,1.339,1.339,0,0,0-.466.08,2.339,2.339,0,0,0-.4.187,2.441,2.441,0,0,0-.309.216q-.129.108-.194.173l-.682-.975a3.476,3.476,0,0,1,.945-.633,2.734,2.734,0,0,1,1.157-.248,3.163,3.163,0,0,1,.968.131,1.8,1.8,0,0,1,.669.37,1.437,1.437,0,0,1,.387.581A2.25,2.25,0,0,1,18.526-7.107Z'
                                                            data-name='Path 1037'
                                                            fill='#383837'
                                                            id='Path_1037' transform='translate(-0.72 8.963)'/>
                                                </svg>
                                                {{ __('lang.area') }} :
                                                <span>
                                                    {{ $property->height }} {{ __('lang.squareMeter') }}
                                                    /
                                                    {{ $property->width }} {{ __('lang.squareMeter') }}
                                                </span>
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                <hr class="my-5">

                                <div class='row'>
                                    <div class='col-12'>
                                        <h6 class="text-black"> {{ __('lang.agent_info') }} </h6>
                                        <div class='col-12 col-md-6 p-0'>
                                            <p>
                                                <i class="fa fa-info-circle mx-2"></i>
                                                {{ __('lang.agent_name') }} :
                                                <span> {{ $property->agent_name }} </span>
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class='col-md-4 mt-md-0 mt-4'>
                            <div class='contact-info'>
                                <p class='price'>
                                    <span>
                                        {{ $property->price }} {{ __('lang.aed') }}
                                        @if ($property->period)
                                            /
                                            {{ $property->period->name }}
                                        @endif
                                    </span>
                                </p>
                                <div class='btns-con'>
                                    <div class='row'>
                                        <div class='col-6'>
                                            <a class='btn callAgent' data-phone="{{ $property->agent_phone }}" href='tel:{{ $property->agent_phone }}'>
                                                <svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
                                                    <path d='M0 0h24v24H0V0z' fill='none'/>
                                                    <path
                                                            d='M19.23 15.26l-2.54-.29c-.61-.07-1.21.14-1.64.57l-1.84 1.84c-2.83-1.44-5.15-3.75-6.59-6.59l1.85-1.85c.43-.43.64-1.03.57-1.64l-.29-2.52c-.12-1.01-.97-1.77-1.99-1.77H5.03c-1.13 0-2.07.94-2 2.07.53 8.54 7.36 15.36 15.89 15.89 1.13.07 2.07-.87 2.07-2v-1.73c.01-1.01-.75-1.86-1.76-1.98z'/>
                                                </svg>
                                                {{ __('lang.call') }}
                                            </a>
                                        </div>
                                        <div class='col-6'>
                                            <button class='btn' data-toggle="modal" data-target="#sensMailModal">
                                                <svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
                                                    <path d='M0 0h24v24H0z' fill='none'/>
                                                    <path d='M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z'/>
                                                </svg>
                                                {{ __('lang.email') }}
                                            </button>
                                        </div>
                                        <div class='col-auto mx-auto mt-4'>
                                            @auth
                                                @php
                                                    $checkInFav = in_array($property->id, auth()->user()->favorites->pluck('id')->toArray());
                                                @endphp
                                                <button onclick="saveProperty()" id="addToFavurite" class='btn'>
                                                    <i class="{{ $checkInFav  ? 'fas' : 'far' }} fa-heart"></i>
                                                    <span>{{ $checkInFav ? __('lang.savedInFav') : __('lang.save') }}</span>
                                                </button>
                                            @else
                                                <button onclick="saveProperty()" class='btn'>
                                                    <i class="far fa-heart"></i>
                                                    <span>{{ __('lang.save') }}</span>
                                                </button>
                                            @endauth

                                        </div>
                                        <div class='col-12'>
                                            <div class='map'>
                                                <div class='card-img-overlay'>
                                                    <button class='showMap' data-toggle="modal" data-target="#mapModal">
                                                        <span>
                                                            {{ __('lang.map') }}
                                                            <svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
                                                                <path d='M0 0h24v24H0z' fill='none'/>
                                                                <path
                                                                        d='M19 19H5V5h7V3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2v-7h-2v7zM14 3v2h3.59l-9.83 9.83 1.41 1.41L19 6.41V10h2V3h-7z'/>
                                                            </svg>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class='col-12 col-md-8'>
                            <div class='description bg-white p-4 rounded'>

                                <div class='row mb-4'>
                                    <div class='col-sm-6'>
                                        <h3> {{ __('lang.extraAmenities') }} </h3>
                                        <ul>
                                            @foreach ($property->amenities as $amenitie)
                                                <li> {{ $amenitie->name }} </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @if ($property->description)
                                    <h3> {{ __('lang.desc') }} </h3>
                                    <div>
                                        <p>
                                            {!! $property->description !!}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class='col-12 mt-3'>
                            <div class='share-it'>
                                <h5> {{ __('lang.doYouLikePropertyShareNow') }} </h5>
                                <div class='row'>
                                    <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                    <div class="addthis_inline_share_toolbox"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Properties --}}
        @if (count($relatedProperties))
            <div class='similar-units'>
                <h2> {{ __('lang.relatedPropertiesInSameArea') }} </h2>
                <div class='row'>
                    @foreach ($relatedProperties as $relatedProperty)
                        <div class='col-xl-3 col-md-4 col-sm-6'>
                            @include('front.property', ['property'  =>  $relatedProperty])
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Load Modals --}}
        @include('front.sendMail')
        @include('front.propertyMap')
    </div>
</main>
@endsection

@section('script')
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5fb1aa65248cf5e6"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKU2pOeE34mizOMutB8WaCHNIfoYO7yPg&language={{ app()->getLocale() }}&callback=initMap"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script src="{{ asset('vendors/lightslider/js/lightslider.min.js') }}"></script>
<script>
    $(document).ready(function() {

        $("#lightSlider").lightSlider({
            item:4,
            loop:false,
            slideMove:2,
            easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
            speed:600,
            responsive : [
                {
                    breakpoint:800,
                    settings: {
                        item:3,
                        slideMove:1,
                        slideMargin:6,
                    }
                },
                {
                    breakpoint:480,
                    settings: {
                        item:2,
                        slideMove:1
                    }
                }
            ]
        });

        // Show Agent phone
        $('.callAgent').click(function(e){
            const agentPhone = $(this).data('phone');
            $(this).text(agentPhone);
        });

        // Handle Send Mail Error
        var errorClass = 'is-invalid';
        var validClass = '';
        $("#sendMailToAgent").validate({
            rules: {
                // simple rule, converted to {required:true}
                name: "required",
                // compound rule
                email: {
                required: true,
                email: true
                }
            },
            messages: {
                name: {
                    required: "{{ __('validation.required', ['attribute'    =>  __('lang.name') ]) }}",
                },
                email: {
                    required: "{{ __('validation.required', ['attribute'    =>  __('lang.email') ]) }}",
                    email: "{{ __('validation.email', ['attribute'    =>  __('lang.email') ]) }}"
                },
                phone: {
                    required: "{{ __('validation.required', ['attribute'    =>  __('lang.phone') ]) }}",
                },
                message: {
                    required: "{{ __('validation.required', ['attribute'    =>  __('lang.message') ]) }}",
                },
            },
            submitHandler: function(form) {
                form.submit();
            },
            success: function(label) {
                $(label).parent().prev().removeClass('is-invalid');
            },
            errorPlacement: function(error, element) {
                $(element).addClass('is-invalid');
                error.appendTo( $(element).next() );
            }
        });

        // Add to favourite
        $('#addToFavurite').click(function(e) {
            e.preventDefault();
            const favIcon = $(this).find('i');
            if (favIcon.hasClass('far')) {
                favIcon.removeClass('far').addClass('fas');
                $(this).find('span').text('{{ __('lang.savedInFav') }}');
            } else {
                favIcon.removeClass('fas').addClass('far');
                $(this).find('span').text('{{ __('lang.save') }}');
            }
        });

    });

    // When User clikc on Add to Favorites
    function saveProperty() {
        var authCheck = '{{ auth()->check() }}';

        if (authCheck) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                type: "POST",
                url: "{{ route('property.addToFavorites') }}",
                data: {
                    property_id: "{{ $property->id }}"
                },
                success: function (response) {

                }
            });

        } else {
            Swal.fire({
                icon: 'error',
                title: "{{ __('lang.oops') }}",
                text: "{{ __('lang.youMustLogin') }}",
                footer: "<a href='{{ route('login') }}'> {{ __('lang.login') }} </a>"
            })
        }

    }

    // MAP
    var map;
    var marker;
    const lat = {{ $property->lat }};
    const lng = {{ $property->lng }};
    function initMap() {
        var propertyLatLng = {lat: lat, lng: lng};
        var geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(
        document.getElementById('map'), {
            zoom: 15,
            center: propertyLatLng,
            zoomControl: true,
            streetViewControl: true,
            mapTypeControl: false,
            gestureHandling: 'greedy'
        });

        // Add Basic Marker
        new google.maps.Marker({
            position: propertyLatLng,
            map: map
        });
    }
</script>

@endsection
