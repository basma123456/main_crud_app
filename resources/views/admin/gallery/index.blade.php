@extends('admin.master')
@section('page_class' , 'gallery-pg')
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
                            <h4 class="header-title text-black">@lang('lang.admin.gallery')</h4>
                        </div>


                        <div class="table-main-btn mx-auto">
                            <a href="{{url(route('admin.posts.gallery_add' , ['module' => $post->module , 'post' => $post  ]))}}"
                               class="btn main-btn contact-us-btn fs-6" type="button">
                                @lang('lang.admin.add_photo')
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row g-3">

                            @foreach($post->gallery as $item)
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="gallery-item">
                                        <img
                                            src="{{asset($item->pic)}}"
                                            alt="Gallery 1"
                                            class="img-fluid rounded gallery-img">

                                        <div class="gallery-content text-center mt-2">
                                            <h6 class="gallery-title">{{$item->$name != 0 ? $item->$name : ''}}</h6>

                                            <div class="btn-group btn-group-sm">
                                                <a target="_blank" href="{{asset($item->pic)}}"
                                                   class="btn-fancy btn-view" data-bs-toggle="tooltip"
                                                   title="@lang('lang.admin.show_photo')">
                                                    <i class="ri-eye-line"></i>
                                                </a>

                                                <button class="btn-fancy btn-delete" data-bs-toggle="tooltip"
                                                        onclick="deletionPost('sweetalert-confirm-button{{$item->id}}',
                                                            '{{ route('admin.delete_image.gallery', $item) }}',
                                                            '{{__("lang.Are you sure?")}}',
                                                            '{{__("lang.deleting!")}}',
                                                            '{{__("lang.You wont be able to revert this!")}}',
                                                            '{{__('lang.Your file has been deleted.')}}')"
                                                        title="@lang('lang.admin.delete_photo')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function deletionPost(id, url, title1, title2, text1, text2) {
            Swal.fire({
                title: title1,
                text: text1,
                icon: "warning",
                showCancelButton: !0,
                customClass: {
                    confirmButton: "btn btn-primary me-2 mt-2",
                    cancelButton: "btn btn-danger mt-2"
                },
                confirmButtonText: "Yes, delete it!",
                buttonsStyling: !1,
                showCloseButton: !0
            })

                .then(function (result) {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: title2,
                            text: text2,
                            icon: "success",
                            customClass: {
                                confirmButton: "btn btn-primary mt-2"
                            },
                            buttonsStyling: false
                        }).then(function () {
                            window.location.href = url;
                        });
                    }

                });
        }
    </script>
@endsection
