@extends('dashboard.user.layout.main')
@section('title')
    SUMBER PANGAN
@endsection
@section('content')
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

        <!-- begin:: Subheader -->
        <div class="kt-subheader   kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">
                        ACCOUNT </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">
                            CV. SUMBER PANGAN </a>

                        <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="kt-subheader__wrapper">
                        <a href="#" class="btn kt-subheader__btn-daterange" id="kt_dashboard_daterangepicker"
                            data-toggle="kt-tooltip" title="Select dashboard daterange" data-placement="left">
                            <span class="kt-subheader__btn-daterange-title"
                                id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                            <span class="kt-subheader__btn-daterange-date" id="kt_dashboard_daterangepicker_date">Aug
                                16</span>

                            <!--<i class="flaticon2-calendar-1"></i>-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--sm">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect id="bound" x="0" y="0" width="24" height="24" />
                                    <path
                                        d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z"
                                        id="check" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path
                                        d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z"
                                        id="Combined-Shape" fill="#000000" />
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- end:: Subheader -->



        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

            <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="flaticon-user"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                Account
                            </h3>
                        </div>
                    </div>
                    <form method="post" action="{{ url('user/account_update/'.$data->id) }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                        <div class="kt-portlet__body">
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">* Name:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="name_admin" class="form-control m-input" value="{{$data->name}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">* Email:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="email_admin" class="form-control m-input" value="{{$data->email}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">* NPWP:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="number" name="npwp" class="form-control m-input" value="{{$data->npwp}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">* KTP:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="number" name="ktp" class="form-control m-input" value="{{$data->ktp}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">* No. Rekening:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="number" name="nomer_rekening" class="form-control m-input" value="{{$data->nomer_rekening}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">* No. Telp:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="number" name="nomer_hp" class="form-control m-input" value="{{$data->nomer_hp}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">* Password:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="password" class="form-control m-input" value="{{$data->password_show}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">* Create:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="created_at" class="form-control m-input" readonly value="{{$data->created_at}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">* Update:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="updated_at" class="form-control m-input" readonly  value="{{$data->updated_at}}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success m-btn pull-right">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- end:: Content -->

    </div>

@endsection
@section('js')
@endsection
