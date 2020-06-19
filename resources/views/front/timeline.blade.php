@extends('layouts.master')

@section('content')

<div class='container'>
    <section class='landing-page'>
        <div>
            <home-groups></home-groups>
        </div>
    </section>

    <section class="home-page mt-4">

        <home-posts :posts-data="{{ json_encode($posts) }}"></home-posts>
    </section>

</div>

@endsection
