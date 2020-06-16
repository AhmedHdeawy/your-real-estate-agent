@extends('layouts.master')

@section('content')


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


{{-- Profile Data  / Start --}}

<div class="container contact-us mb-5 mt-5 px-1 px-md-5">
    <div class="row justify-content-center align-items-center">

        <div class="col-12 col-md-10">

            <div class="card border-rbzgo rounded-0">
                <div class="card-header p-0">
                    <div class="bg-rbzgo text-white text-center py-2">
                        <h3>{{ __('lang.groups') }} </h3>
                    </div>
                </div>
                <div class="card-body p-3">

                    <section class='profile-page'>
                        <div class='row'>
                            <div class='col-lg-8 col-md-10 mx-auto'>
                                <div class='groups'>

                                    <ul class='groups-body'>
                                        <li style='text-align: center;' class="mb-4">
                                            <a href='{{ route('groups.create') }}' class="btn btn-rbzgo">
                                                <i class='fas fa-plus text-white'></i>
                                                <span class="font-weight-bold text-white mx-1">
                                                    {{ __('lang.createGroup') }} </span>
                                            </a>
                                        </li>

                                        @forelse ($groups as $group)
                                        <li class='clearfix mb-4'>
                                            <a href='{{ route('groups.show', ['group_permlink'  => $group->unique_name]) }}'
                                                class="font-weight-bold color-rbzgo">
                                                @if ($group->image)
                                                <img src="{{ asset('images/' . $group->image) }}"
                                                    class="img-avatar {{ $currentLangDir == 'rtl' ? 'float-right' : 'float-left' }}">
                                                @else

                                                <avatar
                                                    class="img-avatar d-inline-block {{ $currentLangDir == 'rtl' ? 'float-right' : 'float-left' }}"
                                                    :username="{{ json_encode($group->nameForAvatar()) }}"
                                                    background-color="#7F78B4" color="#FFF">
                                                </avatar>
                                                @endif
                                                <span class="mx-3">
                                                    {{ $group->name }}
                                                    <span class="d-block text-secondary">
                                                        {{ $group->users_count }} {{ __('lang.member') }} -
                                                        {{ $group->posts_count }} {{ __('lang.post') }}
                                                    </span>
                                                </span>
                                            </a>

                                            <form action="{{ route('groups.leave') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="group_permlink"
                                                    value="{{ $group->unique_name }}">
                                                <button class='btn leave_group' type="submit">
                                                    <span> {{ __('lang.leave') }} </span>
                                                    <i class='fa fa-level-up-alt'></i>
                                                </button>
                                            </form>

                                        </li>
                                        @empty
                                        <li style='text-align: center;' class="mb-4">
                                            <p> {{ __('lang.noJoinedGroups') }}
                                                <a href='{{ route('groups.create') }}'
                                                    class="color-rbzgo font-weight-bold">
                                                    {{ __('lang.search') }}
                                                </a>
                                            </p>
                                        </li>
                                        @endforelse

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>

            </div>

        </div>

    </div>
</div>

{{-- Profile Data  / End --}}


@endsection
