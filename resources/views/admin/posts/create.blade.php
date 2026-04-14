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

            <form action="{{ route('admin.posts.store' , [ 'module'=> $moduleRow->title  ]) }}" method="POST"
                  enctype="multipart/form-data">
                @csrf

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
                        <div class="flex-grow-1">
                                    <span
                                        class="header-title text-black">  إضافة جديد</span>
                        </div>


                        {{--                            <a href="{{ route('module', $data->module) }}"--}}
                        {{--                               class="btn btn-primary">{{ __('backend_lang/custom.show_all') }}</a>--}}


                    </div>
                    <div class="btn-group lang-btns mt-3 ms-3" role="group">
                        <button type="reset" class="btn main-btn ar-btn fw-bold active-lang-btn fs-6"
                                id="arabicBtn">عربي
                        </button>
                        <button type="button" class="btn main-btn en-btn fw-bold fs-6" id="englishBtn">English
                        </button>
                    </div>


                    <input type="text" name="module" value="{{$moduleRow->title}}" hidden>


                    {{--ar--}}
                    <div class="container p-4" id="arabicForm"
                         dir="rtl"
                         style="direction: rtl"
                         role="tabpanel"
                         aria-labelledby="ex1-tab-2">
                        <div class="row g-3">

                            <div class="col-12">
                                <label for="pename"
                                       class="form-label">{{ __('backend_lang/custom.title') }}</label>
                                <input type="text" name="parname_rtl" style="direction:rtl "
                                       class="form-control" value="{{old('parname_rtl')}}" id="inputPassword">
                            </div>


                            <!--------------------start text inputs ---------------------------->
                        @include('admin.components.posts.add.main_component' , ['moduleRow' => $moduleRow , 'case' => 'texts_arabic'])
                        <!--------------------end text inputs ---------------------------->


                            <!--------------------start textarea   ---------------------------->
                        @include('admin.components.posts.add.main_component' , ['moduleRow' => $moduleRow , 'case' => 'areas_arabic'])
                        <!--------------------end textarea ---------------------------->






                            @if ($moduleRow->have_short == 'yes')
                                @include('admin.components.posts.add.main_component' , ['moduleRow' => $moduleRow , 'case' => 'have_short_arabic'])
                            @endif



                            @if ($moduleRow->have_details == 'yes' )
                                @include('admin.components.posts.add.main_component' , ['moduleRow' => $moduleRow , 'case' => 'have_details_arabic'])
                            @endif


                            @if ($moduleRow->have_pic == 'yes')
                                @include('admin.components.posts.add.main_component' , ['moduleRow' => $moduleRow , 'case' => 'have_pic'])
                            @endif

                            <?php if($moduleRow->up > 0){
                            $nms = explode(',', $moduleRow->up_names);
                            for($ii = 0;$ii < $moduleRow->up;$ii++){
                            ?>


                            <div class="col-6 up">
                                <label class="form-label">
                                    @if ($nms[$ii] != 'date')
                                        {{ __('backend_lang/custom.' . $nms[$ii]) }}
                                    @else
                                        {{ __('backend_lang/custom.date') }}
                                    @endif
                                </label>
                                <input class="form-control" name="up{{ $ii }}"
                                       type="file"/>
                                <font class="hint">
                                    {{ __('backend_lang/custom.max_10') }}
                                </font>

                                @if ($nms[$ii] == 'PDF File')

                                    @if ($type == 'slider')
                                        <font class="hint">
                                            {{ __('backend_lang/custom.max_10') }}
                                            doc,docx,pdf,xlsx
                                        </font>
                                    @else
                                        <font class="hint">
                                            {{ __('backend_lang/custom.max_10') }} doc,docx,pdf
                                        </font>
                                    @endif
                                @elseif($nms[$ii] == 'background')
                                    <font class="hint"> {{ __('backend_lang/custom.max_2') }}
                                        Best Size 960*300
                                        jpg,jpeg,png,gif</font>

                                @endif
                            </div>
                            <?php }}?>



                            {{--                        </div>--}}


                        </div>
                    </div>
                    {{-- en --}}
                    <div class="container p-4  d-none" id="englishForm"
                         role="tabpanel"
                         dir="ltr"
                         style="direction: ltr"
                         aria-labelledby="ex1-tab-1">
                        <div class="row g-3">
                            <div class="col-md-12">

                                <label for="parname"
                                       class="form-label">{{ __('backend_lang/custom.title') }}</label>
                                <input type="text" name="parname"
                                       class="form-control"
                                       value="{{ old('parname' )}}"
                                       id="parname">
                            </div>


                        @if ($moduleRow->have_cats == 'yes')
                            @include('admin.components.posts.add.cats', ['cat' => $cat])
                        @endif




                        {{--                            @if (Request::segment(3) == 'news')--}}
                        {{--                                <div class="mb-3 row">--}}
                        {{--                                    <label for="pename"--}}
                        {{--                                           class="col-sm-2 col-form-label">{{ __('backend_lang/custom.date') }}</label>--}}
                        {{--                                    <div class="col-sm-3">--}}
                        {{--                                        <input type="date" name="news_date" class="form-control"--}}
                        {{--                                               value="" id="inputPassword">--}}
                        {{--                                    </div>--}}
                        {{--                                </div>--}}
                        {{--                            @endif--}}




                        <!---------------------------------start texts input part------------------>
                        @include('admin.components.posts.add.main_component' , ['moduleRow' => $moduleRow , 'case' => 'texts_english'])
                        <!---------------------------------end texts input part------------------>


                            <!---------------------------------start textarea part------------------>
                        @include('admin.components.posts.add.main_component' , ['moduleRow' => $moduleRow , 'case' => 'areas_english'])
                        <!---------------------------------end textarea part------------------>





                            @if ($moduleRow->have_short == 'yes')
                                @include('admin.components.posts.add.main_component' , ['moduleRow' => $moduleRow , 'case' => 'have_short_english'])
                            @endif


                            @if ($moduleRow->have_details == 'yes')
                                @include('admin.components.posts.add.main_component' , ['moduleRow' => $moduleRow , 'case' => 'have_details_english'])
                            @endif


                            @if ($moduleRow->have_more_fields == 'yes')
                                @include('admin.components.posts.add.main_component' , ['moduleRow' => $moduleRow , 'case' => 'more_fields' , 'fields' => $fields])
                            @endif


                        </div>
                    </div>


                </div>
                <div class="col-12  d-flex justify-content-end ">
                    <button type="submit"
                            class="btn btn-primary mt-10">{{ __('backend_lang/custom.save') }}
                    </button>
                </div>
            </form>

            <!---here -->


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

