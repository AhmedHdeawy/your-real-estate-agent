@extends('layouts.master')

@section('content')

<main class='article-page'>
    <div class='container'>
        <div class='article-viewed'>
            <h1> {{ $blog->title }} </h1>
            <div class='row'>
                <div class='col-lg-8 col-md-10 mx-auto'>
                    <div class='article-img'>
                        <img alt='{{ $blog->title }}' class='img-fluid' src='{{ $blog->image_url }}'>
                    </div>
                    <div class='post-date'>
                        {{ __('lang.published_date') }}
                        {{ \Carbon\Carbon::parse($blog->created_at)->format('Y-m-d') }}
                    </div>
                    <div class='article-data'>
                        {!! $blog->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
