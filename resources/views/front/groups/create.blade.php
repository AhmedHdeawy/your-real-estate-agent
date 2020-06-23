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

        <div class='col-md-10 mx-auto'>
            <h2 class="mb-5"> {{ __('lang.createGroup') }} </h2>
            <form action="{{ route('groups.store') }}" method="post" id="createGroupForm" enctype="multipart/form-data">
                @csrf

                <div class='map-container'>
                    <div id="map"></div>
                </div>
                        <div class='form-group mt-3'>
                            <textarea name="location" class='form-control addressInput {{ old('location') ? '' : 'd-none' }} is-invalid'
                                title='{{ __('lang.selectPosition') }}' readonly>{{ old('location') }}</textarea>
                            @if ($errors->first('location'))
                            <div class="invalid-feedback">{{ $errors->first('location') }}</div>
                            @endif
                        </div>

                <div id="after-map" class="mt-5">
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

                    <div class='form-group'>
                        <input class='form-control' name='country' type='hidden' value="{{ old('country') }}">
                        <input class='form-control' name='state' type='hidden' value="{{ old('state') }}">
                        <input class='form-control' name='city' type='hidden' value="{{ old('city') }}">
                        <input class='form-control' name='address' type='hidden' value="{{ old('address') }}">
                        <input class='form-control' name='lat' type='hidden' value="{{ old('lat') }}">
                        <input class='form-control' name='lng' type='hidden' value="{{ old('lng') }}">
                    </div>

                    <h5 class="text-primary mt-5 text-{{ $currentLangDir == 'rtl' ? 'right' : 'left' }}">{{ __('lang.groupJoinsQuestions') }}</h5>
                    <div class='questions-container'>
                        <section class="tr form-group">
                            <textarea class='form-control first is-invalid mt-3'
                                placeholder='{{ __('lang.questionTitle') }}' title='{{ __('lang.questionTitle') }}'
                            name="questions[]"></textarea>
                            {{-- <button type="button" class='mt-2 btn btn-create-question'>
                                <i class="fa fa-minus-circle text-white mx-2"></i>
                                {{ __('lang.deleteQuestion') }}
                            </button> --}}
                        </section>
                        <button type="button" class='mt-2 btn btn-create-question'>
                            <i class="fa fa-plus-circle text-white mx-2"></i>
                            {{ __('lang.addQuestion') }}
                        </button>
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
            zoom: 13,
            center: myLatlng,
            zoomControl: false,
            streetViewControl: false,
            mapTypeControl: false,
            gestureHandling: 'greedy'
        });

        addMarker(myLatlng);

        // handle Gecoder to append Lat , Lng and Get Country, State, City and Address
        handleGeocoder(geocoder, myLatlng);

        // Displaying User or Device Position on Maps
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                // Override init Position by User Location
                map.setCenter(pos);
                // Delete old Marker
                deleteMarker();
                // Add new Marker with new Location
                addMarker(pos);

                // handle Gecoder to append Lat , Lng and Get Country, State, City and Address
                handleGeocoder(geocoder, pos);

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

            // Add new Marker with new Location
            addMarker(event.latLng);

            // handle Gecoder to append Lat , Lng and Get Country, State, City and Address
            handleGeocoder(geocoder, event.latLng);

            // finally, hide the modal
            setTimeout(() => {
                $('#mapModal').modal('hide');
            }, 1500);

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

    /**
    * Get state from latLong
    *
    */
    function getState(address_components) {

        var state = '';

        address_components.forEach(element => {
            element.types.forEach(type => {

            if(type == 'administrative_area_level_1') {
                state = element.long_name;
            }
            });
        });

        return state;

    }

    /**
    * Get country from latLong
    *
    */
    function getCountry(address_components) {

        var country = '';

        address_components.forEach(element => {
            element.types.forEach(type => {

                if(type == 'country') {
                    country = element.long_name;
                }
            });
        });

        return country;

    }


    function handleGeocoder(geocoder, latLong) {

        // Append values to form input
        $('#createGroupForm').find("input[name='lat']").val(latLong.lat);
        $('#createGroupForm').find("input[name='lng']").val(latLong.lng);

        // Get address and City
        geocoder.geocode({'latLng': latLong}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {

                    // collect data
                    var country = getCountry(results[0].address_components);
                    var state = getState(results[0].address_components);
                    var city = getCity(results[0].address_components);
                    var address = results[0].formatted_address;

                    // Append values to form input
                    $('#createGroupForm').find("input[name='country']").val(country);
                    $('#createGroupForm').find("input[name='state']").val(state);
                    $('#createGroupForm').find("input[name='city']").val(city);
                    $('#createGroupForm').find("input[name='address']").val(address);

                    $('.addressInput').val(address);

                    // Add Window to Display this Location
                    addInfoWidow(contentString(city, address));
                }
            }
        });
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
