@extends('layouts.master')

@section('content')
<div class='container'>
    <section class='landing-page'>
        <!-- App Welcoming Section -->
        <section class='welcoming text-center'>
            <div class='row'>
                <div class='col-md-9 mx-auto'>
                    <h1> {{ __('lang.welcomeSectionTitle') }} </h1>
                    <div class='illustration'>
                        <img class='img-fluid' src='images/illustrations/welcoming-illustration.png'
                            alt='Welcoming Illustration'>
                    </div>
                </div>
            </div>
        </section>
        <!-- Statistics Section -->
        <section class='statistics text-center'>
            <div class='row'>
                <div class='col-md-9 mx-auto'>
                    <div class='row'>
                        <div class='col-md-4 col-6'>
                            <div class='statistic-box'>
                                <div class='statistic-content'>
                                    <div class='box-bg'></div>
                                    <div class='text'>
                                        <p> {{ __('lang.moreThan') }} </p>
                                        <p>
                                            <span class="text-white"> {{ countRows('App\User') }} </span>
                                            <span class="text-white">{{ __('lang.member') }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-4 col-6'>
                            <div class='statistic-box rotated'>
                                <div class='statistic-content'>
                                    <div class='box-bg'></div>
                                    <div class='text'>
                                        <p> {{ __('lang.moreThan') }} </p>
                                        <p>
                                            <span class="text-white"> {{ countRows('App\Models\Group') }} </span>
                                            <span class="text-white">{{ __('lang.circle') }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-4'>
                            <div class='statistic-box'>
                                <div class='statistic-content'>
                                    <div class='box-bg'></div>
                                    <div class='text'>
                                        <p> {{ __('lang.moreThan') }} </p>
                                        <p>
                                            <span class="text-white"> {{ countRows('App\Models\Post') }} </span>
                                            <span class="text-white">{{ __('lang.post') }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Steps -->
        <section class='steps text-center'>
            <h2> {{ __('lang.stepsSectionTitle') }} </h2>
            <div class='row'>
                <div class='col-lg-7 col-md-8 mx-auto'>
                    <div class='row'>
                        <div class='col-md-4 col-6'>
                            <h3> {{ __('lang.createNewAccount') }} </h3>
                            <div class='step-box'>
                                <div class='step-content'>
                                    <div class='img-con'>
                                        <img src='./images/illustrations/create.png' alt='Create New Account'
                                            class='img-fluid'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-4 col-6'>
                            <h3> {{ __('lang.findYourGroup') }} </h3>
                            <div class='step-box'>
                                <div class='step-content'>
                                    <div class='img-con'>
                                        <img src='./images/illustrations/search.png' alt='Search For Friends'
                                            class='img-fluid'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-4 col-6 mx-auto mx-md-0'>
                            <h3> {{ __('lang.joinToYourGroup') }} </h3>
                            <div class='step-box'>
                                <div class='step-content'>
                                    <div class='img-con'>
                                        <img src='./images/illustrations/celebrating.png'
                                            alt='celebrating Fining Your Friends' class='img-fluid'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='btn-con'>
                <a class='btn'> {{ __('lang.startWithUsNow') }} </a>
            </div>
        </section>
    </section>
</div>

@endsection
