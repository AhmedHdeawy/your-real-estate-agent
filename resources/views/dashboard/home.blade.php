@extends('dashboard.app')

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('dashboard.home') }}</li>
    {{-- <li class="breadcrumb-item"><a href="#">المستخدم</a></li> --}}
    <li class="breadcrumb-item active">{{ __('dashboard.dashboard') }}</li>
@endsection

@section('content')

<h1 class="m-b-3">
	{{ __('dashboard.websiteStatistics') }}
</h1>

<div class="row dashboard-statistic">

	<div class="col-xs-6 col-lg-3">
        <a href="{{ route('admin.users.index') }}">
	        <div class="card">
	            <div class="card-block p-a-1 clearfix">
	                <i class="icon-people bg-primary p-a-1 font-2xl m-r-1 {{ $currentLangDir == 'rtl' ? 'pull-right' : 'pull-left' }} "></i>
	                <div class="h5 text-primary m-b-0 m-t-h">
	                	{{ countRows('App\User') }}
	                </div>
	                <div class="text-muted text-uppercase font-weight-bold font-xs">{{ __('dashboard.users') }}</div>
	            </div>
	        </div>
        </a>
    </div>

    <div class="col-xs-6 col-lg-3">
        <a href="{{ route('admin.groups.index') }}">
            <div class="card">
                <div class="card-block p-a-1 clearfix">
                    <i
                        class="icon-people bg-success p-a-1 font-2xl m-r-1 {{ $currentLangDir == 'rtl' ? 'pull-right' : 'pull-left' }} "></i>
                    <div class="h5 text-primary m-b-0 m-t-h">
                        {{ countRows('App\Models\Group') }}
                    </div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs">{{ __('dashboard.groups') }}</div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-xs-6 col-lg-3">
        <a href="{{ route('admin.posts.index') }}">
            <div class="card">
                <div class="card-block p-a-1 clearfix">
                    <i
                        class="icon-people bg-warning p-a-1 font-2xl m-r-1 {{ $currentLangDir == 'rtl' ? 'pull-right' : 'pull-left' }} "></i>
                    <div class="h5 text-primary m-b-0 m-t-h">
                        {{ countRows('App\Models\Post') }}
                    </div>
                    <div class="text-muted text-uppercase font-weight-bold font-xs">{{ __('dashboard.posts') }}</div>
                </div>
            </div>
        </a>
    </div>


</div>

@endsection
