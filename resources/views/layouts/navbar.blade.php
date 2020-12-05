<nav class='navbar navbar-expand-lg'>
	<div class='container'>
		<a class='navbar-brand' href='/'>
                <h4 class="text-white font-weight-bold">
                    {{ __('lang.websiteName') }}
                </h4>
                <span class="d-block text-white">beta</span>
		</a>
		<button aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation' class='navbar-toggler'
		        data-target='#navbarSupportedContent'
		        data-toggle='collapse' type='button'>
			<svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
				<path d='M0 0h24v24H0V0z' fill='none'/>
				<path
						d='M4 18h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1s.45 1 1 1zm0-5h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1s.45 1 1 1zM3 7c0 .55.45 1 1 1h16c.55 0 1-.45 1-1s-.45-1-1-1H4c-.55 0-1 .45-1 1z'/>
			</svg>
		</button>
		<div class='collapse navbar-collapse' id='navbarSupportedContent'>
			<ul class='navbar-nav {{ $currentLangDir == 'rtl' ? 'mr-auto' : 'ml-auto'  }}'>
                @foreach ($navCategories as $navCategory)
                    <li class='nav-item'>
                        <a class='nav-link'
                            href='{{ route('category', $navCategory->id . '-' . make_slug($navCategory->name)) }}'>
                                {{ $navCategory->name }}
                        </a>
                    </li>
                @endforeach
                @auth
                    <li class='nav-item'>
                    <a class='nav-link' href='{{ route('property.create') }}'>{{ __('lang.create_new_property') }}</a>
                    </li>
                @endauth
                @if (!auth()->check())
				    <li class='nav-item dropdown'>
                        <a aria-expanded='false' aria-haspopup='true' class='nav-link btn' data-toggle='dropdown' href='#' id='navbarDropdown' role='button'>
                            حسابي
                            <svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M24 24H0V0h24v24z' fill='none' opacity='.87'/>
                                <path
                                        d='M15.88 9.29L12 13.17 8.12 9.29c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41l4.59 4.59c.39.39 1.02.39 1.41 0l4.59-4.59c.39-.39.39-1.02 0-1.41-.39-.38-1.03-.39-1.42 0z'/>
                            </svg>
                        </a>
                        <div aria-labelledby='navbarDropdown' class='dropdown-menu'>
                            <a class='dropdown-item' href='{{ route('login') }}'> {{ __('lang.login') }} </a>
                            <a class='dropdown-item' href='{{ route('register') }}'> {{ __('lang.register') }} </a>
                        </div>
                    </li>
                @endif

                @auth

                    <li class='nav-item dropdown'>
                        <a aria-expanded='false' aria-haspopup='true' class='nav-link btn' data-toggle='dropdown' href='#' id='navbarDropdown' role='button'>
                            {{ auth()->user()->name }}
                            <svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M24 24H0V0h24v24z' fill='none' opacity='.87'/>
                                <path
                                        d='M15.88 9.29L12 13.17 8.12 9.29c-.39-.39-1.02-.39-1.41 0-.39.39-.39 1.02 0 1.41l4.59 4.59c.39.39 1.02.39 1.41 0l4.59-4.59c.39-.39.39-1.02 0-1.41-.39-.38-1.03-.39-1.42 0z'/>
                            </svg>
                        </a>
                        <div aria-labelledby='navbarDropdown' class='dropdown-menu'>
                            <a class='dropdown-item' href='{{ route('savedProperties') }}'> {{ __('lang.mySaved') }} </a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class='dropdown-item' type="submit">
                                    {{ __('lang.logout') }}
                                </button>
                            </form>
                        </div>
                    </li>
                @endauth
                <li class='nav-item'>
					<a class='nav-link btn' href="{{ str_replace( request()->segment(1),  $localeLangInverse, url()->full() ) }}">
                        {{ __('dashboard.'.$localeLangInverse.'.inverse') }}
                    </a>
                </li>
			</ul>
		</div>
	</div>
</nav>
