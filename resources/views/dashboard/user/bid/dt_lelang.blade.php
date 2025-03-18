@extends('dashboard.user.layout.main1')
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
                    <a href="#" class="btn kt-subheader__btn-daterange" id="kt_dashboard_daterangepicker" data-toggle="kt-tooltip" title="Select dashboard daterange" data-placement="left">
                        <span class="kt-subheader__btn-daterange-title" id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                        <span class="kt-subheader__btn-daterange-date" id="kt_dashboard_daterangepicker_date">Aug
                            16</span>

                        <!--<i class="flaticon2-calendar-1"></i>-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon kt-svg-icon--sm">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect id="bound" x="0" y="0" width="24" height="24" />
                                <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" id="check" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z" id="Combined-Shape" fill="#000000" />
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

        <!--Begin::Row-->
        <div class="alert alert-brand m-alert m-alert--icon m-alert--air m-alert--square m--margin-bottom-30" role="alert">
            <div class="m-alert__icon">
                <i class="flaticon-exclamation-1"></i>
            </div>
            <div class="m-alert__text" style="text-align:center">
                Maaf, System dalam perbaikan!
            </div>
        </div>

    </div>

    <!-- end:: Content -->
</div>


<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{{ route('user.bid_store') }}" enctype="multipart/form-data">

                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ajukan Penawaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id_bid" id="id_bid" value="">
                    <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                    <div class="form-group">
                        <div class="">
                            <label>Harga /Kg</label>
                            <input id="price_biduser" name="price_biduser" placeholder="5000/Kg" type="text" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Keterangan</label>
                            <input id="keterangan" name="keterangan" placeholder="Keterangan" type="text" class="form-control m-input">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Gambar</label>
                            <input id="gambar" name="image_bid" placeholder="" type="file" class="form-control m-input">
                            <div id="img"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Alamat</label>
                            <input id="alamat" name="alamat" placeholder="Alamat Sesuai KTP" type="text" class="form-control m-input">
                        </div>
                    </div>
                    <input id="hidden" name="waktu" value="
                                    <?php

                                    use Carbon\Carbon;

                                    $date = Carbon::now();
                                    echo $date;
                                    ?> " type="hidden">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success m-btn pull-right">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{{ route('user.bid_store') }}" enctype="multipart/form-data">

                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Penawaran Sedang Diajukan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('js')
<script type="text/javascript">
    $(function() {
        $(document).on('click', '.toedit', function() {
            var id = $(this).attr("name");
            var url = '{{ route('
            user.bid_show ') }}' + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_bid').val(parsed.id_bid);
                    $('#kode_bid').val(parsed.kode_bid);

                }
            });
        });
    });
</script>
@endsection