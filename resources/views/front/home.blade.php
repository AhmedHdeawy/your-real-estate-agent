@extends('layouts.master')

@section('content')

<main class='homepage'>
		@include('front.search')
		<section class='units-sec'>
			<div class='container'>
				<h1>العقارات الموصى بها في دبي وأبوظبي</h1>
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
				<h2>تابع احدث الأخبار من وكيلك العقارى</h2>
				<div class='row'>
					<div class='col-lg-4 col-sm-6'>
						<div class='article' role='article'>
							<span class='date'>تاريخ النشر: 28-9-2020</span>
							<div class='article-img'>
								<img alt='Article Image' class='img-fluid' src='https://via.placeholder.com/538x317'>
							</div>
							<div class='article-data'>
								<h5>دليلك لأفضل 10 شركات نقل الأثاث في الشارقة</h5>
								<p>إذا كنت تخطط للانتقال وينتابك الخوف من أن ينال أثاثك أي ضرر أو كسر، فلا داعي للقلق حيال كل هذا؛ ستقوم شركات نقل الأثاث بتولي هذا الأمر مكانك،
								   فنقل الاثاث في الشارقة من أسهل ما يكون.</p>
								<a class='btn' href='#'>أقرأ المزيد</a>
							</div>
						</div>
					</div>
					<div class='col-lg-4 col-sm-6'>
						<div class='article' role='article'>
							<span class='date'>تاريخ النشر: 28-9-2020</span>
							<div class='article-img'>
								<img alt='Article Image' class='img-fluid' src='https://via.placeholder.com/538x317'>
							</div>
							<div class='article-data'>
								<h5>دليلك لأفضل 10 شركات نقل الأثاث في الشارقة</h5>
								<p>إذا كنت تخطط للانتقال وينتابك الخوف من أن ينال أثاثك أي ضرر أو كسر، فلا داعي للقلق حيال كل هذا؛ ستقوم شركات نقل الأثاث بتولي هذا الأمر مكانك،
								   فنقل الاثاث في الشارقة من أسهل ما يكون.</p>
								<a class='btn' href='#'>أقرأ المزيد</a>
							</div>
						</div>
					</div>
					<div class='col-lg-4 col-sm-6'>
						<div class='article' role='article'>
							<span class='date'>تاريخ النشر: 28-9-2020</span>
							<div class='article-img'>
								<img alt='Article Image' class='img-fluid' src='https://via.placeholder.com/538x317'>
							</div>
							<div class='article-data'>
								<h5>دليلك لأفضل 10 شركات نقل الأثاث في الشارقة</h5>
								<p>إذا كنت تخطط للانتقال وينتابك الخوف من أن ينال أثاثك أي ضرر أو كسر، فلا داعي للقلق حيال كل هذا؛ ستقوم شركات نقل الأثاث بتولي هذا الأمر مكانك،
								   فنقل الاثاث في الشارقة من أسهل ما يكون.</p>
								<a class='btn' href='#'>أقرأ المزيد</a>
							</div>
						</div>
					</div>
				</div>
				<a class='btn see-more' href='#'>قم بزياره مدونتنا</a>
			</div>
		</section>
	</main>

@endsection
