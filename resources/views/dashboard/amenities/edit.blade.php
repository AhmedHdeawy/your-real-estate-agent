@extends('dashboard.app')

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
  <li class="breadcrumb-item"><a href="{{ route('admin.amenities.index') }}"> {{ __('dashboard.amenities') }} </a></li>
  <li class="breadcrumb-item active">{{ __('dashboard.edit') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')
  <form action="{{ route('admin.amenities.update', $amenity->id) }}" method="post" class="form-horizontal " encamenitie="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="card">
      <div class="card-header">
          {{ __('dashboard.data') }}
      </div>
      <div class="card-block">
          @csrf
          @include('dashboard.amenities.form')
      </div>
      <div class="card-footer">
          <button amenitie="submit" class="btn btn-sm btn-primary">
            <i class="fa fa-dot-circle-o"></i> {{ __('dashboard.update') }}
          </button>
          <button amenitie="button" class="btn btn-sm btn-danger reset-form"><i class="fa fa-ban"></i>
            {{ __('dashboard.resetInputs') }}
          </button>
      </div>
    </div>

  </form>


@endsection

