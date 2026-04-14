@extends('admin.master')
@section('page_class' , 'add-to-gallery-pg')
@section('styles' )
    <!-- Sweet Alert css-->
    <link href="{{asset('admin/assets/vendor/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection


@section('content')
    <div class="page-container pt-3">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom card-tabs d-flex flex-wrap align-items-center gap-2">
                        <div class="flex-grow-1">
                            <h4 class="header-title text-black">أضف إلى معرض الصور</h4>
                        </div>
                    </div>
                    <div id="message" class="alert alert-success" style="display: none">{{__('photo_inserted_successfully')}}</div>
{{--                    {{$post->id}}--}}
                    <div class="container p-4">
                        <label for="fileInput"
                               class="add-input d-flex flex-column justify-content-center align-items-center shadow-lg rounded p-4 fw-bold text-dark text-center position-relative">

                            <svg viewBox="0 0 24 24" class="drag-drop-icon mb-1" width="48" height="48" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M7 10V9C7 6.23858 9.23858 4 12 4C14.7614 4 17 6.23858 17 9V10C19.2091 10 21 11.7909 21 14C21 15.4806 20.1956 16.8084 19 17.5M7 10C4.79086 10 3 11.7909 3 14C3 15.4806 3.8044 16.8084 5 17.5M7 10C7.43285 10 7.84965 10.0688 8.24006 10.1959M12 12V21M12 12L15 15M12 12L9 15"
                                        stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </svg>
                            اسحب الصور هنا أو اضغط لاختيار الملفات
                            <input type="file" id="fileInput" accept="image/*" multiple class="form-control d-none">
                        </label>

                        <div id="previewArea" class="d-flex flex-wrap gap-2 mb-4"></div>

                        <div class="d-flex justify-content-end gap-2 flex-column flex-md-row">
                            <button id="saveBtn" onclick="pressBtn()" class="btn main-btn save-btn fw-bold fs-6">حفظ
                                الصورة
                            </button>
                            <a href="{{url(route('admin.posts.gallery' , ['module' => $post->module , 'post' => $post  ]))}}"
                               class="btn main-btn go-to-gallery-btn fw-bold fs-6">معرض الصور</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




@section('scripts')
    <script src="{{asset('admin/js/add-to-gallery.js')}}"></script>
@endsection

