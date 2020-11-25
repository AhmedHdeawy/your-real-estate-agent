@extends('layouts.master')

@section('content')

<main class='homepage'>
		@include('front.search')
		<section class='units-sec'>
			<div class='container'>
				<h1> {{ __('lang.recommended_properties') }} </h1>
				<div class='units-con'>
					<div class='row'>
                        @foreach ($properties as $property)
                            <div class='col-xl-3 col-md-4 col-sm-6'>
                                @include('front.property')
                            </div>
                        @endforeach

					</div>
				</div>
			</div>
		</section>
	</main>

@endsection
