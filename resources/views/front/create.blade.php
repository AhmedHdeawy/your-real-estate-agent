@extends('layouts.master')

@section('content')

<main class='add-unit'>
		<div class='container'>

            @include('front.includes.status')

			<h1> {{ __('lang.create_new_property') }} </h1>
			<div class='row'>
				<div class='col-xl-8 col-md-10 mx-auto'>
                    <form method="POST" action="{{ route('property.store') }}" class='add-form-con' enctype="multipart/form-data">
                        @csrf

                        {{-- Property Info --}}
						<div class='row'>
                            <h1> {{ __('lang.property_info') }} </h1>
                            <div class="col-12"></div>

                            <div class='col-md-4'>
								<div class='form-group'>
									<select name="category_id" class='form-control {{ $errors->first('category_id') ? 'is-invalid' : '' }}' title='City'>
                                        <option value="">{{ __('lang.category') }}</option>
                                        @foreach ($categories as $category)
                                            <option value='{{ $category->id}}'> {{ $category->name }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('category_id'))
                                        <div class="invalid-feedback text-danger">{{ $errors->first('category_id') }}</div>
                                    @endif
								</div>
							</div>

                            <div class='col-md-4'>
								<div class='form-group'>
									<select name="type_id" class='form-control {{ $errors->first('type_id') ? 'is-invalid' : '' }}' title='City'>
                                    <option value="">{{ __('lang.type') }}</option>
                                        @foreach ($types as $type)
                                            <option value='{{ $type->id}}'> {{ $type->name }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('type_id'))
                                        <div class="invalid-feedback text-danger">{{ $errors->first('type_id') }}</div>
                                    @endif
								</div>
                            </div>

                            <div class='col-md-4'>
								<div class='form-group'>
									<select name="completing_id" class='form-control {{ $errors->first('completing_id') ? 'is-invalid' : '' }}' title='City'>
                                        <option value="">{{ __('lang.property_status') }}</option>
                                        @foreach ($completings as $completing)
                                            <option value='{{ $completing->id}}'> {{ $completing->name }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('completing_id'))
                                        <div class="invalid-feedback text-danger">{{ $errors->first('completing_id') }}</div>
                                    @endif
								</div>
                            </div>

                            <div class='col-md-4'>
								<div class='form-group'>
									<select name="period_id" class='form-control {{ $errors->first('period_id') ? 'is-invalid' : '' }}' title='City'>
                                        <option value="">{{ __('lang.period') }}</option>
                                        @foreach ($periods as $period)
                                            <option value='{{ $period->id}}'> {{ $period->name }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('period_id'))
                                        <div class="invalid-feedback text-danger">{{ $errors->first('period_id') }}</div>
                                    @endif
								</div>
                            </div>
                            <div class='col-md-8'>
                                <div class='form-group'>
                                    <select name="amenities[]" placeholder="{{ __('lang.amenities') }}" class='form-control {{ $errors->first('amenities') ? 'is-invalid' : '' }} select2' multiple>
                                        <option value=""></option>
                                        @foreach ($amenities as $amenitie)
                                            <option value='{{ $amenitie->id}}'> {{ $amenitie->name }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->first('amenities'))
                                        <div class="invalid-feedback text-danger">{{ $errors->first('amenities') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Property Details --}}
                        <div class="row mt-4">

                            <h1> {{ __('lang.property_details') }} </h1>
                            <div class="col-12"></div>

                            <div class='col-md-12'>
								<div class='form-group'>
                                    <input class='form-control {{ $errors->first('ar.title') ? 'is-invalid' : '' }}'
                                            name="ar[title]"
                                            placeholder='{{ __('lang.ar_add_title') }}'
                                            title='{{ __('lang.add_title') }}'
                                            value="{{ old('ar.title', isset($property) ? $property->title : '') }}"
                                            type='text'>
                                    @if ($errors->first('ar.title'))
                                        <div class="invalid-feedback text-danger">{{ $errors->first('ar.title') }}</div>
                                    @endif
								</div>
                            </div>

                            <div class='col-md-12 mb-3'>
								<div class='form-group'>
                                    <input class='form-control {{ $errors->first('en.title') ? 'is-invalid' : '' }}'
                                            name="en[title]"
                                            placeholder='{{ __('lang.en_add_title') }}'
                                            title='{{ __('lang.add_title') }}'
                                            value="{{ old('en.title', isset($property) ? $property->title : '') }}"
                                            type='text'>
                                    @if ($errors->first('en.title'))
                                        <div class="invalid-feedback text-danger">{{ $errors->first('en.title') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class='col-md-4'>
								<div class='form-group'>
                                    <input class='form-control {{ $errors->first('price') ? 'is-invalid' : '' }}'
                                            name="price"
                                            placeholder='{{ __('lang.price') }}'
                                            title='price'
                                            value="{{ old('price', isset($property) ? $property->price : '') }}"
                                            type='number'>
                                    @if ($errors->first('price'))
                                        <div class="invalid-feedback text-danger">{{ $errors->first('price') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class='col-md-4'>
								<div class='form-group'>
                                    <input class='form-control {{ $errors->first('no_of_rooms') ? 'is-invalid' : '' }}'
                                            name="no_of_rooms"
                                            placeholder='{{ __('lang.no_of_rooms') }}'
                                            title='no_of_rooms'
                                            value="{{ old('no_of_rooms', isset($property) ? $property->no_of_rooms : '') }}"
                                            type='number'>
                                    @if ($errors->first('no_of_rooms'))
                                        <div class="invalid-feedback text-danger">{{ $errors->first('no_of_rooms') }}</div>
                                    @endif
								</div>
                            </div>

                            <div class='col-md-4'>
								<div class='form-group'>
                                    <input class='form-control {{ $errors->first('no_of_maidrooms') ? 'is-invalid' : '' }}'
                                            name="no_of_maidrooms"
                                            placeholder='{{ __('lang.no_of_maidrooms') }}'
                                            title='no_of_maidrooms'
                                            value="{{ old('no_of_maidrooms', isset($property) ? $property->no_of_maidrooms : '') }}"
                                            type='number'>
                                    @if ($errors->first('no_of_maidrooms'))
                                        <div class="invalid-feedback text-danger">{{ $errors->first('no_of_maidrooms') }}</div>
                                    @endif
								</div>
                            </div>

                            <div class='col-md-4'>
								<div class='form-group'>
                                    <input class='form-control {{ $errors->first('no_of_bathrooms') ? 'is-invalid' : '' }}'
                                            name="no_of_bathrooms"
                                            placeholder='{{ __('lang.no_of_bathrooms') }}'
                                            title='no_of_bathrooms'
                                            value="{{ old('no_of_bathrooms', isset($property) ? $property->no_of_bathrooms : '') }}"
                                            type='number'>
                                    @if ($errors->first('no_of_bathrooms'))
                                        <div class="invalid-feedback text-danger">{{ $errors->first('no_of_bathrooms') }}</div>
                                    @endif
								</div>
                            </div>
                        </div>

                        {{-- Property Area --}}
                        <div class="row my-2">
                            <p class="col-12 text-primary">{{ __('lang.area') }}</p>
                            <div class='col-2'>
								<div class='form-group'>
                                    <input class='form-control {{ $errors->first('height') ? 'is-invalid' : '' }}'
                                        name="height"
                                        value="{{ old('height', isset($property) ? $property->height : '') }}"
                                        placeholder='{{ __('lang.height') }}' type='number'>
                                    @if ($errors->first('height'))
                                        <div class="invalid-feedback text-danger">{{ $errors->first('height') }}</div>
                                    @endif
								</div>
                            </div>
                            *
                            <div class='col-2 mx-3'>
								<div class='form-group row'>
                                    <input class='form-control {{ $errors->first('width') ? 'is-invalid' : '' }}'
                                        name="width"
                                        value="{{ old('width', isset($property) ? $property->width : '') }}"
                                        placeholder='{{ __('lang.width') }}' type='number'>
                                    @if ($errors->first('width'))
                                        <div class="invalid-feedback text-danger">{{ $errors->first('width') }}</div>
                                    @endif
								</div>
                            </div>
                        </div>

                        {{-- Property Agent Info --}}
                        <div class="row mt-4">

                            <h1> {{ __('lang.agent_info') }} </h1>
                            <div class="col-12"></div>

                            <div class='col-md-4'>
								<div class='form-group'>
                                    <input class='form-control {{ $errors->first('agent_name') ? 'is-invalid' : '' }}'
                                            name="agent_name"
                                            placeholder='{{ __('lang.agent_name') }}'
                                            title='agent_name'
                                            value="{{ old('agent_name', isset($property) ? $property->agent_name : '') }}"
                                            type='text'>
                                    @if ($errors->first('agent_name'))
                                        <div class="invalid-feedback text-danger">{{ $errors->first('agent_name') }}</div>
                                    @endif
								</div>
                            </div>

                            <div class='col-md-4'>
								<div class='form-group'>
                                    <input class='form-control {{ $errors->first('agent_phone') ? 'is-invalid' : '' }}'
                                            name="agent_phone"
                                            placeholder='{{ __('lang.agent_phone') }}'
                                            title='agent_phone'
                                            value="{{ old('agent_phone', isset($property) ? $property->agent_phone : '') }}"
                                            type='text'>
                                    @if ($errors->first('agent_phone'))
                                        <div class="invalid-feedback text-danger">{{ $errors->first('agent_phone') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class='col-md-4'>
								<div class='form-group'>
                                    <input class='form-control {{ $errors->first('agent_email') ? 'is-invalid' : '' }}'
                                            name="agent_email"
                                            placeholder='{{ __('lang.agent_email') }}'
                                            title='agent_email'
                                            value="{{ old('agent_email', isset($property) ? $property->agent_email : '') }}"
                                            type='text'>
                                    @if ($errors->first('agent_email'))
                                        <div class="invalid-feedback text-danger">{{ $errors->first('agent_email') }}</div>
                                    @endif
								</div>
                            </div>
                        </div>

                        {{-- Property Desc --}}
                        <div class="row mt-3">
                            <h1> {{ __('lang.desc') }} </h1>
							<div class='col-12 mb-5'>
                                <textarea name="description" class="form-control {{ $errors->first('description') ? 'is-invalid' : '' }}" id="editor"></textarea>
                                @if ($errors->first('description'))
                                    <div class="invalid-feedback text-danger">{{ $errors->first('description') }}</div>
                                @endif
							</div>
                        </div>

                        {{-- Property Map --}}
                        <div class="row mt-3">
                            <h1> {{ __('lang.penPropertyOnMap') }} </h1>
							<div class='col-12 text-left'>
                                <div class='map-container'>
                                    <input id="pac-input" class="form-control mx-auto" type="text"
                                        placeholder="{{ __('lang.search') }}">
                                    <div id="map"></div>
                                </div>
                                <input type="hidden" name="lat">
                                <input type="hidden" name="lng">
                                <input type="hidden" name="address">
							</div>
                        </div>

                        {{-- Footer --}}
                        <div class="row mt-3">
                            <div class='col-12 text-left'>
								<button class='btn button add-new-property'>نشر</button>
							</div>
                        </div>

					</form>
				</div>
			</div>
		</div>
	</main>

@endsection

@section('script')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKU2pOeE34mizOMutB8WaCHNIfoYO7yPg&libraries=places&language={{ app()->getLocale() }}&callback=initMap"></script>
    <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendors/ckeditor/translations/ar.js') }}"></script>
    <script>

    // TextEditor
    ClassicEditor
    .create( document.querySelector( '#editor' ), {
        removePlugins: [ 'MediaEmbed', 'ImageUpload' ],
        language: '{{ app()->getLocale() }}'
    })
    .then( editor => {
    })
    .catch( error => {
    });

    // MAP
    var map;
    var marker;
    function initMap() {
        var myLatlng = {lat: 24.4128334, lng: 54.4749754};
        var geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(
        document.getElementById('map'), {
            zoom: 9,
            center: myLatlng,
            zoomControl: true,
            streetViewControl: true,
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

    // Handle Search Autocomplete
    function habdleAutocomplete() {

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');

        // Append Input to the Map
        // map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

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
            var address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');

            // Append values to form input
            $('.add-new-property').attr('disabled', 'disabled');
            $('input[name=lat]').val(place.geometry.location.lat());
            $('input[name=lng]').val(place.geometry.location.lng());
            $('input[name=address]').val(address);
            $('.add-new-property').removeAttr('disabled');



            // Add Window to Display this Location
            addInfoWidow(contentString(place.name, address));

        });
    }

        // Fill form inputs with place details
    function fillFormInputs(place, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {

            // Append values to form input
            $('.add-new-property').attr('disabled', 'disabled');
            $('input[name=lat]').val(place.geometry.location.lat());
            $('input[name=lng]').val(place.geometry.location.lng());
            $('input[name=address]').val(place.formatted_address);
            $('.add-new-property').removeAttr('disabled');
        }
    }

</script>
@endsection
