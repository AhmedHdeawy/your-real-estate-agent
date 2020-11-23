@extends('layouts.master')

@section('content')

<main class='search-results-page'>

    @include('front.search')

    <section class='units-sec'>
        <div class='container'>
            <div class='row'>
                <div class='col-sm-auto col-12 mb-3 my-md-auto text-center text-md-right'>
                    <h2> {{ __('lang.searchResult') }} </h2>
                </div>

            </div>
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
