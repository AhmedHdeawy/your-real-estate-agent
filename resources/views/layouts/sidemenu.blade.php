<!-- Start Side Menu -->
<section class='side-menu' id='sideMenu' dir='rtl'>
    <div class='side-menu-con' style='opacity: 1;'>
        <div class='close-menu'>
            <button class='btn'>
                <i class='fas fa-times'></i>
                اغلاق القائمة
            </button>
        </div>
        <div class='logo'>
            <a href="/">
                <img src='{{ asset('images/gotogather-logo.png') }}' alt='Go To Gather Logo' class='img-fluid'>
            </a>
            <h4 class='welcoming-head'></h4>
        </div>
        <ul class='sections'>

            @auth
                <li class='section-con'>
                    <a href='#'>
                        <i class='fas fa-user-circle'></i>
                        <span> {{ auth()->user()->name }} </span>
                    </a>
                </li>
                <li class='section-con'>
                    <a href='{{ route('groups.create') }}'>
                        <i class='fas fa-plus-circle'></i>
                        <span> {{ __('lang.createGroup') }} </span>
                    </a>
                </li>
                <li class='section-con'>
                    <a href='#'>
                        <i class='fas fa-users'></i>
                        <span>المجموعات</span>
                    </a>
                </li>
                <li class='section-con'>
                    <a href='#'>
                        <i class='fas fa-comment-alt'></i>
                        <span>الرسائل</span>
                    </a>
                </li>
                <li class='section-con'>
                    <a href='#'>
                        <i class='fas fa-bell'></i>
                        <span>الإشعارات</span>
                    </a>
                </li>

                <li class='section-con'>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class='nav-link p-0 bg-transparent' type="submit">
                            <i class="fas fa-sign-out-alt text-white"></i>
                            <span> {{ __('lang.logout') }} </span>
                        </button>
                    </form>
                </li>

            @else
                <li class='section-con'>
                    <a href='#'>تسجيل الدخول</a>
                </li>
                <li class='section-con'>
                    <a href='#'>تسجيل مستخدم جديد</a>
                </li>
            @endauth
            <li class='section-con'>
                <a href='#'>مركز المساعدة</a>
            </li>
            <li class='section-con'>
                <a href='#'>الشروط والأحكام</a>
            </li>
            <li class='section-con'>
                <a href='#'>سياسة الخصوصية</a>
            </li>
        </ul>
        <div class='side-menu-footer'>
            عند قيامك بإنشاء حساب فانك توافق على
            <a href='#'>الشروط والأحكام</a>
            و
            <a href='#'>سياسه الخصوصية</a>
            الخاصة بنا
        </div>
    </div>
</section>
<!-- End Side Menu -->
