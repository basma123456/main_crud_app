<div class="sidenav-menu shadow-lg">

    <button class="button-sm-hover">
        <i class="ri-circle-line align-middle"></i>
    </button>


    <button class="button-close-fullsidebar">
        <i class="ri-close-line align-middle"></i>
    </button>
    <div data-simplebar class="sidebar-links">
        <a href="#" class="logo justify-content-center">
                    <span>
                        <span class="logo-lg"><img src="{{asset('admin/assets/images/imgs/logo-lg.webp')}}" alt="logo"></span>
                        <span class="logo-sm"><img src="{{asset('admin/assets/images/imgs/logo-sm.webp')}}"
                                                   alt="small logo"></span>
                    </span>
        </a>


        <ul class="side-nav gap-0">
            <li class="side-nav-title">@lang('lang.admin.main_list')</li>
            @php  $modules  = \App\Models\Module::get();  @endphp
            @foreach($modules as $mod)
            <li class="side-nav-item dropdown-sidebar-link py-1">
                <a data-bs-toggle="collapse" href="#{{$mod->title}}" aria-expanded="false" aria-controls="news"
                   class="side-nav-link fw-bold dropdown-menu-link">
                                <span class="menu-icon me-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                         stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 6h16v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6z"/>
                                        <path d="M8 10h8"/>
                                        <path d="M8 14h5"/>
                                    </svg>
                                </span>
                    <span class="menu-text">{{$mod->name_ar}}</span>
                    <span class="menu-arrow"></span>
                </a>
                    <div class="sidebar-links-dropdown position-relative collapse" id="{{$mod->title}}">
                        <ul class="sub-menu">
                            <li class="side-nav-item">
                                <a href="{{url(route('admin.module.show' , ['title' => $mod->title]))}}"
                                   class="side-nav-link active">
                                            <span class="sub-icon me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="none" stroke="black" stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <circle cx="8" cy="8" r="3"></circle>
                                                </svg>
                                            </span>
                                    <span class="menu-text">@lang('lang.admin.show_all')</span>
                                </a>
                            </li>
                            <li class="side-nav-item">

                                <a href="{{url(route('admin.module.show.param' , ['title' => $mod->title , 'status' => 'yes']))}}" class="side-nav-link">
                                            <span class="sub-icon me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="none" stroke="black" stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path d="M4 8h8"/>
                                                </svg>
                                            </span>
                                    <span class="menu-text">@lang('lang.admin.show_active')</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{url(route('admin.module.show.param' , ['title' => $mod->title , 'status' => 'no']))}}" class="side-nav-link">
                                            <span class="sub-icon me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="none"
                                                     stroke="black" stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path d="M4 8h8"/>
                                                    <path d="M3 3L13 13"/>
                                                </svg>
                                            </span>
                                    <span class="menu-text">@lang('lang.admin.show_deactive')</span>
                                </a>
                            </li>
                            <li class="side-nav-item">
                                <a href="{{url(route('admin.posts.create' , ['module' => $mod->title  ]))}}" class="side-nav-link">
                                            <span class="sub-icon me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="none" stroke="black" stroke-width="2" stroke-linecap="round"
                                                     stroke-linejoin="round">
                                                    <path d="M8 4v8M4 8h8"/>
                                                </svg>
                                            </span>
                                    <span class="menu-text">@lang('lang.admin.add_new')</span>
                                </a>
                            </li>
                        </ul>
                    </div>

            </li>
            @endforeach

{{--            <li class="side-nav-item py-1">--}}
{{--                <a href="gallery.html" aria-controls="gallery"--}}
{{--                   class="side-nav-link fw-bold">--}}
{{--                                <span class="menu-icon me-2">--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"--}}
{{--                                         stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                                        <rect x="3" y="5" width="18" height="14" rx="2" ry="2"></rect>--}}
{{--                                        <circle cx="12" cy="12" r="3"></circle>--}}
{{--                                        <path d="M3 5L6 2h12l3 3"></path>--}}
{{--                                    </svg>--}}
{{--                                </span>--}}
{{--                    <span class="menu-text">معرض الصور</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="side-nav-item py-1">--}}
{{--                <a href="contact-us.html" aria-controls="contact-us"--}}
{{--                   class="side-nav-link fw-bold">--}}
{{--                                <span class="menu-icon me-2">--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"--}}
{{--                                         stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                                        <rect x="3" y="5" width="18" height="14" rx="2" ry="2"></rect>--}}
{{--                                        <line x1="3" y1="5" x2="12" y2="12"></line>--}}
{{--                                        <line x1="21" y1="5" x2="12" y2="12"></line>--}}
{{--                                    </svg>--}}
{{--                                </span>--}}
{{--                    <span class="menu-text">تواصل معنا</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="side-nav-item py-1">--}}
{{--                <a href="settings.html" aria-controls="settings"--}}
{{--                   class="side-nav-link fw-bold">--}}
{{--                                <span class="menu-icon me-2">--}}
{{--                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"--}}
{{--                                         stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">--}}
{{--                                        <circle cx="12" cy="12" r="3"></circle>--}}
{{--                                        <path--}}
{{--                                            d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1.51-1 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path>--}}
{{--                                    </svg>--}}
{{--                                </span>--}}
{{--                    <span class="menu-text">الإعدادات</span>--}}
{{--                </a>--}}
{{--            </li>--}}

        </ul>

    </div>
</div>
