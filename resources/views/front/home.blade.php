@extends('layouts.master')

@section('content')

<main class='homepage'>
		@include('front.search')
		<section class='units-sec'>
			<div class='container'>
				<h1>العقارات الموصى بها في دبي وأبوظبي</h1>
				<div class='units-con'>
					<div class='row'>
						<div class='col-xl-3 col-md-4 col-sm-6'>
							<div class='unit'>
								<span class='tag'>للبيع</span>
								<div class='owl-carousel unit-images-carousel owl-theme'>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
								</div>
								<p class='location'>
									<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
										<path d='M0 0h24v24H0V0z' fill='none'/>
										<path
												d='M12 2C8.13 2 5 5.13 5 9c0 4.17 4.42 9.92 6.24 12.11.4.48 1.13.48 1.53 0C14.58 18.92 19 13.17 19 9c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z'/>
									</svg>
									تيرانوفا، المرابع العربية، دبي
								</p>
								<h6 class='unit-name'>Exclusive | Upgraded 5 Bedroom | Terranova</h6>
								<div class='unit-data'>
									<p>
										<span>نوع العقار:</span>
										فيلا
									</p>
									<p>
										<span>السعر:</span>
										4,350,000 درهم
									</p>
									<p>
										<span>المساحة:</span>
										408 متر مربع
									</p>
									<p>
										<span>عدد الغرف:</span>
										6
									</p>
								</div>
								<div class='btns-con'>
									<div class='row'>
										<div class='col-auto mx-auto'>
											<a class='btn visit'>
												<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
													<path d='M0 0h24v24H0V0z' fill='none'/>
													<path
															d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
												</svg>
												شاهد التفاصيل
											</a>
											<!--											<a class='btn' href='#'>-->
											<!--												<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>-->
											<!--													<path d='M0 0h24v24H0V0z' fill='none'/>-->
											<!--													<path-->
											<!--															d='M19.23 15.26l-2.54-.29c-.61-.07-1.21.14-1.64.57l-1.84 1.84c-2.83-1.44-5.15-3.75-6.59-6.59l1.85-1.85c.43-.43.64-1.03.57-1.64l-.29-2.52c-.12-1.01-.97-1.77-1.99-1.77H5.03c-1.13 0-2.07.94-2 2.07.53 8.54 7.36 15.36 15.89 15.89 1.13.07 2.07-.87 2.07-2v-1.73c.01-1.01-.75-1.86-1.76-1.98z'/>-->
											<!--												</svg>-->
											<!--												أتصل-->
											<!--											</a>-->
										</div>
										<!--										<div class='col-6'>-->
										<!--											<button class='btn'>-->
										<!--												<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>-->
										<!--													<path d='M0 0h24v24H0V0z' fill='none'/>-->
										<!--													<path-->
										<!--															d='M19.66 3.99c-2.64-1.8-5.9-.96-7.66 1.1-1.76-2.06-5.02-2.91-7.66-1.1-1.4.96-2.28 2.58-2.34 4.29-.14 3.88 3.3 6.99 8.55 11.76l.1.09c.76.69 1.93.69 2.69-.01l.11-.1c5.25-4.76 8.68-7.87 8.55-11.75-.06-1.7-.94-3.32-2.34-4.28zM12.1 18.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z'/>-->
										<!--												</svg>-->
										<!--												حفظ-->
										<!--											</button>-->
										<!--										</div>-->
									</div>
								</div>
								<!--<div class='link-con'>
									<a clasFs='visit'>
										<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
											<path d='M0 0h24v24H0V0z' fill='none'/>
											<path
													d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
										</svg>
										شاهد التفاصيل
									</a>
								</div>-->
							</div>
						</div>
						<div class='col-xl-3 col-md-4 col-sm-6'>
							<div class='unit'>
								<span class='tag'>للبيع</span>
								<div class='owl-carousel unit-images-carousel owl-theme'>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
								</div>
								<p class='location'>
									<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
										<path d='M0 0h24v24H0V0z' fill='none'/>
										<path
												d='M12 2C8.13 2 5 5.13 5 9c0 4.17 4.42 9.92 6.24 12.11.4.48 1.13.48 1.53 0C14.58 18.92 19 13.17 19 9c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z'/>
									</svg>
									تيرانوفا، المرابع العربية، دبي
								</p>
								<h6 class='unit-name'>Exclusive | Upgraded 5 Bedroom | Terranova</h6>
								<div class='unit-data'>
									<p>
										<span>نوع العقار:</span>
										فيلا
									</p>
									<p>
										<span>السعر:</span>
										4,350,000 درهم
									</p>
									<p>
										<span>المساحة:</span>
										408 متر مربع
									</p>
									<p>
										<span>عدد الغرف:</span>
										6
									</p>
								</div>
								<div class='btns-con'>
									<div class='row'>
										<div class='col-auto mx-auto'>
											<a class='btn visit'>
												<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
													<path d='M0 0h24v24H0V0z' fill='none'/>
													<path
															d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
												</svg>
												شاهد التفاصيل
											</a>
											<!--											<a class='btn' href='#'>-->
											<!--												<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>-->
											<!--													<path d='M0 0h24v24H0V0z' fill='none'/>-->
											<!--													<path-->
											<!--															d='M19.23 15.26l-2.54-.29c-.61-.07-1.21.14-1.64.57l-1.84 1.84c-2.83-1.44-5.15-3.75-6.59-6.59l1.85-1.85c.43-.43.64-1.03.57-1.64l-.29-2.52c-.12-1.01-.97-1.77-1.99-1.77H5.03c-1.13 0-2.07.94-2 2.07.53 8.54 7.36 15.36 15.89 15.89 1.13.07 2.07-.87 2.07-2v-1.73c.01-1.01-.75-1.86-1.76-1.98z'/>-->
											<!--												</svg>-->
											<!--												أتصل-->
											<!--											</a>-->
										</div>
										<!--										<div class='col-6'>-->
										<!--											<button class='btn'>-->
										<!--												<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>-->
										<!--													<path d='M0 0h24v24H0V0z' fill='none'/>-->
										<!--													<path-->
										<!--															d='M19.66 3.99c-2.64-1.8-5.9-.96-7.66 1.1-1.76-2.06-5.02-2.91-7.66-1.1-1.4.96-2.28 2.58-2.34 4.29-.14 3.88 3.3 6.99 8.55 11.76l.1.09c.76.69 1.93.69 2.69-.01l.11-.1c5.25-4.76 8.68-7.87 8.55-11.75-.06-1.7-.94-3.32-2.34-4.28zM12.1 18.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z'/>-->
										<!--												</svg>-->
										<!--												حفظ-->
										<!--											</button>-->
										<!--										</div>-->
									</div>
								</div>
								<!--<div class='link-con'>
									<a clasFs='visit'>
										<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
											<path d='M0 0h24v24H0V0z' fill='none'/>
											<path
													d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
										</svg>
										شاهد التفاصيل
									</a>
								</div>-->
							</div>
						</div>
						<div class='col-xl-3 col-md-4 col-sm-6'>
							<div class='unit'>
								<span class='tag'>للبيع</span>
								<div class='owl-carousel unit-images-carousel owl-theme'>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
								</div>
								<p class='location'>
									<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
										<path d='M0 0h24v24H0V0z' fill='none'/>
										<path
												d='M12 2C8.13 2 5 5.13 5 9c0 4.17 4.42 9.92 6.24 12.11.4.48 1.13.48 1.53 0C14.58 18.92 19 13.17 19 9c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z'/>
									</svg>
									تيرانوفا، المرابع العربية، دبي
								</p>
								<h6 class='unit-name'>Exclusive | Upgraded 5 Bedroom | Terranova</h6>
								<div class='unit-data'>
									<p>
										<span>نوع العقار:</span>
										فيلا
									</p>
									<p>
										<span>السعر:</span>
										4,350,000 درهم
									</p>
									<p>
										<span>المساحة:</span>
										408 متر مربع
									</p>
									<p>
										<span>عدد الغرف:</span>
										6
									</p>
								</div>
								<div class='btns-con'>
									<div class='row'>
										<div class='col-auto mx-auto'>
											<a class='btn visit'>
												<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
													<path d='M0 0h24v24H0V0z' fill='none'/>
													<path
															d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
												</svg>
												شاهد التفاصيل
											</a>
											<!--											<a class='btn' href='#'>-->
											<!--												<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>-->
											<!--													<path d='M0 0h24v24H0V0z' fill='none'/>-->
											<!--													<path-->
											<!--															d='M19.23 15.26l-2.54-.29c-.61-.07-1.21.14-1.64.57l-1.84 1.84c-2.83-1.44-5.15-3.75-6.59-6.59l1.85-1.85c.43-.43.64-1.03.57-1.64l-.29-2.52c-.12-1.01-.97-1.77-1.99-1.77H5.03c-1.13 0-2.07.94-2 2.07.53 8.54 7.36 15.36 15.89 15.89 1.13.07 2.07-.87 2.07-2v-1.73c.01-1.01-.75-1.86-1.76-1.98z'/>-->
											<!--												</svg>-->
											<!--												أتصل-->
											<!--											</a>-->
										</div>
										<!--										<div class='col-6'>-->
										<!--											<button class='btn'>-->
										<!--												<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>-->
										<!--													<path d='M0 0h24v24H0V0z' fill='none'/>-->
										<!--													<path-->
										<!--															d='M19.66 3.99c-2.64-1.8-5.9-.96-7.66 1.1-1.76-2.06-5.02-2.91-7.66-1.1-1.4.96-2.28 2.58-2.34 4.29-.14 3.88 3.3 6.99 8.55 11.76l.1.09c.76.69 1.93.69 2.69-.01l.11-.1c5.25-4.76 8.68-7.87 8.55-11.75-.06-1.7-.94-3.32-2.34-4.28zM12.1 18.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z'/>-->
										<!--												</svg>-->
										<!--												حفظ-->
										<!--											</button>-->
										<!--										</div>-->
									</div>
								</div>
								<!--<div class='link-con'>
									<a clasFs='visit'>
										<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
											<path d='M0 0h24v24H0V0z' fill='none'/>
											<path
													d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
										</svg>
										شاهد التفاصيل
									</a>
								</div>-->
							</div>
						</div>
						<div class='col-xl-3 col-md-4 col-sm-6'>
							<div class='unit'>
								<span class='tag'>للبيع</span>
								<div class='owl-carousel unit-images-carousel owl-theme'>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
								</div>
								<p class='location'>
									<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
										<path d='M0 0h24v24H0V0z' fill='none'/>
										<path
												d='M12 2C8.13 2 5 5.13 5 9c0 4.17 4.42 9.92 6.24 12.11.4.48 1.13.48 1.53 0C14.58 18.92 19 13.17 19 9c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z'/>
									</svg>
									تيرانوفا، المرابع العربية، دبي
								</p>
								<h6 class='unit-name'>Exclusive | Upgraded 5 Bedroom | Terranova</h6>
								<div class='unit-data'>
									<p>
										<span>نوع العقار:</span>
										فيلا
									</p>
									<p>
										<span>السعر:</span>
										4,350,000 درهم
									</p>
									<p>
										<span>المساحة:</span>
										408 متر مربع
									</p>
									<p>
										<span>عدد الغرف:</span>
										6
									</p>
								</div>
								<div class='btns-con'>
									<div class='row'>
										<div class='col-auto mx-auto'>
											<a class='btn visit'>
												<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
													<path d='M0 0h24v24H0V0z' fill='none'/>
													<path
															d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
												</svg>
												شاهد التفاصيل
											</a>
											<!--											<a class='btn' href='#'>-->
											<!--												<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>-->
											<!--													<path d='M0 0h24v24H0V0z' fill='none'/>-->
											<!--													<path-->
											<!--															d='M19.23 15.26l-2.54-.29c-.61-.07-1.21.14-1.64.57l-1.84 1.84c-2.83-1.44-5.15-3.75-6.59-6.59l1.85-1.85c.43-.43.64-1.03.57-1.64l-.29-2.52c-.12-1.01-.97-1.77-1.99-1.77H5.03c-1.13 0-2.07.94-2 2.07.53 8.54 7.36 15.36 15.89 15.89 1.13.07 2.07-.87 2.07-2v-1.73c.01-1.01-.75-1.86-1.76-1.98z'/>-->
											<!--												</svg>-->
											<!--												أتصل-->
											<!--											</a>-->
										</div>
										<!--										<div class='col-6'>-->
										<!--											<button class='btn'>-->
										<!--												<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>-->
										<!--													<path d='M0 0h24v24H0V0z' fill='none'/>-->
										<!--													<path-->
										<!--															d='M19.66 3.99c-2.64-1.8-5.9-.96-7.66 1.1-1.76-2.06-5.02-2.91-7.66-1.1-1.4.96-2.28 2.58-2.34 4.29-.14 3.88 3.3 6.99 8.55 11.76l.1.09c.76.69 1.93.69 2.69-.01l.11-.1c5.25-4.76 8.68-7.87 8.55-11.75-.06-1.7-.94-3.32-2.34-4.28zM12.1 18.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z'/>-->
										<!--												</svg>-->
										<!--												حفظ-->
										<!--											</button>-->
										<!--										</div>-->
									</div>
								</div>
								<!--<div class='link-con'>
									<a clasFs='visit'>
										<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
											<path d='M0 0h24v24H0V0z' fill='none'/>
											<path
													d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
										</svg>
										شاهد التفاصيل
									</a>
								</div>-->
							</div>
						</div>
						<div class='col-xl-3 col-md-4 col-sm-6'>
							<div class='unit'>
								<span class='tag'>للبيع</span>
								<div class='owl-carousel unit-images-carousel owl-theme'>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
								</div>
								<p class='location'>
									<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
										<path d='M0 0h24v24H0V0z' fill='none'/>
										<path
												d='M12 2C8.13 2 5 5.13 5 9c0 4.17 4.42 9.92 6.24 12.11.4.48 1.13.48 1.53 0C14.58 18.92 19 13.17 19 9c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z'/>
									</svg>
									تيرانوفا، المرابع العربية، دبي
								</p>
								<h6 class='unit-name'>Exclusive | Upgraded 5 Bedroom | Terranova</h6>
								<div class='unit-data'>
									<p>
										<span>نوع العقار:</span>
										فيلا
									</p>
									<p>
										<span>السعر:</span>
										4,350,000 درهم
									</p>
									<p>
										<span>المساحة:</span>
										408 متر مربع
									</p>
									<p>
										<span>عدد الغرف:</span>
										6
									</p>
								</div>
								<div class='btns-con'>
									<div class='row'>
										<div class='col-auto mx-auto'>
											<a class='btn visit'>
												<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
													<path d='M0 0h24v24H0V0z' fill='none'/>
													<path
															d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
												</svg>
												شاهد التفاصيل
											</a>
											<!--											<a class='btn' href='#'>-->
											<!--												<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>-->
											<!--													<path d='M0 0h24v24H0V0z' fill='none'/>-->
											<!--													<path-->
											<!--															d='M19.23 15.26l-2.54-.29c-.61-.07-1.21.14-1.64.57l-1.84 1.84c-2.83-1.44-5.15-3.75-6.59-6.59l1.85-1.85c.43-.43.64-1.03.57-1.64l-.29-2.52c-.12-1.01-.97-1.77-1.99-1.77H5.03c-1.13 0-2.07.94-2 2.07.53 8.54 7.36 15.36 15.89 15.89 1.13.07 2.07-.87 2.07-2v-1.73c.01-1.01-.75-1.86-1.76-1.98z'/>-->
											<!--												</svg>-->
											<!--												أتصل-->
											<!--											</a>-->
										</div>
										<!--										<div class='col-6'>-->
										<!--											<button class='btn'>-->
										<!--												<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>-->
										<!--													<path d='M0 0h24v24H0V0z' fill='none'/>-->
										<!--													<path-->
										<!--															d='M19.66 3.99c-2.64-1.8-5.9-.96-7.66 1.1-1.76-2.06-5.02-2.91-7.66-1.1-1.4.96-2.28 2.58-2.34 4.29-.14 3.88 3.3 6.99 8.55 11.76l.1.09c.76.69 1.93.69 2.69-.01l.11-.1c5.25-4.76 8.68-7.87 8.55-11.75-.06-1.7-.94-3.32-2.34-4.28zM12.1 18.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z'/>-->
										<!--												</svg>-->
										<!--												حفظ-->
										<!--											</button>-->
										<!--										</div>-->
									</div>
								</div>
								<!--<div class='link-con'>
									<a clasFs='visit'>
										<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
											<path d='M0 0h24v24H0V0z' fill='none'/>
											<path
													d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
										</svg>
										شاهد التفاصيل
									</a>
								</div>-->
							</div>
						</div>
						<div class='col-xl-3 col-md-4 col-sm-6'>
							<div class='unit'>
								<span class='tag'>للبيع</span>
								<div class='owl-carousel unit-images-carousel owl-theme'>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
								</div>
								<p class='location'>
									<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
										<path d='M0 0h24v24H0V0z' fill='none'/>
										<path
												d='M12 2C8.13 2 5 5.13 5 9c0 4.17 4.42 9.92 6.24 12.11.4.48 1.13.48 1.53 0C14.58 18.92 19 13.17 19 9c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z'/>
									</svg>
									تيرانوفا، المرابع العربية، دبي
								</p>
								<h6 class='unit-name'>Exclusive | Upgraded 5 Bedroom | Terranova</h6>
								<div class='unit-data'>
									<p>
										<span>نوع العقار:</span>
										فيلا
									</p>
									<p>
										<span>السعر:</span>
										4,350,000 درهم
									</p>
									<p>
										<span>المساحة:</span>
										408 متر مربع
									</p>
									<p>
										<span>عدد الغرف:</span>
										6
									</p>
								</div>
								<div class='btns-con'>
									<div class='row'>
										<div class='col-auto mx-auto'>
											<a class='btn visit'>
												<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
													<path d='M0 0h24v24H0V0z' fill='none'/>
													<path
															d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
												</svg>
												شاهد التفاصيل
											</a>
											<!--											<a class='btn' href='#'>-->
											<!--												<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>-->
											<!--													<path d='M0 0h24v24H0V0z' fill='none'/>-->
											<!--													<path-->
											<!--															d='M19.23 15.26l-2.54-.29c-.61-.07-1.21.14-1.64.57l-1.84 1.84c-2.83-1.44-5.15-3.75-6.59-6.59l1.85-1.85c.43-.43.64-1.03.57-1.64l-.29-2.52c-.12-1.01-.97-1.77-1.99-1.77H5.03c-1.13 0-2.07.94-2 2.07.53 8.54 7.36 15.36 15.89 15.89 1.13.07 2.07-.87 2.07-2v-1.73c.01-1.01-.75-1.86-1.76-1.98z'/>-->
											<!--												</svg>-->
											<!--												أتصل-->
											<!--											</a>-->
										</div>
										<!--										<div class='col-6'>-->
										<!--											<button class='btn'>-->
										<!--												<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>-->
										<!--													<path d='M0 0h24v24H0V0z' fill='none'/>-->
										<!--													<path-->
										<!--															d='M19.66 3.99c-2.64-1.8-5.9-.96-7.66 1.1-1.76-2.06-5.02-2.91-7.66-1.1-1.4.96-2.28 2.58-2.34 4.29-.14 3.88 3.3 6.99 8.55 11.76l.1.09c.76.69 1.93.69 2.69-.01l.11-.1c5.25-4.76 8.68-7.87 8.55-11.75-.06-1.7-.94-3.32-2.34-4.28zM12.1 18.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z'/>-->
										<!--												</svg>-->
										<!--												حفظ-->
										<!--											</button>-->
										<!--										</div>-->
									</div>
								</div>
								<!--<div class='link-con'>
									<a clasFs='visit'>
										<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
											<path d='M0 0h24v24H0V0z' fill='none'/>
											<path
													d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
										</svg>
										شاهد التفاصيل
									</a>
								</div>-->
							</div>
						</div>
						<div class='col-xl-3 col-md-4 col-sm-6'>
							<div class='unit'>
								<span class='tag'>للبيع</span>
								<div class='owl-carousel unit-images-carousel owl-theme'>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
								</div>
								<p class='location'>
									<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
										<path d='M0 0h24v24H0V0z' fill='none'/>
										<path
												d='M12 2C8.13 2 5 5.13 5 9c0 4.17 4.42 9.92 6.24 12.11.4.48 1.13.48 1.53 0C14.58 18.92 19 13.17 19 9c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z'/>
									</svg>
									تيرانوفا، المرابع العربية، دبي
								</p>
								<h6 class='unit-name'>Exclusive | Upgraded 5 Bedroom | Terranova</h6>
								<div class='unit-data'>
									<p>
										<span>نوع العقار:</span>
										فيلا
									</p>
									<p>
										<span>السعر:</span>
										4,350,000 درهم
									</p>
									<p>
										<span>المساحة:</span>
										408 متر مربع
									</p>
									<p>
										<span>عدد الغرف:</span>
										6
									</p>
								</div>
								<div class='btns-con'>
									<div class='row'>
										<div class='col-auto mx-auto'>
											<a class='btn visit'>
												<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
													<path d='M0 0h24v24H0V0z' fill='none'/>
													<path
															d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
												</svg>
												شاهد التفاصيل
											</a>
											<!--											<a class='btn' href='#'>-->
											<!--												<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>-->
											<!--													<path d='M0 0h24v24H0V0z' fill='none'/>-->
											<!--													<path-->
											<!--															d='M19.23 15.26l-2.54-.29c-.61-.07-1.21.14-1.64.57l-1.84 1.84c-2.83-1.44-5.15-3.75-6.59-6.59l1.85-1.85c.43-.43.64-1.03.57-1.64l-.29-2.52c-.12-1.01-.97-1.77-1.99-1.77H5.03c-1.13 0-2.07.94-2 2.07.53 8.54 7.36 15.36 15.89 15.89 1.13.07 2.07-.87 2.07-2v-1.73c.01-1.01-.75-1.86-1.76-1.98z'/>-->
											<!--												</svg>-->
											<!--												أتصل-->
											<!--											</a>-->
										</div>
										<!--										<div class='col-6'>-->
										<!--											<button class='btn'>-->
										<!--												<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>-->
										<!--													<path d='M0 0h24v24H0V0z' fill='none'/>-->
										<!--													<path-->
										<!--															d='M19.66 3.99c-2.64-1.8-5.9-.96-7.66 1.1-1.76-2.06-5.02-2.91-7.66-1.1-1.4.96-2.28 2.58-2.34 4.29-.14 3.88 3.3 6.99 8.55 11.76l.1.09c.76.69 1.93.69 2.69-.01l.11-.1c5.25-4.76 8.68-7.87 8.55-11.75-.06-1.7-.94-3.32-2.34-4.28zM12.1 18.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z'/>-->
										<!--												</svg>-->
										<!--												حفظ-->
										<!--											</button>-->
										<!--										</div>-->
									</div>
								</div>
								<!--<div class='link-con'>
									<a clasFs='visit'>
										<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
											<path d='M0 0h24v24H0V0z' fill='none'/>
											<path
													d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
										</svg>
										شاهد التفاصيل
									</a>
								</div>-->
							</div>
						</div>
						<div class='col-xl-3 col-md-4 col-sm-6'>
							<div class='unit'>
								<span class='tag'>للبيع</span>
								<div class='owl-carousel unit-images-carousel owl-theme'>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
									<div class='item'>
										<div class='image-con'>
											<img alt='Unit Image' class='img-fluid' src='https://via.placeholder.com/360x280'>
										</div>
									</div>
								</div>
								<p class='location'>
									<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
										<path d='M0 0h24v24H0V0z' fill='none'/>
										<path
												d='M12 2C8.13 2 5 5.13 5 9c0 4.17 4.42 9.92 6.24 12.11.4.48 1.13.48 1.53 0C14.58 18.92 19 13.17 19 9c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z'/>
									</svg>
									تيرانوفا، المرابع العربية، دبي
								</p>
								<h6 class='unit-name'>Exclusive | Upgraded 5 Bedroom | Terranova</h6>
								<div class='unit-data'>
									<p>
										<span>نوع العقار:</span>
										فيلا
									</p>
									<p>
										<span>السعر:</span>
										4,350,000 درهم
									</p>
									<p>
										<span>المساحة:</span>
										408 متر مربع
									</p>
									<p>
										<span>عدد الغرف:</span>
										6
									</p>
								</div>
								<div class='btns-con'>
									<div class='row'>
										<div class='col-auto mx-auto'>
											<a class='btn visit'>
												<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
													<path d='M0 0h24v24H0V0z' fill='none'/>
													<path
															d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
												</svg>
												شاهد التفاصيل
											</a>
											<!--											<a class='btn' href='#'>-->
											<!--												<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>-->
											<!--													<path d='M0 0h24v24H0V0z' fill='none'/>-->
											<!--													<path-->
											<!--															d='M19.23 15.26l-2.54-.29c-.61-.07-1.21.14-1.64.57l-1.84 1.84c-2.83-1.44-5.15-3.75-6.59-6.59l1.85-1.85c.43-.43.64-1.03.57-1.64l-.29-2.52c-.12-1.01-.97-1.77-1.99-1.77H5.03c-1.13 0-2.07.94-2 2.07.53 8.54 7.36 15.36 15.89 15.89 1.13.07 2.07-.87 2.07-2v-1.73c.01-1.01-.75-1.86-1.76-1.98z'/>-->
											<!--												</svg>-->
											<!--												أتصل-->
											<!--											</a>-->
										</div>
										<!--										<div class='col-6'>-->
										<!--											<button class='btn'>-->
										<!--												<svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>-->
										<!--													<path d='M0 0h24v24H0V0z' fill='none'/>-->
										<!--													<path-->
										<!--															d='M19.66 3.99c-2.64-1.8-5.9-.96-7.66 1.1-1.76-2.06-5.02-2.91-7.66-1.1-1.4.96-2.28 2.58-2.34 4.29-.14 3.88 3.3 6.99 8.55 11.76l.1.09c.76.69 1.93.69 2.69-.01l.11-.1c5.25-4.76 8.68-7.87 8.55-11.75-.06-1.7-.94-3.32-2.34-4.28zM12.1 18.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z'/>-->
										<!--												</svg>-->
										<!--												حفظ-->
										<!--											</button>-->
										<!--										</div>-->
									</div>
								</div>
								<!--<div class='link-con'>
									<a clasFs='visit'>
										<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
											<path d='M0 0h24v24H0V0z' fill='none'/>
											<path
													d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
										</svg>
										شاهد التفاصيل
									</a>
								</div>-->
							</div>
						</div>
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
