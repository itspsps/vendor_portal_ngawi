@extends('dashboard.admin_qc_bongkar.layout.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')
@include('sweetalert::alert')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    PT. SURYA PANGAN SEMESTA
                </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Dashboard
                    </a>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::Dashboard 4-->

        <!--Begin::Row-->
        <div class="row">
            <div class="col-xl-12">

                <!--begin:: Widgets/Quick Stats-->
                <div class="row row-full-height">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="kt-portlet kt-portlet--height-fluid-half kt-portlet--border-bottom-brand">
                            <div class="kt-portlet__body kt-portlet__body--fluid">
                                <div class="kt-widget26">
                                    <div class="kt-widget26__content">
                                        <span class="kt-widget26__number"><i class="flaticon-users-1"></i>
                                            <span class="btn-outline btn-sm btn-info">SITE NGAWI</span>
                                        </span>
                                        <span class="kt-widget26__desc">Welcome {{Auth::user()->name_qc_bongkar}}
                                        </span>
                                    </div>
                                    <div class="kt-widget26__chart" style="height:100px; width: 230px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-space-20"></div>
                    </div>
                </div>

                <!--end:: Widgets/Quick Stats-->
            </div>
        </div>
    </div>

    <!-- end:: Content -->
</div>
@endsection
@section('js')
@endsection