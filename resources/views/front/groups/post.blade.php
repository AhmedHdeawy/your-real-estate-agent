@extends('layouts.master')

@section('content')


<section class='home-page'>
    <show-post :post="{{ json_encode($post) }}"></show-post>
</section>


@endsection
