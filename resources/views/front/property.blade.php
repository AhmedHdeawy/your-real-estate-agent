<div class='unit'>
    <span class='tag'> {{ $property->category->name }} </span>
    <div class='owl-carousel unit-images-carousel owl-theme'>

        @foreach ($property->images as $image)
                <div class='item'>
                    <div class='image-con'>
                        <img alt='{{ $property->title }}'
                        class='img-fluid' src='{{ $image->image_url }}'>
                    </div>
                </div>
        @endforeach

    </div>
    <p class='location'>
        <svg viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'>
            <path d='M0 0h24v24H0V0z' fill='none'/>
            <path
                    d='M12 2C8.13 2 5 5.13 5 9c0 4.17 4.42 9.92 6.24 12.11.4.48 1.13.48 1.53 0C14.58 18.92 19 13.17 19 9c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z'/>
        </svg>
        {{ $property->address }}
    </p>
    <h6 class='unit-name'> {{ $property->title }} </h6>
    <div class='unit-data'>
        <p>
            <span> {{ __('lang.type') }} : </span>
            {{ $property->type->name }}
        </p>
        <p>
            <span> {{ __('lang.price') }} : </span>
            {{ $property->price }}
        </p>
        <p>
            <span> {{ __('lang.area') }} </span>
             {{ $property->height }} * {{ $property->width }}
        </p>
        <p>
            <span> {{ __('lang.no_of_rooms') }} </span>
             {{ $property->no_of_rooms }}
        </p>
    </div>
    <div class='btns-con'>
        <div class='row'>
            <div class='col-auto mx-auto'>
                <a class='btn visit' href="{{ route('property.showProperty', $property->id) }}">
                    <svg height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'>
                        <path d='M0 0h24v24H0V0z' fill='none'/>
                        <path
                                d='M12 4C7 4 2.73 7.11 1 11.5 2.73 15.89 7 19 12 19s9.27-3.11 11-7.5C21.27 7.11 17 4 12 4zm0 12.5c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z'/>
                    </svg>
                    {{ __('lang.details') }}
                </a>
            </div>

        </div>
    </div>

</div>
