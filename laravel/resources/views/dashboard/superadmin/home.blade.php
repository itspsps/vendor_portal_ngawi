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

        <div class="row">
            <div class="col-xl-12">

                <!--begin:: Widgets/Quick Stats-->
                <div class="row row-full-height">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="kt-portlet__body kt-portlet__body--fluid">
                            <div class="kt-widget26">
                                <div class="kt-widget26__content">
                                    <span class="kt-widget26__number"><i class="flaticon-users-1"></i>
                                        <span class="btn-outline btn-sm btn-info">SITE NGAWI</span>
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
                var chartContainer = KTUtil.getByID('chart_supplier');

                if (!chartContainer) {
                    return;
                }
                var chartData = {
                    labels: data.chart_value,
                    datasets: [{
                        //label: 'Dataset 1',
                        backgroundColor: KTApp.getStateColor('brand'),
                        data: data.chart_key1
                    }, {
                        //label: 'Dataset 2',
                        backgroundColor: '#f3f3fb',
                        data: data.chart_key
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
                        display: true,
                        text: 'Grafik PO Supplier'
                    },
                    tooltips: {
                        intersect: false,
                        mode: 'nearest',
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    legend: {
                        display: false
                    },
                    responsive: true,
                    maintainAspectRatio: true,
                    barRadius: 3,
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