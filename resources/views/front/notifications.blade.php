@extends('layouts.master')

@section('content')


<section class='profile-page'>
    <div class='row'>
        <div class='col-12 col-md-8 mx-auto'>
            <div class='notifications'>

                @include('dashboard.includes.status')

                @if ($notifications->isNotEmpty())

                    <div class='notifications-head text-center'>
                        <i class='fas fa-bell'></i>
                        <span> {{ __('lang.notifications') }} </span>

                    </div>
                    <ul class='notifications-body mt-4'>
                        @foreach ($notifications as $notify)

                            {{-- Request Status Accept/Denied --}}
                            @if ($notify->type == 'App\Notifications\RequestJoinStatus')
                                @if ($notify->data['status'] == 'accept')
                                    <li class="clearfix alert alert-success">
                                        <a href="{{ route('groups.show', ['group_permlink'  => $notify->data['group_unique_name']]) }}"
                                            class="float-right">
                                            <p class="d-inline font-weight-normal">
                                                {{ __('lang.requestJoiningAccepted', ['group' => $notify->data['group_name']])}}
                                            </p>
                                        </a>
                                        <span class="float-left">{{ $notify->created_at->diffForHumans() }}</span>
                                    </li>
                                @else
                                    <li class='clearfix alert alert-danger'>
                                        <p class="d-inline mb-0 float-right font-weight-normal">
                                            {{ __('lang.requestJoiningRejected', [ 'group' => $notify->data['group_name']])}}
                                        </p>
                                        <span class="float-left">{{ $notify->created_at->diffForHumans() }}</span>
                                    </li>
                                @endif
                            @endif

                            {{-- New Message --}}
                            @if ($notify->type == 'App\Notifications\NewMessage')
                                <li class='clearfix alert alert-secondary'>
                                    <a href="{{ route('messenger.index') }}" class="float-right">
                                        <p class="d-inline font-weight-normal">
                                            {{ __('lang.youHaveNewMessage', ['user' => $notify->data['user_name']])}}
                                        </p>
                                    </a>
                                    <span class="float-left">{{ $notify->created_at->diffForHumans() }}</span>
                                </li>
                            @endif

                            {{-- User Request to Join --}}
                            @if ($notify->type == 'App\Notifications\UserRequestJoin')
                                @include('front.groups.requestsJoining', ['notify'  =>  $notify])
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
