@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('lang.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">{{ __('lang.roles') }}</a></li>
      <li class="breadcrumb-item active">{{ __('lang.show') }}</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        
        <div class="card">
            <div class="card-block">

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.name') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $role->name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.phone') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $role->phone }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.email') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $role->email }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.image') }} :
                    </div>
                    <div class="col-sm-10">
                        <img src="{{ asset('uploads/roles/'.$role->avatar) }}" class="img-fluid img-thumbnail" width="300px">
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('lang.status') }} :
                    </div>
                    <div class="col-sm-10">
                        @if($role->status == 1)
                            <strong class="text-success">{{ __('lang.active') }}</strong>
                        @else
                            <strong class="text-danger">{{ __('lang.stopped') }}</strong>
                        @endif
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-warning">
                  Edit
                </a>

                <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                  {{ __('lang.back') }}
                </a>
            </div>
        </div>


    </div>
</div>

@endsection
