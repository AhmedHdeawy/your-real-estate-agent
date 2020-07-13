@extends('layouts.master')

@section('content')

<section class='view-profile-page'>
    <div class='cover-img' data-toggle='modal' data-target='#coverImage'></div>
    <div class='user-data'>
        <div class='img-con'>
            @if ($user->avatar)
                <img src="{{  asset('uploads/users/' . $user->avatar) }}">
            @else
                <img src="{{  asset('uploads/no-img.png') }}">
            @endif
        </div>
        <div class='data-con'>
            <h3> {{ $user->name }} </h3>
        </div>
    </div>
    <div class='row mt-5 mt-md-2 mb-5'>
        <div class='col-12 col-md-8 mx-auto'>
            <div class='posts-con'>
                <ul class="nav justify-content-center px-0">
                    <li class="nav-item text-center">
                        <h5 class="nav-link p-0 font-weight-bold color-rbzgo">
                            {{ count($user->firendsOfMine) }}
                        </h5>
                        <h5 class="nav-link p-0 mb-0 font-weight-bold color-rbzgo">
                            {{ __('lang.following') }}
                        </h5>
                    </li>
                    <li class="nav-item text-center mx-3 mx-md-5">
                        <h5 class="nav-link p-0 font-weight-bold color-rbzgo">
                            {{ count($user->firendOf) }}
                        </h5>
                        <h5 class="nav-link p-0 mb-0 font-weight-bold color-rbzgo">
                            {{ __('lang.followers') }}
                        </h5>
                    </li>
                    <li class="nav-item text-center">
                        <h5 class="nav-link p-0 font-weight-bold color-rbzgo">
                            {{ $userLikes }}
                        </h5>
                        <h5 class="nav-link p-0 mb-0 font-weight-bold color-rbzgo">
                            {{ __('lang.likes') }}
                        </h5>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Start Cover Image Modal -->
    <div class='modal fade' id='coverImage' tabindex='-1' role='dialog' aria-labelledby='coverImageLabel'
        aria-hidden='true'>
        <div class='modal-dialog' role='document'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <div class='img-con'>
                        <img class='img-fluid' src='../../images/cover.jpg' alt='Cover Image'>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Cover Image Modal -->
</section>


@if ($user->is(auth()->user()))
    {{-- Profile Data  / Start --}}
    <div class="container contact-us mb-5 mt-5 px-1 px-md-5">
        <div class="row justify-content-center align-items-center">

            <div class="col-12 col-md-10">

                @if (session('status'))
                <div class="alert alert-success text-sm-center">
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h6>{{ session('status') }}</h6>
                </div>
                @endif


                <!--Form with header-->
                <form action="{{ route('updateProfile') }}" method="post" enctype="multipart/form-data">

                    @csrf

                    <div class="card border-rbzgo rounded-0">
                        <div class="card-header p-0">
                            <div class="bg-rbzgo text-white text-center py-2">
                                <h3>{{ __('lang.profileTitle') }} </h3>
                            </div>
                        </div>
                        <div class="card-body p-3">

                            <!--Body-->

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-user color-rbzgo"></i></div>
                                    </div>
                                    <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                                        id="name" name="name" placeholder="{{ __('lang.name') }}"
                                        value="{{ old('name') ? old('name') : auth()->user()->name }}">
                                    @if ($errors->first('name'))
                                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-phone color-rbzgo"></i></div>
                                    </div>
                                    <input type="text"
                                        class="form-control {{ $errors->first('phone') ? 'is-invalid' : '' }}" id="phone"
                                        name="phone" value="{{ old('phone') ? old('phone') : auth()->user()->phone }}"
                                        placeholder="{{ __('lang.phone') }}">

                                    @if ($errors->first('phone'))
                                    <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-envelope color-rbzgo"></i></div>
                                    </div>
                                    <input type="email"
                                        class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" id="email"
                                        name="email" value="{{ old('email') ? old('email') : auth()->user()->email }}"
                                        placeholder="{{ __('lang.email') }}">
                                    @if ($errors->first('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-lock color-rbzgo"></i></div>
                                    </div>
                                    <input type="password"
                                        class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                                        id="password" name="password" placeholder="{{ __('lang.password') }}" value="">
                                    @if ($errors->first('password'))
                                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-lock color-rbzgo"></i></div>
                                    </div>
                                    <input type="password"
                                        class="form-control {{ $errors->first('password_confirmation') ? 'is-invalid' : '' }}"
                                        id="password_confirmation" name="password_confirmation"
                                        placeholder="{{ __('lang.password_confirmation') }}" value="">
                                    @if ($errors->first('password_confirmation'))
                                    <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-2">
                                    {{-- <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-lock color-rbzgo"></i></div>
                                    </div> --}}
                                    @include('dashboard.includes.uploadImage',
                                    ['name' => 'avatar', 'value' => auth()->check() ? auth()->user()->avatar : null, 'path'
                                    => 'uploads/users/']
                                    )

                                    @if ($errors->first('avatar'))
                                    <div class="invalid-feedback">{{ $errors->first('avatar') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="text-center">
                                <input type="submit" value="{{ __('lang.update') }}"
                                    class="btn btn-rbzgo btn-block rounded-0 py-2">
                            </div>
                        </div>

                    </div>
                </form>
                <!--Form with header-->

            </div>

        </div>
    </div>
    {{-- Profile Data  / End --}}
@endif

@endsection
