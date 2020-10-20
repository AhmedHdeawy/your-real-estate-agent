@extends('dashboard.app')

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
  <li class="breadcrumb-item"><a href="{{ route('admin.completings.index') }}"> {{ __('dashboard.completings') }} </a></li>
  <li class="breadcrumb-item active">{{ __('dashboard.edit') }}</li>
@endsection

@section('content')

  @include('dashboard.includes.status')

  <form action="{{ route('admin.completings.update', $completing->id) }}" method="post" class="form-horizontal " enccompleting="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="card">
      <div class="card-header">
          {{ __('dashboard.data') }}
      </div>
      <div class="card-block">
          @csrf
          @include('dashboard.completings.form')
      </div>
      <div class="card-footer">
          <button completing="submit" class="btn btn-sm btn-primary">
            <i class="fa fa-dot-circle-o"></i> {{ __('dashboard.update') }}
          </button>
          <button completing="button" class="btn btn-sm btn-danger reset-form"><i class="fa fa-ban"></i>
            {{ __('dashboard.resetInputs') }}
          </button>
      </div>
    </div>

  </form>


@endsection

