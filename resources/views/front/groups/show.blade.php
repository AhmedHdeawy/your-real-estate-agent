@extends('layouts.master')

@section('content')


<section id="app" class='home-page'>
    <group :group="{{ json_encode($group) }}" :group-posts="{{ json_encode($posts) }}"></group>
</section>


@endsection