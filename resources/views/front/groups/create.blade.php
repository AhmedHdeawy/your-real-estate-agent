@extends('layouts.master')

@section('style')
<link rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css') }}">
<style>
    .map-container {
        position: relative;
        height: 400px;
    }

    #map {
        height: 100%;
    }
</style>
@endsection

@section('content')

<section class='create-group-page'>
    <div class='row'>

        <div class='col-lg-6 col-md-10 mx-auto'>
            <h2> {{ __('lang.createGroup') }} </h2>
            <form action="{{ route('groups.store') }}" method="post" id="createGroupForm" enctype="multipart/form-data">
                @csrf

                <fieldset class="field-set mt-4">
                    <legend>
                        <h5 class="text-primary">{{ __('lang.groupInfo') }}</h5>
                    </legend>

                    <div class='form-group'>
                        <input class='form-control is-invalid' placeholder='{{ __('lang.groupName') }}'
                            title='{{ __('lang.groupName') }}' name='name' type='text' value="{{ old('name') }}">
                        @if ($errors->first('name'))
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                    <div class='form-group'>
                        <textarea class='form-control is-invalid' placeholder='{{ __('lang.groupDescription') }}'
                            title='{{ __('lang.groupDescription') }}'
                            name="description">{{ old('description') }}</textarea>
                        @if ($errors->first('description'))
                        <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                        @endif
                    </div>
                </fieldset>

                <fieldset class="field-set mt-4">
                    <legend>
                        <h5 class="text-primary">{{ __('lang.groupLocation') }}</h5>
                    </legend>

                    <div class='form-group'>
                        @php
                        $states = null;
                        @endphp
                        <select name="country_id" id="country_id"
                            class="form-control is-invalid select2 country-select">
                            @foreach ($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                {{ $country->name }}
                            </option>
                            @php
                            // Load States for this country only if old country Exist [ validation error happens ]
                            if(old('country_id') == $country->id ) {
                            $states = $country->states;
                            }
                            @endphp
                            @endforeach
                        </select>
                        @if ($errors->first('country_id'))
                        <div class="invalid-feedback">{{ $errors->first('country_id') }}</div>
                        @endif
                    </div>

                    <div class='form-group mt-4'>

                        @php
                        // if old('contry_id') load states for this country only, else load first country states
                        $states = $states ?? $countries[0]->states;
                        @endphp

                        <select name="state_id" id="state_id" class="form-control is-invalid select2 states-select">
                            @foreach ($states as $state)
                            <option value="{{ $state->id }}" {{ old('state_id') == $state->id ? 'selected' : '' }}>
                                {{ $state->name }}
                            </option>
                            @endforeach

                        </select>
                        @if ($errors->first('state_id'))
                        <div class="invalid-feedback">{{ $errors->first('state_id') }}</div>
                        @endif
                    </div>

                    <div class='form-group'>
                        <input class='form-control' name='address' type='hidden' value="{{ old('address') }}">
                        <input class='form-control' name='city' type='hidden' value="{{ old('city') }}">
                        <input class='form-control' name='lat' type='hidden' value="{{ old('lat') }}">
                        <input class='form-control' name='lng' type='hidden' value="{{ old('lng') }}">
                    </div>

                    <div class="select-gps mt-4">

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-create-question btn-rbzgo border-rbzgo d-inline-block"
                            data-toggle="modal" data-target="#mapModal">
                            <i class="fas fa-map-marker-alt mx-2 text-white"></i>
                            {{ __('lang.selectPosition') }}
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="mapModal" tabindex="-1" role="dialog"
                            aria-labelledby="mapModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class='map-container'>
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-rbzgo border-rbzgo" data-dismiss="modal">
                                            {{ __('lang.close') }} </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class='form-group mt-3'>
                            <textarea name="location"
                                class='form-control addressInput {{ old('location') ? '' : 'd-none' }} is-invalid'
                                title='{{ __('lang.selectPosition') }}' readonly>{{ old('location') }}</textarea>
                            @if ($errors->first('location'))
                            <div class="invalid-feedback">{{ $errors->first('location') }}</div>
                            @endif
                        </div>
                    </div>
                </fieldset>

                <fieldset class="field-set mt-4">
                    <legend>
                        <h5 class="text-primary">{{ __('lang.groupJoinsQuestions') }}</h5>
                    </legend>

                    {{-- <h5 class="text-primary mt-5">{{ __('lang.groupJoinsQuestions') }}</h5> --}}

                    <div class='form-group questions-container'>
                        <section class="tr">
                            <textarea class='form-control first is-invalid mt-3'
                                placeholder='{{ __('lang.questionTitle') }}' title='{{ __('lang.questionTitle') }}'
                                name="questions[]"></textarea>
                        </section>
                        @if ($errors->first('questions'))
                        <div class="invalid-feedback">{{ $errors->first('questions') }}</div>
                        @endif
                        <button type="button" class='mt-2 btn btn-create-question'>
                            <i class="fa fa-plus-circle text-white mx-2"></i>
                            {{ __('lang.addQuestion') }}
                        </button>
                    </div>
                </fieldset>
                {{-- Group Image --}}
                <div class="form-group mt-5">
                    <div class="input-group mb-2">
                        {{-- <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fa fa-lock color-rbzgo"></i></div>
                                                </div> --}}
                        @include('front.includes.uploadImage',[
                        'name' => 'image',
                        'value' => null,
                        'path' => 'uploads/users/',
                        'labelTitle' => __('lang.groupImage')
                        ])

                        @if ($errors->first('image'))
                        <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                        @endif
                    </div>
                </div>

                <button type="submit" class='btn mt-5'> {{ __('lang.createTheGroup') }} </button>
            </form>
        </div>
    </div>
</section>

@endsection

@section('script')
<script src="{{ asset('vendors/select2/js/select2.min.js') }}"></script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwHS6Ghc-UD_SU9QSeZZzH4VJ6toFiaBs&language={{ app()->getLocale() }}&callback=initMap">
</script>
<script>
    var map;
    var marker;
    function initMap() {
        var myLatlng = {lat: 24.715869226220885, lng: 46.66797131445571};
        var geocoder = new google.maps.Geocoder();
            map = new google.maps.Map(
        document.getElementById('map'), {
            zoom: 8,
            center: myLatlng,
            zoomControl: false,
            streetViewControl: false,
            mapTypeControl: false,
            gestureHandling: 'greedy'
        });

        addMarker(myLatlng);

        // Displaying User or Device Position on Maps
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                // Override init Position by User Location
                map.setCenter(pos);
                addMarker(pos);

            }, function() {});
        } else {
            // Browser doesn't support Geolocation
            handleLocationError();
        }

        function handleLocationError(browserHasGeolocation) {
            alert('{{ __('lang.doesnotSupportGeolocation') }}');
        }


        // Configure the click listener.
        map.addListener('click', function(event) {

            // Delete old Marker
            deleteMarker();

            // Add new Marker with nep Location
            addMarker(event.latLng);

            // Get Lat and Long
            var lat = event.latLng.lat();
            var lng = event.latLng.lng();

            // Append values to form input
            $('#createGroupForm').find("input[name='lat']").val(lat);
            $('#createGroupForm').find("input[name='lng']").val(lng);

            // Get address and City
            geocoder.geocode({'latLng': event.latLng}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        // collect data
                        var address = results[0].formatted_address;
                        var city = getCity(results[0].address_components);

                        // Append values to form input
                        $('#createGroupForm').find("input[name='address']").val(address);
                        $('#createGroupForm').find("input[name='city']").val(city);

                        $('.addressInput').removeClass('d-none').val(address);

                        // Add Window to Display this Location
                        addInfoWidow(contentString(city, address));
                    }
                }
            });

            // finally, hide the modal
            // $('#mapModal').modal('hide')

        });
    }

    function addMarker(location) {
        marker = new google.maps.Marker({
        position: location,
        map: map
        });
    }

    function deleteMarker() {
        marker.setMap(null);
    }

    function addInfoWidow(content) {
        var infowindow = new google.maps.InfoWindow({
        content
        });

        infowindow.open(map, marker);
    }

    function contentString(title, address) {
        return `<p class='font-weight-bold'>${title}</p><p>${address}</p>`;
    }

    /**
     * Get city from latLong
     *
    */
    function getCity(address_components) {

        var city = '';

        address_components.forEach(element => {
            element.types.forEach(type => {
                if(type == 'administrative_area_level_2') {
                    city = element.long_name;
                }
            });
        });

        return city;

    }

    // Run Select Search
    var select2 = $('.select2');
    select2.select2({
        placeholder: select2.attr('placeholder'),
    });

    // Load States when select country
    $('.country-select').change(function (e) {
        const countryId = $(this).children('option:selected').val();

        $.ajax({
            type: "GET",
            url: "/fetchStatesByCountry/" + countryId,
            dataType: "json",
            beforeSend: function(){
                // hide select
                $('.states-select').attr('disabled', 'disabled');
            },
            success: function (response) {
                // first remove old options
                $('.states-select').find('option').remove();

                // Append new options to select
                response.forEach(res => {

                    $('.states-select').append(`
                        <option value="${res.id}">
                            ${res.name}
                        </option>
                    `);
                });

                // finally, show the select
                $('.states-select').removeAttr('disabled');

            }
        });
    });


</script>
@endsection
