@extends('admin.master')
@section('page_class' , 'permissions-pg')

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
                            <h4 class="header-title text-black">مجموعة الصلاحيات : Super Admin</h4>
                        </div>


                        <div class="table-main-btn mx-auto">
                            <a href="#" class="btn main-btn contact-us-btn fs-6 d-flex align-items-center gap-1"
                               type="button">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="16" height="16"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="back-btn-svg">
                                    <path d="M5 12h14"></path>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                                رجوع
                            </a>
                        </div>
                    </div>


                    <form class="card-body">
                        <div class="row g-3">



                            <div class="col-12">
                                <div class="w-100 border rounded p-3 shadow-lg">

                                    <div class="form-check mb-3 pb-2 collection-head">
                                        <input class="form-check-input" type="checkbox" id="users">
                                        <label class="form-check-label ms-2 fw-bold" for="users">
                                            Users
                                        </label>
                                    </div>

                                    <div class="row users-inputs">
                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="form-check">
                                                <input class="form-check-input child" type="checkbox" id="users-view">
                                                <label class="form-check-label ms-2" for="users-view">عرض - View</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="form-check">
                                                <input class="form-check-input child" type="checkbox" id="users-add">
                                                <label class="form-check-label ms-2" for="users-add">إضافة - Add</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="form-check">
                                                <input class="form-check-input child" type="checkbox" id="users-edit">
                                                <label class="form-check-label ms-2" for="users-edit">تعديل -
                                                    Edit</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="form-check">
                                                <input class="form-check-input child" type="checkbox" id="users-del">
                                                <label class="form-check-label ms-2" for="users-del">حذف -
                                                    Delete</label>
                                            </div>
                                        </div>


                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="form-check permissions-inputs-margin-top">
                                                <input class="form-check-input child" type="checkbox"
                                                       id="users-view-role">
                                                <label class="form-check-label ms-2" for="users-view-role">عرض الجروبات
                                                    - View Role</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="form-check permissions-inputs-margin-top">
                                                <input class="form-check-input child" type="checkbox"
                                                       id="users-add-role">
                                                <label class="form-check-label ms-2" for="users-add-role">إضافة جروب -
                                                    Add Role</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="form-check permissions-inputs-margin-top">
                                                <input class="form-check-input child" type="checkbox"
                                                       id="users-edit-role">
                                                <label class="form-check-label ms-2" for="users-edit-role">تعديل جروب -
                                                    Edit Role</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="form-check permissions-inputs-margin-top">
                                                <input class="form-check-input child" type="checkbox"
                                                       id="users-del-role">
                                                <label class="form-check-label ms-2" for="users-del-role">حذف جروب -
                                                    Delete Role</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-6 col-12">
                                            <div class="form-check permissions-inputs-margin-top">
                                                <input class="form-check-input child" type="checkbox"
                                                       id="users-role-perm">
                                                <label class="form-check-label ms-2" for="users-role-perm">صلاحيات
                                                    الجروب - Role Permissions</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end gap-2 flex-column flex-md-row">
                                <button type="reset" class="btn main-btn edit-btn fw-bold fs-6">تعديل</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('admin/js/permissions.js')}}"></script>
@endsection
