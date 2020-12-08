@extends('dashboard.app')


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
    <li class="breadcrumb-item"><a href="{{ route('admin.properties.index') }}">{{ __('dashboard.properties') }}</a></li>
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
                        {{ $property->translate($showLang)->title }}
                    </div>
                </div>


                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.address') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $property->address }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.agent') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $property->agent_name }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.agent_phone') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $property->agent_phone }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.agent_email') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $property->agent_email }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.no_of_rooms') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $property->no_of_rooms }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.no_of_bathrooms') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $property->no_of_bathrooms }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.area') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $property->height }} {{ __('lang.squareMeter') }}
                        /
                        {{ $property->width }} {{ __('lang.squareMeter') }}
                    </div>
                </div>


                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.desc') }} :
                    </div>
                    <div class="col-sm-10">
                        {!! $property->description !!}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.category') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $property->category->name ?? '--' }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.type') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $property->type->name ?? '--' }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.period') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $property->period->name ?? '--' }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.furnishing') }} :
                    </div>
                    <div class="col-sm-10">
                        {{ $property->furnishing->name ?? '--' }}
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.amenities') }} :
                    </div>
                    <div class="col-sm-10">
                        @foreach ($property->amenities as $item)
                            {{ $item->name }}
                            @if (!$loop->last)
                                 <b>-</b>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.status') }} :
                    </div>
                    <div class="col-sm-10">
                        @if($property->status == 1)
                            <strong class="text-success">{{ __('dashboard.'.$showLang.'.active') }}</strong>
                        @else
                            <strong class="text-danger">{{ __('dashboard.'.$showLang.'.stopped') }}</strong>
                        @endif
                    </div>
                </div>

                <div class="row show-details-row">
                    <div class="col-sm-2">
                        {{ __('dashboard.image') }} :
                    </div>
                    <div class="col-sm-10">
                        @foreach ($property->images as $image)
                            <img src="{{ $image->image_url }}" class="img-thumbnail mx-2 my-4" style="width: 200px !important; height: 200px !important;">
                        @endforeach
                    </div>
                </div>


            </div>
            <div class="card-footer">
                <a href="{{ route('admin.properties.index') }}" class="btn btn-secondary">
                  {{ __('dashboard.back') }}
                </a>
            </div>
        </div>


	</div>
</div>

@endsection
