<!-------------------start navbar ------------->
<header class="app-topbar shadow-lg">
    <div class="page-container topbar-menu">
        <div class="d-flex align-items-center gap-2">

            <button class="sidenav-toggle-button px-2">
                <i class="ri-menu-5-line fs-24"></i>
            </button>

            <button class="topnav-toggle-button px-2" data-bs-toggle="collapse"
                    data-bs-target="#topnav-menu-content">
                <i class="ri-menu-5-line fs-24"></i>
            </button>

            <div>
                <h2 class="logo-title d-none d-md-flex flex-column align-items-start mb-0 gap-0.5">
                    <span>مسابقات الرماية السنوية</span>
                    <span>Annual Shooting Competitions</span>
                </h2>
            </div>

        </div>

        <div class="d-flex align-items-center gap-2">

            <div class="topbar-item nav-user">
                <div class="dropdown">
                    <a class="topbar-link dropdown-toggle drop-arrow-none px-2" data-bs-toggle="dropdown"
                       data-bs-offset="0,25" type="button" aria-haspopup="false" aria-expanded="false">
                        <img src="assets/images/imgs/profile-avatar.png" width="28"
                             class="rounded-circle me-lg-2 d-flex"
                             alt="user-image">
                        <span class="d-lg-flex flex-column gap-1 d-none mt-1">
                                        <h5 class="my-0 fs-5">Smart Vision</h5>
                                    </span>
                        <i class="header-user-arrow ri-arrow-down-s-line d-none d-lg-block align-middle ms-2 mt-1"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a href="#" class="dropdown-item">
                            <i class="ri-settings-2-line me-1 fs-6 align-middle"></i>
                            <span class="align-middle fs-6">@lang('lang.admin.settings')</span>
                        </a>

                        <a href="#" class="dropdown-item d-flex align-items-center gap-1">
                            <i class="ri-global-line fs-6"></i>
                            {{--                            <span class="fs-6">English</span>--}}
                        <!--------languages----------------->
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                                <a rel="alternate" hreflang="{{ $localeCode }}" class="{{app()->getLocale() == 'ar' && $localeCode == 'ar' ? 'd-none' : '' }} {{app()->getLocale() == 'en' && $localeCode == 'en' ? 'd-none' : '' }}"
                                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>

                        @endforeach
                        <!--------languages----------------->

                        </a>

                        <a href="#" class="dropdown-item active fw-semibold text-danger">
                            <i class="ri-logout-box-line me-1 fs-6 align-middle"></i>
                            <span class="align-middle fs-6">@lang('lang.admin.log_out')</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>
<!-------------------end navbar ------------->
