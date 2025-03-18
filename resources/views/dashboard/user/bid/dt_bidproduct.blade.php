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
                        Dashboard </h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="" class="kt-subheader__breadcrumbs-link">
                            SUMBER PANGAN </a>

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

            <!--Begin::Dashboard 4-->
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="kt-portlet ">
                    <div class="">
                        <!--begin::Accordion-->
                        <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                            <div class="card">
                                <div class="card-header" id="headingOne4">
                                    <div class="card-title" data-toggle="collapse" data-target="#collapseOne4"
                                        aria-expanded="false" aria-controls="collapseOne4">
                                        <i class="flaticon-add-circular-button"></i> Bid Product
                                    </div>
                                </div>
                                <div id="collapseOne4" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#accordionExample4">
                                    <div class="card-body">
                                        <form class="kt-form" id="kt_apps_user_add_user_form" action="{{ route('user.bid_store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                                data-ktwizard-state="current">
                                                <div class="kt-section kt-section--first">
                                                    <div class="kt-wizard-v4__form">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <div class="kt-section__body">
                                                                    <input type="hidden" name="bid_id" value="{{$data->id_bid}}">
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-xl-3 col-lg-3 col-form-label">Price /Kg</label>
                                                                        <div class="col-lg-9 col-xl-9">
                                                                            <input class="form-control" name="price_bid"
                                                                                placeholder="10.000 Kg" type="text">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-xl-3 col-lg-3 col-form-label">Date</label>
                                                                        <div class="col-lg-9 col-xl-9">
                                                                            <input class="form-control" name="date_bid"
                                                                                placeholder="" type="date">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-xl-3 col-lg-3 col-form-label">Description</label>
                                                                        <div class="col-lg-9 col-xl-9">
                                                                            <textarea name="description_bid" type="type" class="form-control m-input" placeholder="Type your description" rows="5" required=""></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label
                                                                            class="col-xl-3 col-lg-3 col-form-label">Image</label>
                                                                        <div class="col-lg-9 col-xl-9">
                                                                            <input class="form-control" name="image_bid"
                                                                                placeholder="" type="file">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="kt-form__actions">
                                                        <button type="submit" class="btn btn-success m-btn pull-right"
                                                            style="">Submit</button>
                                                    </div><br>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Accordion-->
                    </div>
                </div>
            </div>
            <!--Begin::Row-->
            <div class="">
                <div class="row">
                    <div class="col-lg-12 col-xl-12 order-lg-1 order-xl-1">

                        <!--begin:: Widgets/Blog-->
                        <div class="kt-portlet kt-portlet--height-fluid kt-widget19">
                            <div class="kt-portlet__body kt-portlet__body--fit kt-portlet__body--unfill">
                                <div class="kt-widget19__pic kt-portlet-fit--top kt-portlet-fit--sides" style="min-height: 300px; background-image: url({{asset('img/bid/'.$data->image_bid)}})">
                                    <h3 class="kt-widget19__title kt-font-light">
                                        {{$data->name_bid}}
                                    </h3>

                                </div>

                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-widget19__wrapper">
                                    <div class="kt-widget19__content">
                                        <div class="kt-widget19__userpic">
                                            <img src="{{asset('img/bid/'.$data->image_bid)}}" alt="">
                                        </div>
                                        <div class="kt-widget19__info">
                                            <a href="#" class="kt-widget19__username">
                                                Founder
                                            </a>
                                            <span class="kt-widget19__time">
                                                 CV. Sumber Pangan
                                            </span>
                                        </div>
                                        <div class="kt-widget19__stats">
                                            <span class="kt-widget19__number kt-font-brand">
                                                <?php $data1 = DB::table('bid_user')->where('bid_id', $data->id_bid)->get();
                                                echo count($data1) ?>
                                            </span>
                                            <a href="#" class="kt-widget19__comment">
                                                Response
                                            </a>
                                        </div>
                                    </div>
                                    <p>{{$data->description_bid}}</p>
                                </div>

                            </div>
                        </div>

                        <!--end:: Widgets/Blog-->
                    </div>
                </div>
            </div>
        </div>

        <!-- end:: Content -->
    </div>
@endsection
@section('js')
@endsection
