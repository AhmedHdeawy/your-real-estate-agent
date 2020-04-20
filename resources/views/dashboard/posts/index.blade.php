@extends('dashboard.app')


@section('breadcrumb')
<li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
{{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
<li class="breadcrumb-item active">{{ __('dashboard.posts') }}</li>
@endsection

@section('content')

@include('dashboard.includes.status')


{{-- Search Section --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">

                <form action="{{ route('admin.posts.index') }}" method="get" class="form-inline">
{{--
                    <div class="form-group">
                        <input type="text" id="user" name="user" class="form-control" value="{{ old('user') }}"
                            placeholder="{{ __('dashboard.writer') }}">
                    </div>

                    <div class="form-group">
                        <input type="text" id="group" name="group" class="form-control" value="{{ old('group') }}"
                            placeholder="{{ __('dashboard.group') }}">
                    </div> --}}

                    <div class="form-group">
                        <input type="text" id="text" name="text" class="form-control" value="{{ old('text') }}"
                            placeholder="{{ __('dashboard.text') }}">
                    </div>


                    <div class="form-group">
                        <select id="status" name="status" class="form-control select-search" size="1">
                            <option value="">{{ __('dashboard.status') }}</option>
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>{{ __('dashboard.active') }}
                            </option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>{{ __('dashboard.stopped') }}
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-dot-circle-o"></i> {{ __('dashboard.search') }}
                        </button>
                    </div>

                    <div class="form-group">
                        <button type="button" class="btn btn-danger reset-form">
                            <i class="fa fa-ban"></i> {{ __('dashboard.reset') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> {{ __('dashboard.posts') }}

            </div>

            <div class="card-block">

                @if(!count($posts))
                <div class="row">
                    <h4 class="col-12 text-danger text-xs-center"> {{ __('dashboard.noData') }} </h4>
                </div>
                @else
                <table class="table table-bordered table-striped table-condensed">
                    {{-- Table Header --}}
                    <thead>
                        <tr>
                            <th class="text-sm-center">{{ __('dashboard.writer') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.group') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.text') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.status') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.actions') }}</th>
                            <th class="text-sm-center">{{ __('dashboard.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($posts as $post)
                        <tr class="text-sm-center">

                            <td> {{ $post->user->name }} </td>
                            <td> {{ $post->group->name }} </td>
                            <td> {{ str_limit($post->text, 50) }} </td>
                            <td>
                                @if($post->status == 1)
                                <strong class="text-success">{{ __('dashboard.active') }}</strong>
                                @else
                                <strong class="text-danger">{{ __('dashboard.stopped') }}</strong>
                                @endif
                            </td>
                            <td>
                                <form method="post" action="{{ route('admin.posts.update', $post->id) }}"
                                    class="d-inline-block">
                                    @csrf
                                    @method('PUT')
                                    @if ($post->status == 1)
                                    <input type="hidden" name="status" value="0">
                                    <button class="btn btn-danger btn-sm" type="submit">
                                        {{ __('dashboard.disable') }}
                                    </button>
                                    @else
                                    <input type="hidden" name="status" value="1">
                                    <button class="btn btn-success btn-sm" type="submit">
                                        {{ __('dashboard.enable') }}
                                    </button>

                                    @endif
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-primary btn-sm">
                                    <i class="icon-eye"></i>
                                </a>
                                <form method="post" action="{{ route('admin.posts.destroy', $post->id) }}"
                                    class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm delete-form" type="submit">
                                        <i class="icon-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $posts->appends(request()->query())->links() }}

                @endif

            </div>
        </div>
    </div>
    <!--/col-->
</div>


@endsection
