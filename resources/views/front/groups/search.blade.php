@extends('layouts.master')

@section('content')


<section id="app" class='home-page'>
    <search :countries="{{ json_encode($countries) }}"></search>
</section>


@endsection
