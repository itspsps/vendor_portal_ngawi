@extends('dashboard.superadmin.layout.main')
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
                    Dashboard </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        PT. SURYA PANGAN SEMESTA </a>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>
            <div class="kt-subheader__toolbar">
                <div class="kt-subheader__wrapper">
                    <a href="javascript:void(0)" class="btn kt-subheader__btn-daterange" id="kt_dashboard_daterangepicker" data-toggle="kt-tooltip" title="Select dashboard daterange" data-placement="left">
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

        <div class="row">
            <div class="col-xl-12">

                <!--begin:: Widgets/Quick Stats-->
                <div class="row row-full-height">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="kt-portlet__body kt-portlet__body--fluid">
                            <div class="kt-widget26">
                                <div class="kt-widget26__content">
                                    <span class="kt-widget26__number"><i class="flaticon-users-1"></i>
                                        <span class="btn-outline btn-sm btn-info">Site Ngawi</span>
                                        <span class="kt-widget26__desc">Welcome {{Auth::user()->name}}
                                        </span>
                                    </span>
                                    <div class="row">
                                        <div class="col-xl-3 col-md-3 mt-3">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                                PO Aktif</div>
                                                            <div class="h5 mb-0 font-weight-bold text-primary">{{$po_aktif}} PO</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-list-alt fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-3 mt-3">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                                PO Close</div>
                                                            <div class="h5 mb-0 font-weight-bold text-danger">{{$po_close}} PO</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-list-alt fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-3 mt-3">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                                PO Finish</div>
                                                            <div class="h5 mb-0 font-weight-bold text-success">{{$po_finish}} PO</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-list-alt fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-md-3 mt-3">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                                PO On Process</div>
                                                            <div class="h5 mb-0 font-weight-bold text-warning">{{$po_proses}} PO</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <i class="fas fa-list-alt fa-2x text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 mt-3">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <canvas class="kt-widget26__chart" id="chart_supplier" style="height:150px; width: 230px;">
                                                        </canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 mt-3">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <canvas class="kt-widget26__chart" id="chart_po" style="height:300%; width: 230px;">
                                                        </canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{asset('assets/vendors/general/chart.js/dist/Chart.bundle.js')}}" type="text/javascript"></script>
<script>
    $("document").ready(function() {
        $.ajax({
            url: "{{route('sourching.chart_po')}}",
            method: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data);
                $.each(data.chart_supplier, function(item) {

                });
                var chartContainer = KTUtil.getByID('chart_supplier');

                if (!chartContainer) {
                    return;
                }
                var chartData = {
                    labels: data.chart_supplier,
                    datasets: [{
                        //label: 'Dataset 1',
                        backgroundColor: KTApp.getStateColor('success'),
                        data: [
                            15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
                        ]
                    }, {
                        //label: 'Dataset 2',
                        backgroundColor: '#f3f3fb',
                        data: [
                            15, 20, 25, 30, 25, 20, 15, 20, 25, 30, 25, 20, 15, 10, 15, 20
                        ]
                    }]
                };
                fun_chart_supplier(chartData, chartContainer);
                fun_chart_po(data.chart_januari, data.chart_februari, data.chart_maret, data.chart_april, data.chart_mei, data.chart_juni, data.chart_juli, data.chart_agustus, data.chart_september, data.chart_oktober, data.chart_november, data.chart_desember);
            }
        });

        function fun_chart_po(chart_januari = '', chart_februari = '', chart_maret = '', chart_april = '', chart_mei = '', chart_juni = '', chart_juli = '', chart_agustus = '', chart_september = '', chart_oktober = '', chart_november = '', chart_desember = '') {
            if ($('#chart_po').length == 0) {
                return;
            }

            var ctx = document.getElementById("chart_po").getContext("2d");

            var gradient = ctx.createLinearGradient(0, 0, 0, 240);
            gradient.addColorStop(0, Chart.helpers.color('#d1f1ec').alpha(1).rgbString());
            gradient.addColorStop(1, Chart.helpers.color('#d1f1ec').alpha(0.3).rgbString());

            var config = {
                type: 'line',
                data: {
                    labels: ["JANUARI", "FEBRUARI", "MARET", "APRIL", "MEI", "JUNI", "JULI", "AGUSTUS", "SEPTEMBER", "OKTOBER", "NOVEMBER", "DESEMBER"],
                    datasets: [{
                        label: "PURCHASE ORDER",
                        backgroundColor: gradient,
                        borderColor: KTApp.getStateColor('success'),

                        pointBackgroundColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                        pointBorderColor: Chart.helpers.color('#000000').alpha(0).rgbString(),
                        pointHoverBackgroundColor: KTApp.getStateColor('danger'),
                        pointHoverBorderColor: Chart.helpers.color('#000000').alpha(0.1).rgbString(),

                        //fill: 'start',
                        data: [
                            chart_januari, chart_februari, chart_maret, chart_april, chart_mei, chart_juni, chart_juli, chart_agustus, chart_september, chart_oktober, chart_november, chart_desember
                        ]
                    }]
                },
                options: {
                    title: {
                        display: false,
                    },
                    tooltips: {
                        mode: 'nearest',
                        intersect: false,
                        position: 'nearest',
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    legend: {
                        display: true
                    },
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        xAxes: [{
                            display: true,
                            gridLines: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'BULAN'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            gridLines: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'JUMLAH PO'
                            },
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    elements: {
                        line: {
                            tension: 0.0000001
                        },
                        point: {
                            radius: 4,
                            borderWidth: 12
                        }
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 10,
                            bottom: 0
                        }
                    }
                }
            };

            var chart = new Chart(ctx, config);
        }

        function fun_chart_supplier(chartData = '', chartContainer = '') {
            var chart = new Chart(chartContainer, {
                type: 'bar',
                data: chartData,
                options: {
                    title: {
                        display: false,
                    },
                    tooltips: {
                        intersect: false,
                        mode: 'nearest',
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    legend: {
                        display: true
                    },
                    responsive: true,
                    maintainAspectRatio: true,
                    barRadius: 4,
                    scales: {
                        xAxes: [{
                            display: true,
                            gridLines: true,
                            stacked: true
                        }],
                        yAxes: [{
                            display: true,
                            stacked: true,
                            gridLines: true
                        }]
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    }
                }
            });
        }
    });
</script>
@endsection