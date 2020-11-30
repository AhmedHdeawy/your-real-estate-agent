@extends('layouts.master')

@section('content')

<main class='ads'>
    <div class='container'>
        <h1> {{ __('lang.savedProperties') }} </h1>
        <div class='row'>
            <div class='col-xl-7 col-lg-8 col-md-10 mx-auto'>
                <div class='ad-con'>
                        @forelse ($favorites as $property)
                            <div class='row item-save mb-3 py-2'>
                                <div class='col-md-4 col-sm-4'>
                                    <img alt='{{ $property->title }}' class='img-thumbnail'
                                            src='{{ $property->images->first()->image_url }}'>
                                </div>
                                <div class='col-md-8 col-sm-8'>
                                    <div class='ad-data'>
                                        <a href="{{ route('property.showProperty', $property->id . '-' . make_slug($property->title)) }}">
                                            <h2 class='unit-name'> {{ $property->title }} </h2>
                                        </a>
                                        <p class='location'>
                                            <svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
                                                <path d='M0 0h24v24H0V0z' fill='none'/>
                                                <path
                                                        d='M12 2C8.13 2 5 5.13 5 9c0 4.17 4.42 9.92 6.24 12.11.4.48 1.13.48 1.53 0C14.58 18.92 19 13.17 19 9c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z'/>
                                            </svg>
                                            {{ $property->address }}
                                        </p>
                                        <p class='price'>
                                            {{ $property->price }} {{ __('lang.aed') }}
                                            @if ($property->period)

                                                /
                                                {{ $property->period->name }}
                                            @endif
                                        </p>
                                        <p class='price'>
                                        {{ $property->type->name }}
                                            <span class="mx-2">
                                                {{ $property->height }} {{ __('lang.squareMeter') }}
                                            </span>

                                        </p>
                                        <div class='btns-con'>
                                            <button data-id="{{ $property->id }}" class='btn text-danger deleteFromFavorites'>
                                                <svg height='24' id='delete-24px' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
                                                    <path d='M0,0H24V24H0Z' data-name='Path 1055' fill='none' id='Path_1055'/>
                                                    <path d='M16,9V19H8V9h8M14.5,3h-5l-1,1H5V6H19V4H15.5ZM18,7H6V19a2.006,2.006,0,0,0,2,2h8a2.006,2.006,0,0,0,2-2Z' data-name='Path 1056'
                                                            fill='#dc3545' id='Path_1056'/>
                                                </svg>
                                                حذف
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h3 class="text-center text-danger">
                                {{ __('lang.youHaveNotFavorites') }}
                            </h3>
                        @endforelse
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('script')

<script>

// When User clikc on Add to Favorites

    $('.deleteFromFavorites').click(function(e){
        e.preventDefault();

        var propertyID = $(this).data('id');

        Swal.fire({
            title: "{{ __('lang.areSure') }}",
            text: "{{ __('lang.deleteHint') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ __('lang.yes') }}",
            cancelButtonText: "{{ __('lang.no') }}",
            }).then((result) => {
                console.log(result.isConfirmed);
                if(result.value) {

                    // Call API to delete
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        type: "POST",
                        url: "{{ route('property.addToFavorites') }}",
                        data: {
                            property_id: propertyID
                        },
                        success: function (response) {
                            Swal.fire({
                                title: "{{ __('lang.titleSucess') }}",
                                text: "",
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false,
                            });
                            location.reload();
                        }
                    });
                }
            })

        return true;


    })


</script>

@endsection
