@extends('layouts.master')

@section('content')


<section class='home-page'>
    <search :countries="{{ json_encode($countries) }}"></search>
</section>


@endsection
