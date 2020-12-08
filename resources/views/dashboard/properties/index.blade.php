@extends('dashboard.app')


@section('breadcrumb')
<li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
{{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
<li class="breadcrumb-item active">{{ __('dashboard.properties') }}</li>
@endsection

@section('content')

@include('dashboard.includes.status')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> {{ __('dashboard.properties') }}
            </div>

            <div class="card-block">

                @if(count($properties) < 1)
                    <div class="row">
                        <h4 class="col-12 text-danger text-xs-center"> {{ __('dashboard.noData') }} </h4>
                    </div>
                @else

            <table class="table table-bordered table-striped table-condensed">
                {{-- Table Header --}}
                <thead>
                    <tr>
                        <th class="text-sm-center">{{ __('dashboard.agent_name') }}</th>
                        <th class="text-sm-center">{{ __('dashboard.agent_phone') }}</th>
                        <th class="text-sm-center">{{ __('dashboard.title') }}</th>
                        <th class="text-sm-center">{{ __('dashboard.price') }}</th>
                        <th class="text-sm-center">{{ __('dashboard.status') }}</th>
                        <th class="text-sm-center">{{ __('dashboard.actions') }}</th>
                    </tr>
                </thead>
                @foreach($properties as $property)
                <tbody>
                    <tr class="text-sm-center">

                        <td> {{ $property->agent_name }} </td>
                        <td>
                            {{ $property->agent_phone }}
                        </td>

                        <td class="text-sm-center"> {{ $property->address  }} </td>
                        <td>
                            {{ $property->price }}
                        </td>

                        <td>
                            @if($property->status == '0')
                            <span class="tag tag-danger">{{ __('dashboard.stopped') }}</span>
                            @else
                            <span class="tag tag-success">{{ __('dashboard.active') }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.properties.show', [$property->property_id, 'showLang'  => $property->locale ] ) }}"
                                class="btn btn-primary btn-sm">
                                <i class="icon-eye"></i>
                            </a>
                            <form method="post" action="{{ route('admin.properties.destroy', $property->property_id) }}" class="d-inline-block">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm delete-form" type="submit">
                                    <i class="icon-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>

                @endforeach
            </table>

            {{ $properties->links() }}
            @endif

        </div>
    </div>
</div>
<!--/col-->
</div>


@endsection
