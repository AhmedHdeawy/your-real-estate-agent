@extends('layouts.master')

@section('content')


<section class='profile-page'>
    <div class='row'>
        <div class='col-md-10 mx-auto'>
            <div class='notifications'>

                @include('dashboard.includes.status')

                @if ($groupsRequest->isNotEmpty())

                    <div class='notifications-head text-center'>
                        <i class='fas fa-bell'></i>
                        <span> {{ __('lang.requestJoining') }} </span>

                    </div>
                    <ul class='notifications-body mt-4'>

                        @foreach ($groupsRequest as $item)

                        <li class='clearfix'>

                            <div class="row">
                                <div class="col-12 col-md-10">
                                    @if ($item->user->avatar)
                                        <img src="{{ asset('uploads/users/' . $item->user->avatar) }}"
                                            class="img-avatar {{ $currentLangDir == 'rtl' ? 'float-right' : 'float-left' }}">
                                    @else
                                        <avatar
                                            class="img-avatar d-inline-block {{ $currentLangDir == 'rtl' ? 'float-right' : 'float-left' }}"
                                            :username="{{ json_encode($item->user->nameForAvatar()) }}" background-color="#7F78B4"
                                            color="#FFF">
                                        </avatar>
                                    @endif
                                    <span class="d-inline mx-3">
                                        {{ __('lang.userRequestJoinToGroup', [
                                                'user'  =>  $item->user->name,
                                                'group' => $item->group->name
                                            ]) }}
                                    </span>
                                </div>
                                <div class="col-12 col-md-2">

                                    <div class='btns'>
                                        <button class='btn btn-rbzgo' data-target="#reviewAnswers_{{ $item->id }}" data-toggle="modal">
                                            {{ __('lang.reviewAnswers') }}
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="reviewAnswers_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="reviewAnswers_{{ $item->id }}Label"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ __('lang.reviewAnswers') }}
                                                        </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            @foreach ($item->userAnswers as $answer)

                                                            <div class="col-12">
                                                                <div class="alert alert-secondary" role="alert">

                                                                    <h6 class="color-rbzgo">{{ $answer->title }}</h6>
                                                                    <div>
                                                                        <i class="fas fa-arrow-circle-left"></i>
                                                                        <span class="text-success mx-3">{{ $answer->answer }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('handelJoinRequests') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{ $item->user->id }}">
                                                            <input type="hidden" name="group_id" value="{{ $item->group->id }}">
                                                            <input type="hidden" name="status" value="accept">
                                                            <button type="submit" class="btn btn-success">
                                                                <span class="text-white">{{ __('lang.accept') }}</span>
                                                            </button>
                                                        </form>

                                                        <form action="{{ route('handelJoinRequests') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{ $item->user->id }}">
                                                            <input type="hidden" name="group_id" value="{{ $item->group->id }}">
                                                            <input type="hidden" name="status" value="denied">
                                                            <button type="submit" class="btn btn-danger">
                                                                <span class="text-white">{{ __('lang.denied') }}</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </li>
                        @endforeach
                    </ul>

                @else
                    <p class="text-center"> {{ __('lang.youHaveNoRequestJoining') }} </p>
                @endif
            </div>
        </div>
    </div>
</section>


@endsection
