<section class='banner' role='banner'>
    <div class='container h-100'>
        <div class='row h-100'>
            <div class='col-xl-9 col-lg-10 col-12 m-auto'>
                <div class='search-con'>
                    <h2> {{ __('lang.searchForYourProperty') }} </h2>
                    <form id="search" method="GET" action="{{ route('search') }}">
                        <div class='row'>
                            <div class='col-md-3 col-6'>
                                <div class='form-group'>
                                    <select class='form-control' name='category'>
                                        @foreach ($categories as $category)
                                            <option {{ request('category') == $category->id ? 'selected' : '' }}
                                                value='{{ $category->id}}'> {{ $category->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class='col-md-3 col-6'>
                                <div class='form-group'>
                                <input class='form-control' name='text' value="{{ request('text') ?? null }}" placeholder='{{ __('lang.searchPropertyText') }}' type='text'>
                                </div>
                            </div>
                            <div class='col-md-3 col-6'>
                                <div class='form-group'>
                                    <select class='form-control' name='type'>
                                        <option value="">{{ __('lang.type') }}</option>
                                        @foreach ($types as $type)
                                            <option {{ request('type') == $type->id ? 'selected' : '' }}
                                                value='{{ $type->id}}'> {{ $type->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class='col-md-3 col-6'>
                                <div class='form-group'>
                                    <select class='form-control' name='completing'>
                                        <option value="">{{ __('lang.property_status') }}</option>
                                        @foreach ($completings as $completing)
                                            <option {{ request('completing') == $completing->id ? 'selected' : '' }}
                                                value='{{ $completing->id}}'> {{ $completing->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class='col-md-3 col-6'>
                                <div class='form-group'>
                                    <select class='form-control' name='period'>
                                        <option value="">{{ __('lang.period') }}</option>
                                        @foreach ($periods as $period)
                                            <option {{ request('period') == $period->id ? 'selected' : '' }}
                                                value='{{ $period->id}}'> {{ $period->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class='col-md-3 col-12'>
                                <div class='row'>
                                    <div class='col-6'>
                                        <div class='form-group'>
                                        <input class='form-control' min="1" value="{{ request('min_price') ?? null }}" name="min_price" placeholder='{{ __('lang.min_price') }}' type='number'>
                                        </div>
                                    </div>
                                    <div class='col-6'>
                                        <div class='form-group'>
                                            <input class='form-control' min="1" value="{{ request('max_price') ?? null }}" name="max_price" placeholder='{{ __('lang.max_price') }}' type='number'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-3 col-12'>
                                <div class='row'>
                                    <div class='col-12'>
                                        <div class='form-group'>
                                        <input class='form-control' min="1" value="{{ request('no_of_rooms') ?? null }}" name='no_of_rooms' placeholder='{{ __('lang.no_of_rooms') }}' title='min bedrooms' type='number'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-3 col-12'>
                                <div class='row'>
                                    <div class='col-6'>
                                        <div class='form-group'>
                                            <input class='form-control' min="1" value="{{ request('max_area') ?? null }}" name='max_area' placeholder='{{ __('lang.max_area') }}' title='min bedrooms' type='number'>
                                        </div>
                                    </div>
                                    <div class='col-6'>
                                        <div class='form-group'>
                                            <input class='form-control' min="1" value="{{ request('min_area') ?? null }}" name='min_area' placeholder='{{ __('lang.min_area') }}' title='min bedrooms' type='number'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class='col-md-3 col-6'>
                                <div class='form-group'>
                                    <select class='form-control' name='furnishing'>
                                        <option value="">{{ __('lang.furnishings') }}</option>
                                        @foreach ($furnishings as $furnishing)
                                            <option {{ request('furnishing') == $furnishing->id ? 'selected' : '' }}
                                                value='{{ $furnishing->id}}'> {{ $furnishing->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}

                            <div class='col-md-9 col-12'>
                                <div class='form-group select2_search'>
                                    <select class='form-control select2' multiple name='amenities[]' placeholder="{{ __('lang.amenities') }}">
                                        @foreach ($amenities as $amenitie)
                                            <option {{ !is_null(request('amenities')) && in_array($amenitie->id, request('amenities'))  ? 'selected' : '' }}
                                                value='{{ $amenitie->id}}'> {{ $amenitie->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class='col-md-3 col-12'>
                                <button class='btn'>
                                    {{ __('lang.search') }}
                                    <svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
                                        <path d='M0 0h24v24H0V0z' fill='none'/>
                                        <path
                                                d='M15.5 14h-.79l-.28-.27c1.2-1.4 1.82-3.31 1.48-5.34-.47-2.78-2.79-5-5.59-5.34-4.23-.52-7.79 3.04-7.27 7.27.34 2.8 2.56 5.12 5.34 5.59 2.03.34 3.94-.28 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0 .41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/>
                                    </svg>
                                </button>
                            </div>
                            <div class='col-12'>
                                <p class="float-{{ $currentLangDir == 'rtl' ? 'left' : 'right' }} reset-search-form"> {{ __('lang.reset') }} </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
