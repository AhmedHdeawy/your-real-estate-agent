@extends('layouts.master')

@section('style')
<link rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css') }}">
<style>
    .map-container {
        position: relative;
        height: 400px;
    }

    .map-container #map {
        height: 100%;
    }

    .map-container #pac-input {
        background-color: #fff;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
        margin-top: 20px;
    }

    .map-container #pac-input:focus {
        border-color: #4d90fe;
    }

    @media(max-width: 768px) {
        .map-container #pac-input {
            width: 250px;
            margin-top: 60px;
        }
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
                    <input id="pac-input" class="form-control" type="text" placeholder="{{ __('lang.search') }}">
                    <div id="map"></div>
                </div>
                <div class='form-group mt-3'>
                    <textarea name="location"
                        class='form-control addressInput {{ old('location') ? '' : 'd-none' }} is-invalid'
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

                    <h5 class="text-primary mt-5 text-{{ $currentLangDir == 'rtl' ? 'right' : 'left' }}">
                        {{ __('lang.groupJoinsQuestions') }}</h5>
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
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwHS6Ghc-UD_SU9QSeZZzH4VJ6toFiaBs&libraries=places&language={{ app()->getLocale() }}&callback=initMap">
</script>
<script>
    var map;
    var marker;
    function initMap() {
        var myLatlng = {lat: 24.715869226220885, lng: 46.66797131445571};
        var geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(
        document.getElementById('map'), {
            zoom: 17,
            center: myLatlng,
            zoomControl: false,
            streetViewControl: false,
            mapTypeControl: false,
            gestureHandling: 'greedy'
        });

        // Add Basic Marker
        addMarker(myLatlng);

        // Get Basic Place and Filll Form Inputs with initial place details
        handleGeocoder(geocoder, myLatlng);

        // Displaying User or Device Position on Maps
        handleNavigatorGeolocation();

        // Hadnle Search AutoComplete
        habdleAutocomplete();

        // Configure the click listener.
        map.addListener('click', function(event) {

            // Delete old Marker
            deleteMarker();

            // Add new Marker with new Location
            addMarker(event.latLng);

            // Get Place Details and Fill Inputs with new details
            if (event.placeId) {
                getPlaceDetails(event.placeId);
            } else {
                handleGeocoder(geocoder, event.latLng)
            }

        });
    }


    // Handle Navigation and Get Current position for the visitor
    function handleNavigatorGeolocation(params) {

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
    }

    // Get Place Details using Google Map Place Library
    function getPlaceDetails(placeID) {

        // Prepare Request
        var request = {
            placeId: placeID,
            fields: ['name', 'address_components', 'formatted_address', 'geometry']
        };

        // Call Places Service
        service = new google.maps.places.PlacesService(map);
        service.getDetails(request, fillFormInputs);
    }

    // Fill form inputs with place details
    function fillFormInputs(place, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {

            // Append values to form input
            $('#createGroupForm').find("input[name='lat']").val(place.geometry.location.lat());
            $('#createGroupForm').find("input[name='lng']").val(place.geometry.location.lng());

            // collect place data
            var country = getCountry(place.address_components);
            var state = getState(place.address_components);
            var city = getCity(place.address_components);
            var address = place.formatted_address;

            // Append values to form input
            $('#createGroupForm').find("input[name='country']").val(country);
            $('#createGroupForm').find("input[name='state']").val(state);
            $('#createGroupForm').find("input[name='city']").val(city);
            $('#createGroupForm').find("input[name='address']").val(address);
            $('.addressInput').val(address);
            $('input[name=name]').val(place.name);
        }
    }

    // Get Place details from LatLng
    function handleGeocoder(geocoder, latLong) {

        // Get Place Details from LatLng
        geocoder.geocode({'latLng': latLong}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                // Call Function to Get Place Details and Fill Inputs
                getPlaceDetails(results[0].place_id);
            }
        }
        });
    }

    // Handle Search Autocomplete
    function habdleAutocomplete() {

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');

        // Append Input to the Map
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

        // Get Autocomplete Service
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.bindTo('bounds', map);

        // Set the data fields to return when the user selects a place.
        autocomplete.setFields(['address_components', 'geometry', 'icon', 'name']);

        autocomplete.addListener('place_changed', function() {

            // Get Place Selected
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17); // Why 17? Because it looks good.
            }

            // Delete old Marker
            deleteMarker();

            // Add new Marker with new Location
            addMarker(place.geometry.location);

            // collect data
            var country = getCountry(place.address_components);
            var state = getState(place.address_components);
            var city = getCity(place.address_components);
            var address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');

            // Append values to form input
            $('#createGroupForm').find("input[name='country']").val(country);
            $('#createGroupForm').find("input[name='state']").val(state);
            $('#createGroupForm').find("input[name='city']").val(city);
            $('#createGroupForm').find("input[name='address']").val(address);
            $('.addressInput').val(address);
            $('input[name=name]').val(place.name);

            // Add Window to Display this Location
            addInfoWidow(contentString(place.name, address));

        });

    }

    // Add new Marker to Map
    function addMarker(location) {
        marker = new google.maps.Marker({
        position: location,
        map: map
        });
    }

    // Delete old Marker
    function deleteMarker() {
        marker.setMap(null);
    }

    // Add Info Window on the marker
    function addInfoWidow(content) {
        var infowindow = new google.maps.InfoWindow({
        content
        });

        infowindow.open(map, marker);
    }

    function contentString(title, address) {
        return `<p class='font-weight-bold mb-0'>${title}</p><p class='mb-0'>${address}</p>`;
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
