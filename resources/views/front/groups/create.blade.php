@extends('layouts.master')

@section('content')

<section class='create-group-page'>
    <div class='row'>

        <div class='col-lg-6 col-md-10 mx-auto'>
            <h2> {{ __('lang.createGroup') }} </h2>
            <form action="{{ route('groups.store') }}" method="post">
                @csrf
                <div class='form-group'>
                    <input class='form-control is-invalid'
                        placeholder='{{ __('lang.groupName') }}' title='{{ __('lang.groupName') }}'
                        name='name' type='text' value="{{ old('name') }}">
                    @if ($errors->first('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>

                <div class='form-group'>
                    <textarea class='form-control is-invalid' placeholder='{{ __('lang.groupDescription') }}'
                        title='{{ __('lang.groupDescription') }}' name="description">{{ old('description') }}</textarea>
                    @if ($errors->first('description'))
                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                    @endif
                </div>

                <h5 class="text-primary mt-4">{{ __('lang.groupJoinsQuestions') }}</h5>

                <div class='form-group questions-container'>
                    <section class="tr">
                        <textarea class='form-control first is-invalid mt-3' placeholder='{{ __('lang.questionTitle') }}'
                            title='{{ __('lang.questionTitle') }}' name="questions[]"></textarea>

                            <textarea class='form-control is-invalid mt-3' placeholder='{{ __('lang.questionTitle') }}'
                                title='{{ __('lang.questionTitle') }}' name="questions[]"></textarea>
                    </section>
                    @if ($errors->first('questions'))
                    <div class="invalid-feedback">{{ $errors->first('questions') }}</div>
                    @endif
                    <button type="button" class='mt-2 btn btn-create-question'>
                        <i class="fa fa-plus-circle text-white"></i>
                    </button>
                </div>
                <button type="submit" class='btn mt-5'> {{ __('lang.createTheGroup') }} </button>
            </form>
        </div>
    </div>
</section>

@endsection
