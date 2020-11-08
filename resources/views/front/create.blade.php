@extends('layouts.master')

@section('style')
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
@endsection

@section('content')

<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.min.js"></script>
<link
rel="stylesheet"
href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.5.1/mapbox-gl-geocoder.css"
type="text/css"
/>
<!-- Promise polyfill script required to use Mapbox GL Geocoder in IE 11 -->
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>

<main class='add-unit'>
		<div class='container'>
			<h1> {{ __('lang.create_new_property') }} </h1>
			<div class='row'>
				<div class='col-xl-8 col-md-10 mx-auto'>
					<form class='add-form-con'>
						<div class='row'>
                            <h1> {{ __('lang.property_info') }} </h1>
                            <div class="col-12"></div>

                            <div class='col-md-4'>
								<div class='form-group'>
									<select class='form-control' title='City'>
                                        <option>{{ __('lang.category') }}</option>
                                        @foreach ($categories as $category)
                                            <option value='{{ $category->id}}'> {{ $category->name }} </option>
                                        @endforeach
									</select>
								</div>
							</div>

                            <div class='col-md-4'>
								<div class='form-group'>
									<select class='form-control' title='City'>
                                    <option>{{ __('lang.type') }}</option>
                                        @foreach ($types as $type)
                                            <option value='{{ $type->id}}'> {{ $type->name }} </option>
                                        @endforeach
									</select>
								</div>
                            </div>

                            <div class='col-md-4'>
								<div class='form-group'>
									<select class='form-control' title='City'>
                                        <option>{{ __('lang.amenities') }}</option>
                                        @foreach ($amenities as $amenitie)
                                            <option value='{{ $amenitie->id}}'> {{ $amenitie->name }} </option>
                                        @endforeach
									</select>
								</div>
							</div>

                            <div class='col-md-4'>
								<div class='form-group'>
									<select class='form-control' title='City'>
                                        <option>{{ __('lang.property_status') }}</option>
                                        @foreach ($completings as $completing)
                                            <option value='{{ $completing->id}}'> {{ $completing->name }} </option>
                                        @endforeach
									</select>
								</div>
                            </div>

                            <div class='col-md-4'>
								<div class='form-group'>
									<select class='form-control' title='City'>
                                        @foreach ($periods as $period)
                                            <option value='{{ $period->id}}'> {{ $period->name }} </option>
                                        @endforeach
									</select>
								</div>
                            </div>
                        </div>
                        <div class="row mt-4">

                            <h1> {{ __('lang.property_details') }} </h1>
                            <div class="col-12"></div>

                            <div class='col-md-12'>
								<div class='form-group'>
                                    <input class='form-control' name="ar[name]" placeholder='{{ __('lang.ar_add_title') }}' title='{{ __('lang.add_title') }}' type='text'>
								</div>
                            </div>

                            <div class='col-md-12 mb-3'>
								<div class='form-group'>
                                    <input class='form-control' name="en[name]" placeholder='{{ __('lang.en_add_title') }}' title='{{ __('lang.add_title') }}' type='text'>
								</div>
                            </div>

                            <div class='col-md-4'>
								<div class='form-group'>
                                    <input class='form-control' name="price" placeholder='{{ __('lang.price') }}' title='price' type='text'>
								</div>
                            </div>

                            <div class='col-md-4'>
								<div class='form-group'>
                                    <input class='form-control' name="no_of_rooms" placeholder='{{ __('lang.no_of_rooms') }}' title='no_of_rooms' type='text'>
								</div>
                            </div>

                            <div class='col-md-4'>
								<div class='form-group'>
                                    <input class='form-control' name="no_of_maidrooms" placeholder='{{ __('lang.no_of_maidrooms') }}' title='no_of_maidrooms' type='text'>
								</div>
                            </div>

                            <div class='col-md-4'>
								<div class='form-group'>
                                    <input class='form-control' name="no_of_bathrooms" placeholder='{{ __('lang.no_of_bathrooms') }}' title='no_of_bathrooms' type='text'>
								</div>
                            </div>
                        </div>
                        <div class="row my-2">
                            <p class="col-12 text-primary">{{ __('lang.area') }}</p>
                            <div class='col-2'>
								<div class='form-group'>
                                    <input class='form-control' name="area[]" placeholder='{{ __('lang.area') }}' title='area' type='text'>
								</div>
                            </div>
                            *
                            <div class='col-2 mx-3'>
								<div class='form-group row'>
                                    <input class='form-control' name="area[]" placeholder='{{ __('lang.area') }}' title='area' type='text'>
								</div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <h1> {{ __('lang.desc') }} </h1>
							<div class='col-12 mb-5'>
                                <div id="editor" style="height: 150px">
                                    <p></p>
                                </div>
							</div>
							<div class='col-12 text-left'>
								<div id='map' style='width: 100%; height: 500px;'></div>
							</div>

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
<script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
<script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendors/ckeditor/translations/ar.js') }}"></script>
<script>

    // TextEditor

    ClassicEditor
    .create( document.querySelector( '#editor' ), {
        removePlugins: [ 'MediaEmbed', 'ImageUpload' ],
        language: '{{ app()->getLocale() }}'
    } )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );



    // MAP

    mapboxgl.accessToken = 'pk.eyJ1IjoiYWhtZWRoZGVhd3kiLCJhIjoiY2s3eXFhYmppMDB6cDNtbzU5cmhydDNxNyJ9.fp3nCLW9HLkejiXjILSlBA';
    var map = new mapboxgl.Map({
        center: [29.975784, 31.276302],
        zoom: 3,
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11'
    });
    // Add Marker
    var marker = new mapboxgl.Marker({
        draggable: true
    }).setLngLat([29.975784, 31.276302]).addTo(map);

    // Add Controller to Map
    map.addControl(new mapboxgl.FullscreenControl());

    // Add Controller to Map
    map.addControl(new mapboxgl.GeolocateControl({
        positionOptions: { enableHighAccuracy: true },
        trackUserLocation: true
    }));

    var nav = new mapboxgl.NavigationControl();
    map.addControl(nav, 'top-left');
        function onDragEnd() {
            var lngLat = marker.getLngLat();
            var url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/'+ lngLat.lat +','+ lngLat.lng +'.json?language=ar&access_token=pk.eyJ1IjoiYWhtZWRoZGVhd3kiLCJhIjoiY2s3eXFhYmppMDB6cDNtbzU5cmhydDNxNyJ9.fp3nCLW9HLkejiXjILSlBA';

                axios.get(url).then((res) => {
                    if(typeof popup !== 'undefined') {
                        popup.remove();
                    }
                    var popup = new mapboxgl.Popup({ closeOnClick: false })
                        .setLngLat([lngLat.lat, lngLat.lng])
                        .setText(res.data.features[0].place_name)
                        .addTo(map);
                });
        }

        marker.on('dragend', onDragEnd);

</script>
@endsection
