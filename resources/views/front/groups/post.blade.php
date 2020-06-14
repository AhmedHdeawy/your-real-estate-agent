@extends('layouts.master')

@section('content')


<section id="app" class='home-page'>
    <show-post :post="{{ json_encode($post) }}"></show-post>
</section>


@endsection
