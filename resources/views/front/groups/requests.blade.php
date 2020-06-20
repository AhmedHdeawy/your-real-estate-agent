@extends('layouts.master')

@section('content')


<section class='profile-page'>
    <div class='row'>
        <div class='col-lg-6 col-md-10 mx-auto'>
            <div class='notifications'>
                <div class='notifications-head text-center'>
                    <a href='#'>
                        <i class='fas fa-bell'></i>
                        <span>الإشعارات</span>
                    </a>
                </div>
                <ul class='notifications-body'>
                    <li class='clearfix'>
                        <a href='#'>
                            <i class='fas fa-user-circle'></i>
                            <span>محمد حسن | طلب الانضمام الي مجوعه</span>
                        </a>
                        <div class='btns'>
                            <button class='btn'>
                                <i class='fas fa-check-circle'></i>
                            </button>
                            <button class='btn'>
                                <i class='fas fa-times-circle'></i>
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>


@endsection
