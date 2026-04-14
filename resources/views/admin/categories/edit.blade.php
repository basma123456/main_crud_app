@extends('admin.master')
@section('page_class' , 'add-pg')
@section('styles' )
    <!----------------------select2------------------>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-------------------select2 --------------------->
@endsection

@section('content')
    <div class="page-container pt-3">

        <div class="row">

            <form action="{{ route('admin.cats.update' , [ 'module'=> $module , 'category' => $category ]) }}"
                  method="POST"
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


                    {{--ar--}}
                    <div class="container p-4" id="arabicForm"
                         dir="rtl"
                         style="direction: rtl"
                         role="tabpanel"
                         aria-labelledby="ex1-tab-2">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label for="pename"
                                       class="form-label">@lang('lang.admin.title')</label>
                                <input type="text" name="name_ar" style="direction:rtl "
                                       class="form-control" value="{{$category->name_ar}}" id="inputPassword">
                            </div>

                            @if(count($cats))
                                <div class="col-md-6">
                                    <label for="cat"
                                           class="form-label">@lang('lang.admin.sub_form')</label>
                                    <select name="main_cat"
                                            id="select"
                                            class="form-select select2">
                                        <option value="">
                                            @lang('lang.admin.select_category')
                                        </option>

                                        @foreach ($cats as $row)
                                            <option
                                                value="{{ $row->id }}"
                                                @if ( $row->id== $category->main_cat) selected @endif>
                                                {{$row->main_cat == 0 ?  $row->$name : "__". $row->$name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div
                                class="col-md-6">
                                <div class="row col-12  d-flex">
                                    <img src="{{asset($category->pic)}}" class="d-block   col-4" width="100"
                                         height="100">
                                    <input
                                        name="pic" class="d-block col-7 form-control "
                                        value=""
                                        type="file"/>
                                    <font>
                                        @lang('lang.admin.max_10')
                                    </font>
                                </div>
                            </div>


                        </div>
                    </div>
                    {{-- en --}}
                    <div class="container p-4  d-none" id="englishForm"
                         role="tabpanel"


                         aria-labelledby="ex1-tab-1">
                        <div class="row g-3">
                            <div class="col-md-6">

                                <label for="parname"
                                       class="form-label">@lang('lang.admin.title')</label>
                                <input type="text" name="name"
                                       class="form-control"
                                       value="{{$category->name}}"
                                       id="parname">
                            </div>


                        </div>
                    </div>


                </div>
                <div class="col-12  d-flex justify-content-end ">
                    <button type="submit"
                            class="btn btn-primary mt-10">@lang('lang.admin.save')
                    </button>
                </div>
            </form>

            <!---here -->


        </div>


    </div>
@endsection
@section('scripts')
    <script src="{{asset('admin/js/add.js')}}"></script>
    <script>


        $(".select2").select2({
            // minimumInputLength: 1
        });
    </script>
    <!-------------------end links   ------------->
@endsection

