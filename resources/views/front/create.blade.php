@extends('layouts.master')

@section('style')
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.css' rel='stylesheet' />
    <link rel="stylesheet" href="{{ asset('vendors/select2/css/select2.min.css') }}">
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

            @include('front.includes.status')

			<h1> {{ __('lang.create_new_property') }} </h1>
			<div class='row'>
				<div class='col-xl-8 col-md-10 mx-auto'>
                    <form method="POST" action="{{ route('property.store') }}" class='add-form-con'>
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

                        {{-- Property Desc, Map --}}
                        <div class="row mt-3">
                            <h1> {{ __('lang.desc') }} </h1>
							<div class='col-12 mb-5'>
                                <textarea name="description" class="form-control {{ $errors->first('description') ? 'is-invalid' : '' }}" id="editor"></textarea>
                                @if ($errors->first('description'))
                                    <div class="invalid-feedback text-danger">{{ $errors->first('description') }}</div>
                                @endif
							</div>
							<div class='col-12 text-left'>
								<div id='map' style='width: 100%; height: 500px;'></div>
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
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.12.0/mapbox-gl.js'></script>
    <script src="{{ asset('vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendors/ckeditor/translations/ar.js') }}"></script>
    <script src="{{ asset('vendors/select2/js/select2.min.js') }}"></script>
    <script>

    // TextEditor
    ClassicEditor
    .create( document.querySelector( '#editor' ), {
        removePlugins: [ 'MediaEmbed', 'ImageUpload' ],
        language: '{{ app()->getLocale() }}'
    })
    .then( editor => {
        console.log( editor );
    })
    .catch( error => {
        console.error( error );
    });

    // Select2
    var select2 = $('.select2');
    select2.select2({
        placeholder: select2.attr('placeholder'),
        // allowClear: true
    });


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

    // Event on Drag Marker
    function onDragEnd() {
        $('.add-new-property').attr('disabled', 'disabled');
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

                    $('.add-new-property').removeAttr('disabled');
            });
    }
    // Fire Event
    marker.on('dragend', onDragEnd);

</script>
@endsection
