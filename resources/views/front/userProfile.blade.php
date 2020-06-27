@extends('layouts.master')

@section('content')

{{-- Profile Data  / Start --}}

<div class="container contact-us mb-5 mt-5 px-1 px-md-5">
    <div class="row justify-content-center align-items-center">

        <div class="col-12 col-md-10">

            <div class="card border-rbzgo rounded-0">
                <div class="card-header p-0">
                    <div class="bg-rbzgo text-white text-center py-2">
                        <h3>{{ $user->name }} </h3>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

{{-- Profile Data  / End --}}


@endsection
