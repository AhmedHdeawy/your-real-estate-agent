@extends('dashboard.app')


@section('breadcrumb')
<li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
{{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
<li class="breadcrumb-item active">{{ __('dashboard.furnishings') }}</li>
@endsection

@section('content')

@include('dashboard.includes.status')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> {{ __('dashboard.furnishings') }}

                <a href="{{ route('admin.furnishings.create') }}" class="btn btn-success btn-create {{ $currentLangDir == 'rtl' ? 'pull-left' : 'pull-right' }}">
                    <i class="icon-plus"></i> {{ __('dashboard.create') }}
                </a>
            </div>

            <div class="card-block">

                @if(count($furnishings) < 1) <div class="row">
                    <h4 class="col-12 text-danger text-xs-center"> {{ __('dashboard.noData') }} </h4>
            </div>
            @else

            <table class="table table-bordered table-striped table-condensed">
                {{-- Table Header --}}
                <thead>
                    <tr>
                        <th class="text-sm-center">{{ __('dashboard.lang') }}</th>
                        <th class="text-sm-center">{{ __('dashboard.id') }}</th>
                        <th class="text-sm-center">{{ __('dashboard.name') }}</th>
                        <th class="text-sm-center">{{ __('dashboard.status') }}</th>
                        <th class="text-sm-center">{{ __('dashboard.show') }}</th>
                        <th class="text-sm-center">{{ __('dashboard.actions') }}</th>
                    </tr>
                </thead>

                @foreach($furnishings as $furnishing)

                <tbody>
                    @foreach($furnishing->translations as $furnishingTranslation)

                    <tr class="text-sm-center">

                        <td> {{ $furnishingTranslation->locale }} </td>
                        <td>
                            @if($loop->first)
                            {{ $furnishing->id }}
                            @endif
                        </td>

                        <td class="text-sm-center"> {{ $furnishingTranslation->name  }} </td>

                        <td>
                            @if($loop->first)
                            @if($furnishing->status == '0')
                            <span class="tag tag-danger">{{ __('dashboard.stopped') }}</span>
                            @else
                            <span class="tag tag-success">{{ __('dashboard.active') }}</span>
                            @endif

                            @endif
                        </td>


                        <td>

                            <a href="{{ route('admin.furnishings.show', [$furnishing->id, 'showLang'  => $furnishingTranslation->locale ] ) }}"
                                class="btn btn-primary btn-sm">
                                <i class="icon-eye"></i>
                            </a>

                        </td>
                        <td>

                            @if($loop->first)
                            <a href="{{ route('admin.furnishings.edit', $furnishing->id) }}" class="btn btn-warning btn-sm">
                                <i class="icon-pencil"></i>
                            </a>
                            <form method="post" action="{{ route('admin.furnishings.destroy', $furnishing->id) }}" class="d-inline-block">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm delete-form" furnishing="submit">
                                    <i class="icon-trash"></i>
                                </button>
                            </form>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>

                @endforeach
            </table>

            {{ $furnishings->links() }}
            @endif

        </div>
    </div>
</div>
<!--/col-->
</div>


@endsection
