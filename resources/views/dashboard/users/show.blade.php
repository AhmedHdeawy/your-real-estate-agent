@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">{{ __('dashboard.users') }}</a></li>
      <li class="breadcrumb-item active">{{ __('dashboard.show') }}</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">
            <div class="card-block">

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.name') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $user->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.age') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $user->age }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.phone') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $user->phone }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.email') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $user->email }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.image') }} :
                    </div>
                    <div class="col-sm-10">
                        @if ($user->avatar)
                        <img src="{{ asset('uploads/users/'.$user->avatar) }}" class="img-fluid img-thumbnail" width="300px">
                        @else
                            --
                        @endif
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.status') }} :
                    </div>
                    <div class="col-sm-10">
                        @if($user->status == 1)
                            <strong class="text-success">{{ __('dashboard.active') }}</strong>
                        @else
                            <strong class="text-danger">{{ __('dashboard.stopped') }}</strong>
                        @endif
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">
                  Edit
                </a>

                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                  {{ __('dashboard.back') }}
                </a>
            </div>
        </div>


    </div>
</div>

@endsection
