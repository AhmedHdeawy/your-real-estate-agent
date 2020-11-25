@extends('layouts.master')

@section('content')

<main class='terms'>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-8 col-md-10 mx-auto'>
                <div class='row'>
                    <div class='col-md-1 col-sm-2'>
                        <svg viewBox='0 0 112 128' xmlns='http://www.w3.org/2000/svg'>
                            <g id='shield-with-lock' opacity='0.3' transform='translate(-31.992 0)'>
                                <path d='M232,160a8.01,8.01,0,0,0-8,8v8h16v-8A8.01,8.01,0,0,0,232,160Z' fill='purple' id='Path_1040' transform='translate(-144.01 -119.996)'/>
                                <path
                                        d='M139.449.787a8,8,0,0,0-8.473.981c-10,8.035-27.987,8.031-37.967,0a8,8,0,0,0-10.031,0C72.987,9.8,54.987,9.8,45.011,1.771A8,8,0,0,0,32,8l0,64c0,25.074,20.1,45.889,53.767,55.682a8.047,8.047,0,0,0,4.469,0c33.667-9.793,53.764-30.6,53.764-55.682V8A8,8,0,0,0,139.449.787ZM111.993,80a8,8,0,0,1-8,8h-32a8,8,0,0,1-8-8V64a8,8,0,0,1,8-8V48a16,16,0,1,1,32,0v8a8,8,0,0,1,8,8Z'
                                        fill='purple'
                                        id='Path_1041' transform='translate(0 0)'/>
                                <path d='M244,272a4,4,0,1,0,4,4A4,4,0,0,0,244,272Z' fill='purple' id='Path_1042' transform='translate(-156.01 -203.996)'/>
                            </g>
                        </svg>
                    </div>
                    @if (getInfoByKey('privacyPolicy'))
                        <div class='col-md-11 col-sm-10'>
                            <h1> {{ __('lang.privacyPolicy') }} </h1>
                            <p>
                                {!! getInfoByKey('privacyPolicy')->infos_desc !!}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
