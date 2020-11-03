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
			<h1>أضف إعلان جديد</h1>
			<div class='row'>
				<div class='col-xl-8 col-md-10 mx-auto'>
					<form class='add-form-con'>
						<div class='row'>
							<div class='col-md-4'>
								<div class='form-group'>
									<input class='form-control' placeholder='اسم الإعلان' title='ad name' type='text'>
								</div>
							</div>
							<div class='col-md-4'>
								<div class='form-group'>
									<select class='custom-select form-control' title='City'>
										<option selected>أختر المدينه</option>
										<option value='1'>One</option>
										<option value='2'>Two</option>
										<option value='3'>Three</option>
									</select>
								</div>
							</div>
							<div class='col-12'>
								<div class='form-group'>
									<textarea class='form-control' name='Description' placeholder='وصف العقار' title='Description'></textarea>
								</div>
							</div>
							<div class='col-12 text-left'>
								<div id='map' style='width: 700px; height: 500px;'></div>
							</div>

                            <div class='col-12 text-left'>
								<button class='btn'>نشر</button>
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
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiYWhtZWRoZGVhd3kiLCJhIjoiY2s3eXFhYmppMDB6cDNtbzU5cmhydDNxNyJ9.fp3nCLW9HLkejiXjILSlBA';
var map = new mapboxgl.Map({
        center: [29.975784, 31.276302],
        zoom: 3,
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11'
    });
    var marker = new mapboxgl.Marker({
        draggable: true
    })
    .setLngLat([29.975784, 31.276302])
    .addTo(map);

    map.addControl(new mapboxgl.FullscreenControl());


    map.addControl(new mapboxgl.GeolocateControl({
    positionOptions: {
    enableHighAccuracy: true
    },
    trackUserLocation: true
    }));

    var nav = new mapboxgl.NavigationControl();
    map.addControl(nav, 'top-left');


        function onDragEnd() {
            var lngLat = marker.getLngLat();

            var url = 'https://api.mapbox.com/geocoding/v5/mapbox.places/'+ lngLat.lat +','+ lngLat.lng +'.json?language=ar&access_token=pk.eyJ1IjoiYWhtZWRoZGVhd3kiLCJhIjoiY2s3eXFhYmppMDB6cDNtbzU5cmhydDNxNyJ9.fp3nCLW9HLkejiXjILSlBA';

                axios.get(url).then((res) => {
                    console.log(res.data.features[0].place_name);
                    var popup = new mapboxgl.Popup({ closeOnClick: false })
                        .setLngLat([lngLat.lat, lngLat.lng])
                        .setHTML('<p>'+res.data.features[0].place_name+'</p>')
                        .addTo(map);
                });
        }

        marker.on('dragend', onDragEnd);

</script>
@endsection
