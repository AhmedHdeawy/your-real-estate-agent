@extends('layouts.master')

@section('content')


<section class='profile-page'>
    <div class='row'>
        <div class='col-md-6 mx-auto'>
            <div class='notifications'>

                @include('dashboard.includes.status')

                @if ($notifications->isNotEmpty())

                    <div class='notifications-head text-center'>
                        <i class='fas fa-bell'></i>
                        <span> {{ __('lang.notifications') }} </span>

                    </div>
                    <ul class='notifications-body text-center mt-4'>
                        @foreach ($notifications as $notify)

                            @if ($notify->type == 'App\Notifications\RequestJoinStatus')
                                @if ($notify->data['status'] == 'accept')
                                    <a href="{{ route('groups.show', ['group_permlink'  => $notify->data['group_unique_name']]) }}"
                                        class='clearfix alert alert-success'>
                                        <h5 class="d-inline mx-3 font-weight-normal">
                                            {{ __('lang.requestJoiningAccepted', ['group' => $notify->data['group_name']])}}
                                        </h5>
                                    </a>
                                @else
                                    <li class='clearfix alert alert-danger'>
                                        <h5 class="d-inline mx-3 font-weight-normal">
                                            {{ __('lang.requestJoiningRejected', [ 'group' => $notify->data['group_name']])}}
                                        </h5>
                                    </li>
                                @endif
                            @endif

                            @if ($notify->type == 'App\Notifications\NewMessage')
                                <a href="{{ route('messenger.index') }}" class='clearfix alert alert-info'>
                                    <h5 class="d-inline mx-3 font-weight-normal">
                                        {{ __('lang.youHaveNewMessage', ['user' => $notify->data['user_name']])}}
                                    </h5>
                                </a>
                            @endif

                        @endforeach
                    </ul>

                @else
                    <h4 class="text-center"> {{ __('lang.youHaveNoNotifications') }} </h4>
                @endif
            </div>
        </div>
    </div>
</section>


@endsection
