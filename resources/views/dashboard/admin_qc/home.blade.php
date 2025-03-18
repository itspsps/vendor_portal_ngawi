@extends('dashboard.admin_qc.layout.main')
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
                    <a href="{{route('qc.lab.home')}}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="{{route('qc.lab.home')}}" class="kt-subheader__breadcrumbs-link">
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
                                        <span class="btn-outline btn-sm btn-info">Site Ngawi</span>
                                        <span class="kt-widget26__desc">Welcome {{Auth::user()->name_qc}}
                                        </span>
                                    </span>
                                    <div class="row">
                                        <div class="col-xl-3 col-md-3 mt-3">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                                Lab Incoming</div>
                                                            <a href="{{route('qc.lab.proses_lab1_gabah_basah')}}">
                                                                <div class="p mb-0 font-weight-bold text-primary">Proses Lab : {{$proses_lab1}} PO</div>
                                                            </a>
                                                            <a href="{{route('qc.lab.output_proses_lab1_gb')}}">
                                                                <div class="p mb-0 font-weight-bold text-primary">Selesai Lab : {{$hasil_lab1}} PO</div>
                                                            </a>
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
                                                                Lab Bongkaran</div>
                                                            <a href="{{route('qc.lab.proses_lab2_gabah_basah')}}">
                                                                <div class="p mb-0 font-weight-bold text-success">Proses Lab : {{$proses_lab2}} PO</div>
                                                            </a>
                                                            <a href="{{route('qc.lab.output_proses_lab2_gb')}}">
                                                                <div class="p mb-0 font-weight-bold text-success">Selesai Lab : {{$hasil_lab2}} PO</div>
                                                            </a>
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
                                                                PO PENDING</div>
                                                            <a href="{{route('qc.lab.pending_lab1_gabah_basah')}}">
                                                                <div class="h5 mb-0 font-weight-bold text-warning">{{$po_pending}} PO</div>
                                                            </a>
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
                                                                PO TOLAK</div>
                                                            <a href="{{route('qc.lab.reject_lab1_gabah_basah')}}">
                                                                <div class="h5 mb-0 font-weight-bold text-danger">{{$po_tolak}} PO</div>
                                                            </a>
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
                                                <p class="text-right mr-2 text-info font-weight-bold">Terakhir Input : {{\Carbon\Carbon::parse($last_hpp->waktu_plan_hpp_gb)->isoFormat('DD-MM-Y')}}</p>
                                                <div class="card-body ">
                                                    <div class="row no-gutters align-items-center mt--5">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                                PARAMETER LAB GABAH BASAH : </div>
                                                            <div class="p mb-0 text-xs">
                                                                <dl class="dl-horizontal row">
                                                                    <dd class="col-sm-4">Plan HPP</dd>
                                                                    <dd>:</dd>
                                                                    @if($hpp=='')
                                                                    <dd class="col-sm-6">Rp. -</dd>
                                                                    @else
                                                                    <dd class="col-sm-6">@foreach($hpp as $hpp){{$hpp->min_tp_gb}} - {{$hpp->max_tp_gb}} = {{rupiah($hpp->harga_gb)}}</br> @endforeach</dd>
                                                                    @endif
                                                                    <dd class="col-sm-4">Harga&nbsp;Atas</dd>
                                                                    <dd>:</dd>
                                                                    <dd class="col-sm-6"> @if($harga_atas=='NULL'|| $harga_atas=='')Rp. - @else{{rupiah($harga_atas->harga_atas_gb)}} @endif</dd>
                                                                    <dd class="col-sm-4">Harga&nbsp;Bawah</dd>
                                                                    <dd>:</dd>
                                                                    <dd class="col-sm-6"> @if($harga_bawah=='NULL'|| $harga_bawah=='')Rp. - @else{{rupiah($harga_bawah->harga_bawah_gb)}} @endif</dd>
                                                                </dl>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6 mt-3">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <p class="text-right mr-2 text-info font-weight-bold">Terakhir Input : {{\Carbon\Carbon::parse($last_refraksi_ka->tanggal_po_parameter_lab_pk_ka)->isoFormat('DD-MM-Y')}}</p>
                                                <div class="card-body ">
                                                    <div class="row no-gutters align-items-center mt--5">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-uppercase mb-1">
                                                                PARAMETER LAB BERAS PK : </div>
                                                            <div class="p mb-0 text-xs">
                                                                <div class="accordion" id="accordionExample">
                                                                    <div class="card">
                                                                        <div class="card-header" id="headingOne">
                                                                            <h2 class="mb-0">
                                                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">

                                                                                    <dt class="col-sm-12">1. Tabel Refraksi</dt>

                                                                                </button>
                                                                            </h2>
                                                                        </div>
                                                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                                            <div class="card-body">
                                                                                <dl class="dl-horizontal row">
                                                                                    <dd class="col-sm-4 ml-3">Kadar Air</dd>
                                                                                    <dd>:</dd>
                                                                                    @if($refraksi_ka=='')
                                                                                    <dd class="col-sm-6"> -</dd>
                                                                                    @else
                                                                                    <dd class="col-sm-6">@foreach($refraksi_ka as $refraksi_ka){{$refraksi_ka->min_ka_parameter_lab_pk_ka}} % - {{$refraksi_ka->max_ka_parameter_lab_pk_ka}} % = <b>{{$refraksi_ka->harga_parameter_lab_pk_ka}}</b></br> @endforeach</dd>
                                                                                    @endif
                                                                                    <dd class="col-sm-4 ml-3">Hampa</dd>
                                                                                    <dd>:</dd>
                                                                                    @if($refraksi_hampa=='')
                                                                                    <dd class="col-sm-6">-</dd>
                                                                                    @else
                                                                                    <dd class="col-sm-6">@foreach($refraksi_hampa as $refraksi_hampa){{$refraksi_hampa->min_parameter_lab_pk_hampa}} % - {{$refraksi_hampa->max_parameter_lab_pk_hampa}} % = <b>{{$refraksi_hampa->harga_parameter_lab_pk_hampa}}</b></br> @endforeach</dd>
                                                                                    @endif
                                                                                    <dd class="col-sm-4 ml-3">TR</dd>
                                                                                    <dd>:</dd>
                                                                                    @if($refraksi_tr=='')
                                                                                    <dd class="col-sm-6"> -</dd>
                                                                                    @else
                                                                                    <dd class="col-sm-6">@foreach($refraksi_tr as $refraksi_tr){{$refraksi_tr->min_parameter_lab_pk_tr}} % - {{$refraksi_tr->max_parameter_lab_pk_tr}} % = <b>{{$refraksi_tr->harga_parameter_lab_pk_tr}}</b></br> @endforeach</dd>
                                                                                    @endif
                                                                                    <dd class="col-sm-4 ml-3">Katul</dd>
                                                                                    <dd>:</dd>
                                                                                    @if($refraksi_katul=='')
                                                                                    <dd class="col-sm-6"> -</dd>
                                                                                    @else
                                                                                    <dd class="col-sm-6">@foreach($refraksi_katul as $refraksi_katul){{$refraksi_katul->min_parameter_lab_pk_katul}} % - {{$refraksi_katul->max_parameter_lab_pk_katul}} % = <b>{{$refraksi_katul->harga_parameter_lab_pk_katul}}</b></br> @endforeach</dd>
                                                                                    @endif
                                                                                    <dd class="col-sm-4 ml-3">Butir Patah</dd>
                                                                                    <dd>:</dd>
                                                                                    @if($refraksi_butiran_patah=='')
                                                                                    <dd class="col-sm-6"> -</dd>
                                                                                    @else
                                                                                    <dd class="col-sm-6">@foreach($refraksi_butiran_patah as $refraksi_butiran_patah){{$refraksi_butiran_patah->min_parameter_lab_pk_butiran_patah}} % - {{$refraksi_butiran_patah->max_parameter_lab_pk_butiran_patah}} % = <b>{{$refraksi_butiran_patah->harga_parameter_lab_pk_butiran_patah}}</b></br> @endforeach</dd>
                                                                                    @endif
                                                                                </dl>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-header" id="headingTwo">
                                                                            <h2 class="mb-0">
                                                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                                    <dt class="col-sm-12">2. Tabel Reward</dt>
                                                                                </button>
                                                                            </h2>
                                                                        </div>
                                                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                                                            <div class="card-body">
                                                                                <dl class="dl-horizontal row">
                                                                                    <dd class="col-sm-4 ml-3">Kadar Air</dd>
                                                                                    <dd>:</dd>
                                                                                    @if($reward_kadar_air=='')
                                                                                    <dd class="col-sm-6"> -</dd>
                                                                                    @else
                                                                                    <dd class="col-sm-6">@foreach($reward_kadar_air as $reward_kadar_air)< {{$reward_kadar_air->value_parameter_lab_pk_reward_kadar_air}} %&nbsp;=&nbsp;<b>{{$reward_kadar_air->reward_parameter_lab_pk_reward_kadar_air}} %</b></br> @endforeach</dd>
                                                                                    @endif
                                                                                    <dd class="col-sm-4 ml-3">Hampa</dd>
                                                                                    <dd>:</dd>
                                                                                    @if($reward_hampa=='')
                                                                                    <dd class="col-sm-6"> -</dd>
                                                                                    @else
                                                                                    <dd class="col-sm-6">@foreach($reward_hampa as $reward_hampa)< {{$reward_hampa->value_parameter_lab_pk_reward_hampa}} %&nbsp;=&nbsp;<b>{{$reward_hampa->reward_parameter_lab_pk_reward_hampa}} %</b></br> @endforeach</dd>
                                                                                    @endif
                                                                                    <dd class="col-sm-4 ml-3">TR</dd>
                                                                                    <dd>:</dd>
                                                                                    @if($reward_tr=='')
                                                                                    <dd class="col-sm-6"> -</dd>
                                                                                    @else
                                                                                    <dd class="col-sm-6">@foreach($reward_tr as $reward_tr)> {{$reward_tr->value_parameter_lab_pk_reward_tr}} %&nbsp;=&nbsp;<b>{{$reward_tr->reward_parameter_lab_pk_reward_tr}} %</b></br> @endforeach</dd>
                                                                                    @endif
                                                                                    <dd class="col-sm-4 ml-3">Katul</dd>
                                                                                    <dd>:</dd>
                                                                                    @if($reward_katul=='')
                                                                                    <dd class="col-sm-6"> -</dd>
                                                                                    @else
                                                                                    <dd class="col-sm-6">@foreach($reward_katul as $reward_katul)< {{$reward_katul->value_parameter_lab_pk_reward_katul}} %&nbsp;=&nbsp;<b>{{$reward_katul->reward_parameter_lab_pk_reward_katul}} %</b></br> @endforeach</dd>
                                                                                    @endif
                                                                                    <dd class="col-sm-4 ml-3">Butir Patah</dd>
                                                                                    <dd>:</dd>
                                                                                    @if($reward_butir_patah=='')
                                                                                    <dd class="col-sm-6"> -</dd>
                                                                                    @else
                                                                                    <dd class="col-sm-6">@foreach($reward_butir_patah as $reward_butir_patah)< {{$reward_butir_patah->value_parameter_lab_pk_reward_butir_patah}} %&nbsp;=&nbsp;<b>{{$reward_butir_patah->reward_parameter_lab_pk_reward_butir_patah}} %</b></br> @endforeach</dd>
                                                                                    @endif
                                                                                </dl>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-header" id="headingThree">
                                                                            <h2 class="mb-0">
                                                                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                                    <dt class="col-sm-12">3. Tabel Kualitas</dt>
                                                                                </button>
                                                                            </h2>
                                                                        </div>
                                                                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                                            <div class="card-body">
                                                                                <dl class="dl-horizontal row">
                                                                                    <dd class="col-sm-4 ml-3">Transparency</dd>
                                                                                    <dd>:</dd>
                                                                                    @if($kualitas_pk_tr=='')
                                                                                    <dd class="col-sm-6"> -</dd>
                                                                                    @else
                                                                                    <dd class="col-sm-6">@foreach($kualitas_pk_tr as $kualitas_pk_tr) {{$kualitas_pk_tr->min_parameter_lab_pk_tr_kualitas}} %&nbsp;-&nbsp;{{$kualitas_pk_tr->max_parameter_lab_pk_tr_kualitas}} % = <b>{{$kualitas_pk_tr->kualitas_parameter_lab_pk}}</b> </br> @endforeach</dd>
                                                                                    @endif
                                                                                    <dd class="col-sm-4 ml-3">Butir Patah</dd>
                                                                                    <dd>:</dd>
                                                                                    @if($kualitas_pk_bp=='')
                                                                                    <dd class="col-sm-6"> -</dd>
                                                                                    @else
                                                                                    <dd class="col-sm-6">@foreach($kualitas_pk_bp as $kualitas_pk_bp) {{$kualitas_pk_bp->min_parameter_lab_pk_butirpatah_kualitas}} %&nbsp;-&nbsp;{{$kualitas_pk_bp->max_parameter_lab_pk_butirpatah_kualitas}} % = <b>{{$kualitas_pk_bp->kualitas_parameter_lab_pk}}</b> </br> @endforeach</dd>
                                                                                    @endif
                                                                                    <dt class="col-sm-4">4. Harga&nbsp;Atas</dt>
                                                                                    <dd class="ml-3">:</dd>
                                                                                    <dd class="col-sm-4"> @if($harga_atas_pk=='NULL'|| $harga_atas_pk=='')Rp. - @else{{rupiah($harga_atas_pk->harga_atas_pk)}} @endif</dd>
                                                                                </dl>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    </dl>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-xl-6 col-md-6 mt-3">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <canvas class="kt-widget26__chart" id="myChart_pobongkar" style="height:200px; width: 230px;">
                                                        </canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="col-xl-6 col-md-6 mt-3">
                                            <div class="kt-portlet kt-portlet--height-fluid">
                                                <div class="kt-widget14">
                                                    <div class="kt-widget14__header">
                                                        <h3 class="kt-widget14__title">
                                                            Grafik Gudang
                                                        </h3>
                                                        <span class="kt-widget14__desc">
                                                            Gudang Lokasi Bongkar
                                                        </span>
                                                    </div>
                                                    <div class="kt-widget14__content">
                                                        <div class="kt-widget14__chart">
                                                            <div id="grafik_pie_gudang" style="height: 200px; width: 200px;"></div>
                                                        </div>
                                                        <div class="kt-widget14__legends">
                                                            <div class="kt-widget14__legend">
                                                                <span class="kt-widget14__bullet kt-bg-success"></span>
                                                                <span class="kt-widget14__stats"> Selatan</span>
                                                            </div>
                                                            <div class="kt-widget14__legend">
                                                                <span class="kt-widget14__bullet kt-bg-info"></span>
                                                                <span class="kt-widget14__stats"> Utara</span>
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
<script>
    $("document").ready(function() {
        $.ajax({
            url: "{{route('qc.lab.chart_gudang')}}",
            method: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data);
                revenueChange(data.chart_bongkar_selatan, data.chart_bongkar_utara);
            }
        });

        function revenueChange(chart_bongkar_selatan = '', chart_bongkar_utara = '') {
            if ($('#grafik_pie_gudang').length == 0) {
                return;
            }

            Morris.Donut({
                element: 'grafik_pie_gudang',
                data: [{
                        label: "G. Selatan",
                        value: chart_bongkar_selatan,
                    },
                    {
                        label: "G. Utara",
                        value: chart_bongkar_utara,
                    }
                ],
                colors: [
                    KTApp.getStateColor('success'),
                    KTApp.getStateColor('brand')
                ],
            });
        }
    });
</script>
@endsection