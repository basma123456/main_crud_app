<!---------------->

<!DOCTYPE html>
<html lang="ar" dir="rtl">
@include('admin.layouts.links')
@yield('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<body>
<div class="wrapper">
    @php
        if(app()->getLocale() == 'ar'){
            $site_name =  'site_name_ar';
            $name = 'name_ar';

        }else{
            $site_name =  'site_name';
            $name = 'name';
        }
    @endphp


    @include('admin.layouts.sidebar' , ['name' => $name , 'site_name' => $site_name])
    @include('admin.layouts.navbar', ['name' => $name , 'site_name' => $site_name])
    <div class="page-content @yield('page_class' , 'add-pg')">
        @yield('content')
        @if(session('success') || session('msg') || session('error'))
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    let message = "{{ session('success') ?? session('msg') ?? session('error') }}";
                    let type = "{{ session('error') ? 'error' : 'success' }}";

                    Swal.fire({
                        icon: type,
                        title: message,
                        timer: 2000,
                        timerProgressBar: true,
                        showCloseButton: true,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                });
            </script>
        @endif


    <!----------------part of alerts ---------->
        <div class="d-none">
            <div class="col-lg-6">
                <div class="card">
                    <div
                        class="card-header border-bottom border-dashed d-flex align-items-center">
                        <h4 class="header-title">A Basic Message</h4>
                    </div>

                    <div class="card-body">
                        <p class="text-muted">Here's a basic example of
                            SweetAlert.</p>
                        <button type="button" class="btn btn-primary"
                                id="sweetalert-basic">Click me
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div
                        class="card-header border-bottom border-dashed d-flex align-items-center">
                        <h4 class="header-title">Title</h4>
                    </div>

                    <div class="card-body">
                        <p class="text-muted">A Title with a Text Under.</p>
                        <button type="button" class="btn btn-primary"
                                id="sweetalert-title">Click Me
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div
                        class="card-header border-bottom border-dashed d-flex align-items-center">
                        <h4 class="header-title">HTML</h4>
                    </div>

                    <div class="card-body">
                        <p class="text-muted">Here's an example of SweetAlert
                            with HTML content.</p>
                        <button type="button" class="btn btn-primary"
                                id="custom-html-alert">Toggle HTML SweetAlert
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div
                        class="card-header border-bottom border-dashed d-flex align-items-center">
                        <h4 class="header-title">All States</h4>
                    </div>

                    <div class="card-body">
                        <p class="text-muted">Here are examples for each of
                            SweetAlert's states.</p>

                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" id="sweetalert-info"
                                    class="btn btn-info">Toggle Info
                            </button>
                            <button type="button" id="sweetalert-warning"
                                    class="btn btn-warning">Toggle Warning
                            </button>
                            <button type="button" id="sweetalert-error"
                                    class="btn btn-danger">Toggle Error
                            </button>
                            <button type="button" id="sweetalert-success"
                                    class="btn btn-success">Toggle Success
                            </button>
                            <button type="button" id="sweetalert-question"
                                    class="btn btn-primary">Toggle Question
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div
                        class="card-header border-bottom border-dashed d-flex align-items-center">
                        <h4 class="header-title">Long Content</h4>
                    </div>

                    <div class="card-body">
                        <p class="text-muted">A modal window with a long content
                            inside.</p>

                        <button type="button" id="sweetalert-longcontent"
                                class="btn btn-secondary">Click Me
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div
                        class="card-header border-bottom border-dashed d-flex align-items-center">
                        <h4 class="header-title">With Confirm Button</h4>
                    </div>

                    <div class="card-body">
                        <p class="text-muted">A warning message, with a function
                            attached to the "Confirm"-button...</p>

                        <button type="button" id="sweetalert-confirm-button"
                                class="btn btn-secondary">Click Me
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div
                        class="card-header border-bottom border-dashed d-flex align-items-center">
                        <h4 class="header-title">With Cancel Button</h4>
                    </div>

                    <div class="card-body">
                        <p class="text-muted">By passing a parameter, you can
                            execute something else for "Cancel".</p>

                        <button type="button" id="sweetalert-params"
                                class="btn btn-secondary">Click Me
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div
                        class="card-header border-bottom border-dashed d-flex align-items-center">
                        <h4 class="header-title">With Image Header (Logo)</h4>
                    </div>

                    <div class="card-body">
                        <p class="text-muted">A message with custom Image
                            Header.</p>

                        <button type="button" id="sweetalert-image"
                                class="btn btn-secondary">Click Me
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div
                        class="card-header border-bottom border-dashed d-flex align-items-center">
                        <h4 class="header-title">Position</h4>
                    </div>

                    <div class="card-body">
                        <p class="text-muted">A custom positioned dialog.</p>

                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-primary"
                                    id="position-top-start">Top Start
                            </button>
                            <button class="btn btn-primary"
                                    id="position-top-end">Top End
                            </button>
                            <button class="btn btn-primary"
                                    id="position-bottom-start">Bottom Starts
                            </button>
                            <button class="btn btn-primary"
                                    id="position-bottom-end">Bottom End
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div
                        class="card-header border-bottom border-dashed d-flex align-items-center">
                        <h4 class="header-title">With Custom Padding,
                            Background</h4>
                    </div>

                    <div class="card-body">
                        <p class="text-muted">A message with custom width,
                            padding and background.</p>
                        <button type="button" id="custom-padding-width-alert"
                                class="btn btn-secondary">Click Me
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div
                        class="card-header border-bottom border-dashed d-flex align-items-center">
                        <h4 class="header-title">Ajax Request</h4>
                    </div>

                    <div class="card-body">
                        <p class="text-muted">Ajax request example.</p>
                        <button type="button" id="ajax-alert"
                                class="btn btn-secondary">Click Me
                        </button>
                    </div>
                </div>
            </div>

        </div>
        <!----------------part of alerts ---------->


        @include('admin.layouts.footer')
    </div>
@include('admin.layouts.scripts')
@yield('scripts')

</body>

</html>
