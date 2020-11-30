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
		<section class='articles-sec'>
			<div class='container'>
				<h2> {{ __('lang.recent_news') }} </h2>
				<div class='row'>
                    @foreach ($blogs as $blog)
                    <div class='col-lg-4 col-sm-6'>
						<div class='article' role='article'>
							<span class='date'>
                                {{ __('lang.published_date') }}
                                {{ \Carbon\Carbon::parse($blog->created_at)->format('Y-m-d') }}
                            </span>
							<div class='article-img'>
                            <img alt='{{ $blog->title }}' class='img-fluid' src='{{ $blog->image_url }}'>
							</div>
							<div class='article-data'>
								<h5> {{ $blog->title }} </h5>
								<p>
                                    {{ str_limit(strip_tags($blog->content), 150, '...') }}
                                </p>
                            <a class='btn'
                                href='{{ route('blog', $blog->id . '-' . make_slug($blog->title)) }}'> {{ __('lang.read_more') }} </a>
							</div>
						</div>
					</div>
                    @endforeach
				</div>
				<a class='btn see-more' href='{{ route('blogs') }}'> {{ __('lang.visit_blog') }} </a>
			</div>
		</section>
	</main>

@endsection
