@extends('admin.master')
@section('page_class' , 'list-pg')

@section('styles' )
    {{--    <!-- Quill css -->--}}
    {{--    <link href="{{asset('admin/assets/vendor/quill/quill.core.css')}}" rel="stylesheet" type="text/css"/>--}}
    {{--    <link href="{{asset('admin/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet" type="text/css"/>--}}
    {{--    <link href="{{asset('admin/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet" type="text/css"/>--}}

    {{--    <!----------------------select2------------------>--}}
    {{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>--}}
    {{--    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}
    {{--    <!-------------------select2 --------------------->--}}

    <!-- Sweet Alert css-->
    <link href="{{asset('admin/assets/vendor/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>

    {{--<!-- Vendor css -->--}}
    {{--<link href="{{asset('admin/assets/css/vendor.min.css')}}" rel="stylesheet" type="text/css" />--}}

    {{--<!-- App css -->--}}
    {{--<link href="{{asset('admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />--}}

    {{--<!-- Icons css -->--}}
    {{--<link href="{{asset('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />--}}

    {{--<!-- Theme Config Js -->--}}
    {{--<script src="{{asset('admin/assets/js/config.js')}}"></script>--}}

@endsection

@section('content')
    <div class="page-container pt-3">


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom card-tabs d-flex flex-wrap align-items-center gap-2">
                        <div class="flex-grow-1">
                            <h4 class="header-title text-black">أخبارنا</h4>
                        </div>

                    </div>

                    <div class="card-breadcrumb px-3 py-2 shadow-sm">
                        <div class="d-flex align-items-center flex-wrap flex-lg-nowrap gap-2">

                            <div class="stats flex-grow-1 d-flex align-items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor"
                                     class="docs-nums bi bi-list-ul" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                          d="M5 12.5a.5.5 0 0 1 0-1h9a.5.5 0 0 1 0 1H5zm0-4a.5.5 0 0 1 0-1h9a.5.5 0 0 1 0 1H5zm0-4a.5.5 0 0 1 0-1h9a.5.5 0 0 1 0 1H5z"/>
                                    <circle cx="1.5" cy="4.5" r=".5"/>
                                    <circle cx="1.5" cy="8.5" r=".5"/>
                                    <circle cx="1.5" cy="12.5" r=".5"/>
                                </svg>
                                <h4 class="mb-0">عدد السجلات: <span
                                        class="fw-bold">{{$posts ? count($posts) : 0}}</span></h4>
                            </div>

                            <div class="d-flex align-items-center gap-2 flex-column flex-md-row">

                                <form
                                    class="submenu-search position-relative d-flex justify-content-center align-items-center gap-2 overflow-hidden cursor-pointer">

                                    <input
                                        type="text"
                                        placeholder="بحث"
                                        class="search-input bg-transparent py-1 fs-6"
                                    />
                                    <button
                                        class="search-icon position-absolute d-flex justify-content-center align-items-center border-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                             fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                        </svg>
                                    </button>
                                </form>

                                <div class="table-dropdown">
                                    <button class="btn main-btn dropdown-toggle fs-6" type="button"
                                            id="newsDropdown" data-bs-toggle="dropdown">
                                        التحكم
                                        <i class="ri-arrow-down-s-line"></i>
                                    </button>

                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item fs-6"
                                               href="{{route('admin.module.show' , ['title' => $module->title  ])}}">عرض
                                                الكل</a></li>
                                        <li><a class="dropdown-item fs-6"
                                               href="{{route('admin.posts.create' , $module->title)}}">إضافة
                                                جديد</a></li>


                                        <li><a class="dropdown-item fs-6"
                                               href="{{route('admin.module.show.param' , ['title' => $module->title , 'status' => 'yes'])}}">عرض
                                                المفعل</a></li>
                                        <li><a class="dropdown-item fs-6"
                                               href="{{route('admin.module.show.param' , ['title' => $module->title , 'status' => 'no'])}}">عرض
                                                غير المفعل</a></li>
                                    </ul>
                                </div>

                            </div>

                        </div>
                    </div>

                    @if($posts)
                        <div class="table-responsive">
                            <table class="table table-hover table-striped-columns mb-0 align-middle mx-auto">
                                <thead class="bg-light-subtle">
                                <tr>
                                    {{--                                        <th class="ps-3">--}}
                                    {{--                                            <input type="checkbox"--}}
                                    {{--                                                   class="list-pg-check-select-all form-check-input row-select">--}}
                                    {{--                                        </th>--}}
                                    {{--                                        <th class="fs-12 text-uppercase text-muted text-center">الصورة</th>--}}
                                    {{--                                        <th class="fs-12 text-uppercase text-muted text-center">العنوان (إنجليزي)</th>--}}
                                    {{--                                        <th class="fs-12 text-uppercase text-muted text-center">العنوان (عربي)</th>--}}
                                    {{--                                        <th class="fs-12 text-uppercase text-muted text-center">الإجراءات</th>--}}


                                    <th class="ps-3">
                                        <input type="checkbox"
                                               class="list-pg-check-select-all form-check-input row-select">
                                    </th>

                                    <th scope="col" width="3%">
                                        {{ __('backend_lang/custom.state') }}
                                    </th> <!-- added code -->

                                    @if ($title != 'videos' && $module->have_pic == 'yes')
                                        <th scope="col">{{ __('backend_lang/custom.pic') }}</th>
                                    @endif

                                    <th scope="col">{{ __('backend_lang/custom.title') }}</th>
                                    <th scope="col">{{ __('backend_lang/custom.title') }} AR</th>

                                    @if ($title == 'news')
                                        <th scope="col">{{ __('backend_lang/custom.date') }}</th>
                                    @endif

                                    @if ($module->have_cats == 'yes')
                                        <th scope="col">{{ __('backend_lang/custom.category') }}</th>
                                    @endif
                                    {{-- <th scope="col">{{ __('backend_lang/custom.title') }} AR</th> --}}

                                    <th scope="col">{{ __('backend_lang/custom.controls') }}</th>

                                </tr>
                                </thead>
                                <tbody>


                                @foreach($posts as $key => $post)

                                    <tr class="{{$post->active == 'no' ? 'pinkBg' : ''}}">
                                        <td class="ps-3">
                                            <input type="checkbox"
                                                   class="list-pg-check form-check-input row-select">

                                            <p class="bg-success">id : {{$post->id}}</p><br>
                                            {{$post->p_order}} <br>

                                        </td>
                                        <td class="ps-3">
                                            @if ($post->active == 'yes' )
                                                <i class="ri-circle-fill" style="color: #8aff77;"></i>
                                            @else
                                                <i class="ri-circle-fill" style="color: #ff7171;"></i>
                                            @endif
                                        </td>

                                        @if ($title != 'videos' && $module->have_pic == 'yes')
                                            <td class="text-center item-img">
                                                <img
                                                    {{--                                                    src="https://cdn.al-ain.com/lg/images/2021/3/16/127-213415-palestine-home-cultural-gaza-2.jpeg"--}}
                                                    src="{{asset($post->image())}}"
                                                    alt="News 3" class="img-fluid rounded">
                                            </td>
                                        @endif


                                        <td class="text-center">{{$post->name_en}}
                                        </td>
                                        <td class="text-center">{{$post->name_ar}}
                                        </td>


                                        @if ($title == 'news')
                                            <td>
                                                <h5 class="fw-500 my-0">{{optional($post->postLangsCurrent)->txt1}}</h5>
                                            </td>
                                        @endif

                                        @if ($module->have_cats == 'yes')
                                            <td>
                                                <h5 class="fw-500 my-0">

                                                    @if ($post->category)
                                                        @if($post->category->main_cat == 0)
                                                            {{(optional($post->category)->$name)}}
                                                        @else
                                                            __{{  optional($post->category)->$name }}
                                                        @endif
                                                        {{--                                                            @if ($cat->main_cat == 0)--}}
                                                        {{--                                                                @if (app()->getLocale() == 'en')--}}
                                                        {{--                                                                    {{ $cat->name }}--}}
                                                        {{--                                                                @else--}}
                                                        {{--                                                                    {{ $cat->name_ar }}--}}
                                                        {{--                                                                @endif--}}
                                                        {{--                                                            @else--}}
                                                        {{--                                                                @if (app()->getLocale() == 'en')--}}
                                                        {{--                                                                    __{{ $cat->name }}--}}
                                                        {{--                                                                @else--}}
                                                        {{--                                                                    __{{ $cat->name_ar }}--}}
                                                        {{--                                                                @endif--}}
                                                        {{--                                                            @endif--}}
                                                    @else
                                                        -
                                                    @endif

                                                </h5>
                                            </td>
                                        @endif


                                        <td class="text-center pe-3">
                                            <div class="btn-group-fancy second-choice" role="group">
                                                {{--                                                    @if ($post->have_edit == 'yes' and hasPermission('edit',$post->module) )--}}





                                                @if ($post->moduleRelation->have_edit == 'yes'  )
                                                    <a href="{{ route('admin.posts.edit', ['module' => $post->module, 'id' => $post->id]) }}"
                                                       class="btn-fancy btn-edit"
                                                       data-bs-toggle="tooltip"
                                                       title="تعديل الخبر">
                                                        <i class="ri-edit-box-line"></i>
                                                    </a>
                                                @endif


                                                {{--                                                        <a href="{{ route('post', ['module' => $post->module, 'id' => $post->id]) }}"--}}
                                                {{--                                                           title="{{ __('backend_lang/custom.edit') }}">--}}
                                                {{--                                                            <div class="icon-bg">--}}
                                                {{--                                                                <i class="fa-solid fa-pen-to-square"></i>--}}
                                                {{--                                                            </div>--}}
                                                {{--                                                        </a>--}}


                                                @if($post->active == 'yes')
                                                    <a href="{{url(route('admin.change_status.post' , ['post' => $post ]))}}"
                                                       class="btn-fancy btn-gallery "
                                                       data-bs-toggle="tooltip" title="deactivate">
                                                        <i class="ri-pause-fill"></i>
                                                    </a>
                                                @else
                                                    <a href="{{url(route('admin.change_status.post' , ['post' => $post ]))}}"
                                                       class="btn-fancy btn-gallery"
                                                       data-bs-toggle="tooltip" title="activate">
                                                        <i class="ri-play-fill"></i>
                                                    </a>
                                                @endif


                                                <a href="{{ route('admin.posts.show', ['module' => $post->module, 'id' => $post->id]) }}"
                                                   class="btn-fancy btn-view" data-bs-toggle="tooltip"
                                                   title="عرض الخبر">
                                                    <i class="ri-eye-line"></i>
                                                </a>
                                                <a href="{{url(route('admin.posts.gallery' , ['post' => $post , 'module' => $post->module]))}}"
                                                   class="btn-fancy btn-gallery"
                                                   data-bs-toggle="tooltip" title="معرض الصور">
                                                    <i class="ri-image-line"></i>
                                                </a>
                                                {{--                                                <button class="btn-fancy btn-delete" data-bs-toggle="tooltip"--}}
                                                {{--                                                        title="حذف الخبر">--}}
                                                {{--                                                    <i class="ri-delete-bin-line"></i>--}}
                                                {{--                                                </button>--}}

                                                <button type="button" id="sweetalert-confirm-button{{$post->id}}"
                                                        onclick="deletionPost('sweetalert-confirm-button{{$post->id}}',
                                                            '{{ route('admin.delete_post.post', $post) }}',
                                                            '{{__("lang.Are you sure?")}}',
                                                            '{{__("lang.deleting!")}}',
                                                            '{{__("lang.You wont be able to revert this!")}}',
                                                            '{{__('lang.Your file has been deleted.')}}')"
                                                        title="حذف الخبر" class="btn-fancy btn-delete"
                                                        data-bs-toggle="tooltip"><i class="ri-delete-bin-line"></i>
                                                </button>

                                                @if($key > 0)
                                                    <a class="btn-fancy btn-up" data-bs-toggle="tooltip"
                                                       onclick="changeOrder('{{url(route('admin.posts.order' , ['module'=> $post->moduleRelation->title , 'direction'=>'+' , $post->id ]))}}')"
                                                       title="نقل الخبر للأعلى">
                                                        <i class="ri-arrow-up-line"></i>
                                                    </a>
                                                @endif
                                                <a class="btn-fancy btn-down"
                                                   onclick="changeOrder('{{url(route('admin.posts.order' , ['module'=> $post->moduleRelation->title , 'direction'=>'-' , $post->id ]))}}')"
                                                   data-bs-toggle="tooltip"
                                                   title="نقل الخبر للأسفل">
                                                    <i class="ri-arrow-down-line"></i>
                                                </a>
                                                <a href="{{route('admin.post_first_order.post' , $post)}}"
                                                   class="btn-fancy btn-first" data-bs-toggle="tooltip"
                                                   title="نقل الخبر للأول">
                                                    <i class="ri-arrow-up-s-line"></i>
                                                </a>
                                                <button class="btn-fancy btn-last" data-bs-toggle="tooltip"
                                                        title="نقل الخبر للأخير">
                                                    <i class="ri-arrow-down-s-line"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        {{ $posts->links()  }}


                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped-columns mb-0 align-middle mx-auto">
                                <thead class="bg-light-subtle">
                                <tr>
                                    <th class="ps-3">
                                        <input type="checkbox" disabled
                                               class="list-pg-check-select-all form-check-input row-select">
                                    </th>
                                    <th class="fs-12 text-uppercase text-muted text-center">الصورة</th>
                                    <th class="fs-12 text-uppercase text-muted text-center">العنوان (إنجليزي)</th>
                                    <th class="fs-12 text-uppercase text-muted text-center">العنوان (عربي)</th>
                                    <th class="fs-12 text-uppercase text-muted text-center">الإجراءات</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="ps-3 text-center" colspan="5">
                                        {{('lang_admin.not_found')}}
                                    </td>
                                </tr>

                                </tbody>

                            </table>
                        </div>

                    @endif


                </div>
            </div>

        </div>

    </div>

@endsection

@section('scripts')
    <script>
        function changeOrder(url) {
            window.location.href = url;
        }
    </script>
    <script src="{{asset('admin/js/list.js')}}"></script>

@endsection
