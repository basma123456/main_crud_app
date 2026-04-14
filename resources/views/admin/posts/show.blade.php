@extends('admin.master')
@section('page_class' , 'add-pg')
@section('styles' )
    <!-- Quill css -->
    <link href="{{asset('admin/assets/vendor/quill/quill.core.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('admin/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet" type="text/css"/>

    <!----------------------select2------------------>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-------------------select2 --------------------->
@endsection

@section('content')
    <div class="page-container pt-3">

        <div class="row">

            <form action="{{route('admin.posts.update' , [ 'module'=> $data->moduleRelation->title ,'id' =>$id])}}"
                  method="POST" class="col-12"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                @endif


                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach

                <div class="card position-relative">
                    <div class="card-header border-bottom card-tabs d-flex flex-wrap align-items-center gap-2">


                        {{--                            <a href="{{ route('module', $data->module) }}"--}}
                        {{--                               class="btn btn-primary">{{ __('backend_lang/custom.show_all') }}</a>--}}


                        <div class="flex-grow-1">
                            {{--                                <h4 class="header-title text-black"></h4>--}}
                            @if($data->moduleRelation->have_add=='yes')
                                <a href="{{ route('admin.posts.create', $data->module ) }}"
                                   class="header-title text-black">تعديل / إضافة جديد</a>
                            @endif

                        </div>


                    </div>
                    <div class="btn-group lang-btns mt-3 ms-3" role="group">
                        <button type="reset" class="btn main-btn ar-btn fw-bold active-lang-btn fs-6"
                                id="arabicBtn">عربي
                        </button>
                        <button type="button" class="btn main-btn en-btn fw-bold fs-6" id="englishBtn">English
                        </button>
                    </div>


                    @foreach($data->postLangs   as $key => $postLang)


                        {{$key}}
                        @if($postLang->lang == 'ar')
                            {{-- AR --}}
                            <div class="container p-4" id="arabicForm"
                                 role="tabpanel"
                                 aria-labelledby="ex1-tab-2">

                                <div class="row g-3">

                                    {{-- //in arabic only--}}

                                    <div class="col-md-12">

                                        <label for="parname"
                                               class="form-label">{{ __('backend_lang/custom.title') }}</label>
                                        <input type="text" name="parname"
                                               style="direction: rtl !important"
                                               class="form-control"
                                               value="{{ $data->name_ar }}"
                                               id="parname">
                                    </div>


                                    <!-------------------------------start texts part ------------------------------------->
                                    <?php if ($data->moduleRelation->txts > 0) {
                                    $nms = explode(',', $data->moduleRelation->txts_names);
                                    for ($ii = 0; $ii < $data->moduleRelation->txts; $ii++){
                                    if ($ii == '0') {
                                        $v = $postLang->txt1;
                                    }
                                    if ($ii == '1') {
                                        $v = $postLang->txt2;
                                    }
                                    if ($ii == '2') {
                                        $v = $postLang->txt3;
                                    }
                                    if ($ii == '3') {
                                        $v = $postLang->txt4;
                                    }


                                    ?>
                                    <div class="col-md-6">
                                        <label class="form-label">
                                            @if ($nms[$ii] != 'add_date')
                                                {{ __('backend_lang/custom.' . $nms[$ii]) }}
                                            @else
                                                {{ __('backend_lang/custom.date') }}
                                            @endif

                                        </label>

                                        <?php if ($nms[$ii] != "add_date") { ?>

                                        <input type="text" style="direction:rtl;"
                                               name="txt_ar<?php echo $ii; ?>"

                                               class="form-control"
                                               value="<?php echo $v; ?> "/>
                                        <?php } elseif ($nms[$ii] == "Youtube Video Link") { ?>
                                        <input name="txt_ar0" type="text"
                                               class="form-control"
                                               style="text-align: left !important; direction: rtl"
                                               value="<?php echo $v; ?>"/>
                                        <?php } else { ?>
                                        <input name="txt_ar0" type="date" style="direction:rtl;"
                                               class="form-control"
                                               value="<?php echo $v; ?>"/>


                                        <?php } ?>
                                    </div>
                                    {{-- @endif --}}
                                    <?php }} ?>
                                    <!-------------------------------end texts part  ------------------------------------->







                                    <!-------------------------------start area part ------------------------------------->
                                    <?php

                                    if ($data->moduleRelation->areas > 0) {

                                    $nms = explode(',', $data->moduleRelation->areas_names);

                                    for ($ii = 0; $ii < $data->moduleRelation->areas; $ii++){

                                    $xx = $ii + 1;

                                    $are = 'areas_ar' . $xx;

                                    if ($ii == '0') {
                                        $v = $postLang->area1;
                                    }
                                    if ($ii == '1') {
                                        $v = $postLang->area2;
                                    }
                                    if ($ii == '2') {
                                        $v = $postLang->area3;
                                    }

                                    if ($ii == '3') {
                                        $v = $postLang->area4;
                                    }

                                    $area_name = 'area_ar' . $ii;

                                    ?>
                                    <div class="col-12">
                                        <label class="form-label">
                                            {{ __('backend_lang/custom.' . $nms[$ii]) }}

                                        </label>
                                        <?php if ($data->moduleRelation->title == 'equipment' || $data->moduleRelation->title == 'workshop') { ?>
                                        <div class="span10"><input value="<?php echo $v; ?>"
                                                                   type="text" name="<?php echo $area_name; ?>">
                                        </div>

                                        <?php } else { ?>


                                        <div class="card">
                                            <div class="card-body">
                                                <div class="editor_ar"
                                                     data-target="content_areas{{$v}}">{!! $v !!}</div>
                                            </div>
                                        </div>

{{--                                        <textarea hidden class="form-control" id="content_areas{{$v}}"--}}
{{--                                                  name="<?php echo $area_name; ?>" cols="20"--}}
{{--                                                  rows="2"><?php echo $v; ?></textarea>--}}

                                        <?php } ?>


                                    </div>
                                    <?php }} ?>
                                    <!-------------------------------end area part ------------------------------------->















                                    @if ($data->moduleRelation->have_short == 'yes')
                                        @include('admin.components.posts.show.have_short_ar' , ['postLang' => $postLang   ])
                                    @endif

                                    @if ($data->moduleRelation->have_details == 'yes' )
                                        @include('admin.components.posts.show.have_details_ar' , ['postLang' =>  $postLang  ])
                                    @endif


                                </div>

                            </div>
                        @elseif($postLang->lang == 'en')
                            {{-- EN --}}
                            <div class="container p-4  d-none" id="englishForm"
                                 role="tabpanel"
                                 aria-labelledby="ex1-tab-1">

                                <div class="row g-3">

                                    <div class="col-md-12">
                                        <label for="pename"
                                               class="form-label">{{ __('backend_lang/custom.title') }}</label>
                                        <input type="text" name="pename"
                                               class="form-control"
                                               value="{{ $postLang->name }}"
                                               id="inputPassword"
                                            {{$data->moduleRelation->name_Req == 'yes' ? 'required' : ''}}
                                        >
                                    </div>
                                    {{--                                        <style>--}}
                                    {{--                                            .hidden {--}}
                                    {{--                                                display: none;--}}
                                    {{--                                            }--}}

                                    {{--                                            .visible {--}}
                                    {{--                                                display: block;--}}
                                    {{--                                            }--}}
                                    {{--                                        </style>--}}




                                    @if ($data->moduleRelation->have_cats == 'yes')
                                        @include('admin.components.posts.show.cats', ['data' => $data])
                                    @endif




                                    {{--                                            //here--}}

                                    {{--                                    @if ($data->moduleRelation->title == 'News')--}}
                                    {{--                                            <div class="col-md-6">--}}
                                    {{--                                                <label for="news_date"--}}
                                    {{--                                                       class="form-label">{{ __('backend_lang/custom.date') }}</label>--}}
                                    {{--                                                    <input type="date"--}}
                                    {{--                                                           name="news_date"--}}
                                    {{--                                                           class="form-control"--}}
                                    {{--                                                           value="{{ $data->news_date }}"--}}
                                    {{--                                                           id="news_date">--}}
                                    {{--                                            </div>--}}
                                    {{--                                        @endif--}}



                                    <?php if ($data->moduleRelation->txts > 0) {
                                    $nms = explode(',', $data->moduleRelation->txts_names);
                                    for ($ii = 0; $ii < $data->moduleRelation->txts; $ii++){
                                    if ($ii == '0') {
                                        $v2 = $postLang->txt1;
                                    }
                                    if ($ii == '1') {
                                        $v2 = $postLang->txt2;
                                    }
                                    if ($ii == '2') {
                                        $v2 = $postLang->txt3;
                                    }
                                    if ($ii == '3') {
                                        $v2 = $postLang->txt4;
                                    }
                                    ?>
                                    {{-- @if (($moduleData->title == 'pages' && $data_en->post_id == 5) || $moduleData->title != 'pages') --}}

                                    {{--                                        <div class="col-md-12">--}}
                                    {{--                                            <label for="newsTitleAr" class="form-label">عنوان الخبر / المقال</label>--}}
                                    {{--                                            <input type="text" class="form-control" id="newsTitle" placeholder="أدخل العنوان بالإنجليزي">--}}
                                    {{--                                        </div>--}}

                                    <div class="col-md-6">
                                        <label class="form-label">
                                            @if ($nms[$ii] != 'add_date')
                                                {{ __('backend_lang/custom.' . $nms[$ii]) }}
                                            @else
                                                {{ __('backend_lang/custom.date') }}
                                            @endif
                                        </label>
                                        {{--                                            <div class="col-sm-10 " style="direction:rtl;">--}}
                                        <?php if ($nms[$ii] != "add_date") { ?>
                                        <input type="text" name="txt<?php echo $ii; ?>"
                                               class="form-control" value="<?php echo $v2; ?> "/>
                                        <?php } elseif ($nms[$ii] == "Youtube Video Link") { ?>
                                        <input name="txt0" type="text" class="form-control"
                                               style="text-align: left !important;"
                                               value="<?php echo $v2; ?>"/>
                                        <?php } else { ?>
                                        <input name="txt0" type="date" class="form-control"
                                               value="<?php echo $v2; ?>"/>

                                        <?php } ?>
                                        {{--                                            </div>--}}
                                    </div>
                                    {{-- @endif --}}
                                    <?php }} ?>
                                    <?php


                                    if ($data->moduleRelation->areas > 0) {

                                    $nms = explode(',', $data->moduleRelation->areas_names);

                                    for ($ii = 0; $ii < $data->moduleRelation->areas; $ii++){

                                    $xx = $ii + 1;

                                    $are = 'areas' . $xx;

                                    if ($ii == '0') {
                                        $v = $postLang->area1;
                                    }
                                    if ($ii == '1') {
                                        $v = $postLang->area2;
                                    }
                                    if ($ii == '2') {
                                        $v = $postLang->area3;
                                    }

                                    if ($ii == '3') {
                                        $v = $postLang->area4;
                                    }

                                    $area_name = 'area' . $ii;

                                    ?>





                                    {{--                                        <div class="col-12">--}}
                                    {{--                                            <label for="keywords" class="form-label">الكلمات المفتاحية</label>--}}
                                    {{--                                            <textarea id="keywords" class="form-control no-resize" rows="2" placeholder="أدخل الكلمات المفتاحية مفصولة بفواصل أو أسطر"></textarea>--}}
                                    {{--                                        </div>--}}

                                    <div class="col-12">
                                        <label class="form-label">
                                            {{ __('backend_lang/custom.' . $nms[$ii]) }}

                                        </label>
                                        <?php if ($data->moduleRelation->title == 'equipment' || $data->moduleRelation->title == 'workshop') { ?>

                                        <input class="form-control" value="<?php echo $v; ?>"
                                               type="text" name="<?php echo $area_name; ?>">

                                        <?php } else { ?>




                                        {{--                                            <div class="editor" data-target="content2"></div>--}}
                                        {{--                                            <textarea name="content2" id="content{{$v}}" hidden></textarea>--}}


                                        <div class="card">
                                            <div class="card-body">
                                                <div class="editor" data-target="details{{$v}}">{!! $v !!}</div>
                                            </div>
                                        </div>

                                        <textarea hidden class="form-control no-resize" id="details{{$v}}" hidden
                                                  name="<?php echo $area_name; ?>" cols="20"
                                                  rows="2"><?php echo $v; ?></textarea>


                                        <?php } ?>


                                    </div>

                                    <?php }} ?>



                                    @if ($data->moduleRelation->have_short == 'yes')
                                        @include('admin.components.posts.show.have_short' , ['postLang' => $postLang])
                                    @endif



                                    @if ($data->moduleRelation->have_details == 'yes')
                                        @include('admin.components.posts.show.have_details' , ['data' => $data  ,  'postLang' => $postLang])
                                    @endif



                                    @if ($data->moduleRelation->have_pic == 'yes')
                                        @include('admin.components.posts.show.have_pic' , ['data' => $data ])
                                    @endif
                                    {{--                                        @if ($data->moduleRelation->up > 0 and Request::segment(4) == 1)--}}


                                    @if ($data->moduleRelation->up > 0  )
                                        @include('admin.components.posts.show.up' , ['data' => $data ])
                                    @endif



                                    @if ($data->moduleRelation->have_more_fields == 'yes')
                                        @include('admin.components.posts.show.have_more_fields' , ['data' => $data ])
                                    @endif


                                </div>
                            </div>
                        @endif
                    @endforeach


                    {{--                                                            </div>--}}


                    {{--                        <div class="col-12  d-flex justify-content-end ">--}}
                    {{--                            --}}{{--                                        @if(hasPermission('edit',Request::segment(3)))--}}
                    {{--                            <button type="submit"--}}
                    {{--                                    class="btn btn-primary mt-10">{{ __('backend_lang/custom.update') }}--}}
                    {{--                            </button>--}}
                    {{--                            --}}{{--                                        @endif--}}
                    {{--                        </div>--}}
                     <div class="col-12 d-flex justify-content-end gap-2 flex-column flex-md-row">
                         <a href="{{route('admin.module.show' , ['title' => optional($data->moduleRelation)->title ])}}"   class="btn main-btn edit-btn fw-bold">رجوع</a>
                        {{--                            <button type="submit" class="btn main-btn save-btn fw-bold">نشر</button>--}}
                    </div>
                </div>
            </form>


        </div>

    </div>
@endsection
@section('scripts')
    <script src="{{asset('admin/js/add.js')}}"></script>
    <script src="{{asset('admin/assets/vendor/quill/quill.js')}}"></script>
    <script>
        /********************************quills editors**********************/
        var quills = [];
        var quillsar = [];
        document.addEventListener("DOMContentLoaded", function () {


            // Initialize all editors
            document.querySelectorAll('.editor').forEach((el) => {
                let quillEn = new Quill(el, {
                    theme: 'snow',
                    placeholder: "Write your article here..."
                    ,
                    modules: {
                        toolbar: [
                            [{header: [1, 2, 3, 4, 5, 6, false]}],
                            ["bold", "italic", "underline", "strike"],
                            [{color: []}, {background: []}],
                            [{list: "ordered"}, {list: "bullet"}],
                            [{align: []}],
                            ["blockquote", "code-block"],
                            ["link", "image", "video"],
                            ["clean"]
                        ]
                    }
                });

                quills.push({quillEn, el});
            });


            // Initialize all editors
            document.querySelectorAll('.editor_ar').forEach((el) => {
                let quillAr = new Quill(el, {
                    theme: 'snow',
                    placeholder: "اكتب محتوى المقال هنا..."

                    ,

                    modules: {
                        toolbar: [
                            [{header: [1, 2, 3, 4, 5, 6, false]}],
                            ["bold", "italic", "underline", "strike"],
                            [{color: []}, {background: []}],
                            [{list: "ordered"}, {list: "bullet"}],
                            [{align: []}],
                            ["blockquote", "code-block"],
                            ["link", "image", "video"],
                            ["clean"]
                        ]
                    }

                });

                quillsar.push({quillAr, el});
            });


            const editorArContent = document.querySelector(".editor_ar").querySelector(".ql-editor");
            editorArContent.setAttribute("dir", "rtl");
            editorArContent.style.textAlign = "right";

        });

        // Before submit → sync all editors
        document.querySelector('form').addEventListener('submit', function (e) {
            e.preventDefault(); // stop default submit

            quills.forEach(({quillEn, el}) => {
                const targetId = el.dataset.target;
                const field = document.getElementById(targetId);

                if (field && quillEn) {
                    field.value = quillEn.root.innerHTML;
                }
            });
            quillsar.forEach(({quillAr, el}) => {
                const targetId = el.dataset.target;
                const field = document.getElementById(targetId);

                if (field && quillAr) {
                    field.value = quillAr.root.innerHTML;
                }
            });

            this.submit(); // submit after setting values
        });
        /********************************quills editors**********************/


        $(".select2").select2({
            // minimumInputLength: 1
        });
    </script>
    <!-------------------end links   ------------->
@endsection

