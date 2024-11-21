@extends('dashboard.user.layout.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{csrf_token()}}">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single {
        height: 34px !important;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #ccc !important;
        border-radius: 0px !important;
    }

    * {
        margin: 0;
        padding: 0;
    }

    html {
        height: 100%;
    }

    /*Background color*/


    /*form styles*/
    #msform {
        text-align: center;
        position: relative;
        margin-top: 20px;
    }

    #msform fieldset .form-card {
        background: white;
        border: 0 none;
        border-radius: 0px;
        box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
        padding: 20px 40px 30px 40px;
        box-sizing: border-box;
        width: 94%;
        margin: 0 3% 20px 3%;

        /*stacking fieldsets above each other*/
        position: relative;
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;

        /*stacking fieldsets above each other*/
        position: relative;
    }

    /*Hide all except first fieldset*/
    #msform fieldset:not(:first-of-type) {
        display: none;
    }

    #msform fieldset .form-card {
        text-align: left;
        color: #9E9E9E;
    }

    #msform input,
    #msform textarea {
        padding: 0px 8px 4px 8px;
        border: none;
        border-bottom: 1px solid #ccc;
        border-radius: 0px;
        margin-bottom: 25px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        font-family: montserrat;
        color: #2C3E50;
        font-size: 16px;
        letter-spacing: 1px;
    }

    #msform input:focus,
    #msform textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: none;
        font-weight: bold;
        border-bottom: 2px solid skyblue;
        outline-width: 0;
    }

    /*Blue Buttons*/
    #msform .action-button {
        width: 100px;
        background: skyblue;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px;
    }

    #msform .action-button:hover,
    #msform .action-button:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue;
    }

    /*Previous Buttons*/
    #msform .action-button-previous {
        width: 100px;
        background: #616161;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px;
    }

    #msform .action-button-previous:hover,
    #msform .action-button-previous:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px #616161;
    }

    /*Dropdown List Exp Date*/
    select.list-dt {
        border: none;
        outline: 0;
        border-bottom: 1px solid #ccc;
        padding: 2px 5px 3px 5px;
        margin: 2px;
    }

    select.list-dt:focus {
        border-bottom: 2px solid skyblue;
    }

    /*The background card*/
    .card {
        z-index: 0;
        border: none;
        border-radius: 0.5rem;
        position: relative;
    }

    /*FieldSet headings*/
    .fs-title {
        font-size: 25px;
        color: #2C3E50;
        margin-bottom: 10px;
        font-weight: bold;
        text-align: left;
    }

    /*progressbar*/
    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey;
    }

    #progressbar .active {
        color: #000000;
    }

    #progressbar li {
        list-style-type: none;
        font-size: 12px;
        width: 25%;
        float: left;
        position: relative;
    }

    /*Icons in the ProgressBar*/
    #progressbar #account:before {
        font-family: FontAwesome;
        content: "\f023";
    }

    #progressbar #personal:before {
        font-family: FontAwesome;
        content: "\f007";
    }

    #progressbar #payment:before {
        font-family: FontAwesome;
        content: "\f09d";
    }

    #progressbar #confirm:before {
        font-family: FontAwesome;
        content: "\f00c";
    }

    /*ProgressBar before any progress*/
    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 18px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px;
    }

    /*ProgressBar connectors*/
    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1;
    }

    /*Color number of the step and the connector before it*/
    #progressbar li.active:before,
    #progressbar li.active:after {
        background: #c40316;
    }

    /*Imaged Radio Buttons*/
    .radio-group {
        position: relative;
        margin-bottom: 25px;
    }

    .radio {
        display: inline-block;
        width: 204;
        height: 104;
        border-radius: 0;
        background: lightblue;
        box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
        box-sizing: border-box;
        cursor: pointer;
        margin: 8px 2px;
    }

    .radio:hover {
        box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);
    }

    .radio.selected {
        box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1);
    }

    /*Fit image in bootstrap div*/
    .fit-image {
        width: 100%;
        object-fit: cover;
    }
</style>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js">
</script>

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
    label.error {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
        padding: 1px 20px 1px 20px;
        margin-top: -20px;
    }

    .stepwizard-step p {
        margin-top: 10px;
    }

    .stepwizard-row {
        display: table-row;
    }

    .stepwizard {
        display: table;
        width: 100%;
        position: relative;
    }

    .stepwizard-step button[disabled] {
        opacity: 1 !important;
        filter: alpha(opacity=100) !important;
    }

    .stepwizard-row:before {
        top: 14px;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 100%;
        height: 1px;
        background-color: #ccc;
        z-order: 0;

    }

    .stepwizard-step {
        display: table-cell;
        text-align: center;
        position: relative;
    }

    .btn-circle {
        width: 30px;
        height: 30px;
        text-align: center;
        padding: 6px 0;
        font-size: 12px;
        line-height: 1.428571429;
        border-radius: 15px;
    }
</style>
@section('content')
<header>
    <div class="login_page_bg" style="">
        <div class="container">
            <div class="customer_login">
                @include('sweetalert::alert')
                <div class="row">
                    <div class="col-lg-3 col-md-3"></div>
                    <div class="col-lg-6 col-md-6">
                        <div class="account_form register">
                            <div class="container-fluid" id="grad1">
                                <div class="row justify-content-center mt-0">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center p-0 mt-3 mb-2">
                                        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                                            <h2><strong>Register</strong></h2>
                                            <p>Isi semua bidang formulir untuk melanjutkan ke langkah berikutnya</p>
                                            <div class="row">
                                                <div class="col-md-12 mx-0">

                                                    <div class="stepwizard">
                                                        <div class="stepwizard-row setup-panel">
                                                            <div class="stepwizard-step">
                                                                <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                                                <p>Identitas NPWP</p>
                                                            </div>
                                                            <div class="stepwizard-step">
                                                                <a href="#step-2" type="button" class="btn btn-default btn-circle">2</a>
                                                                <p>Identitas KTP</p>
                                                            </div>
                                                            <div class="stepwizard-step">
                                                                <a href="#step-3" type="button" class="btn btn-default btn-circle">3</a>
                                                                <p>Identitas Pembayaran</p>
                                                            </div>
                                                            <div class="stepwizard-step">
                                                                <a href="#step-4" type="button" class="btn btn-default btn-circle">4</a>
                                                                <p>Identitas Akun</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form role="form" name="validasi" action="{{ route('user.create') }}" method="POST" enctype="multipart/form-data" id="msform">
                                                        {{ csrf_field() }}
                                                        @csrf
                                                        @if (Session::get('success'))
                                                        <div class="alert alert-success">
                                                            {{ Session::get('success') }}
                                                        </div>
                                                        @endif
                                                        @if (Session::get('fail'))
                                                        <div class="alert alert-danger">
                                                            {{ Session::get('fail') }}
                                                        </div>
                                                        @endif
                                                        <div class="row setup-content" id="step-1">
                                                            <div class="col-xs-12">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">Nama NPWP</label>
                                                                        <input class="form-control" type="text" id="nama_npwp" name="nama_npwp" required="required" placeholder="Nama NPWP" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">No. NPWP</label>
                                                                        <input class="form-control" type="number" id="jumlah_npwp" placeholder="123************" required name="npwp" />
                                                                        <div id="error_message">

                                                                        </div>
                                                                    </div>
                                                                    <p id="GFG_DOWN" style="color: green;">
                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label" style="float: left">Alamat NPWP</label>
                                                                                <select class="form-control select2" name="id_provinsinpwp" required="required" id="provinsi_npwp">
                                                                                    <option value="">Pilih Provinsi...</option>
                                                                                    <?php
                                                                                    $prov = App\Models\Province::all();
                                                                                    ?>
                                                                                    @foreach ($prov as $provinsi)
                                                                                    <option value="{{$provinsi->id}}">{{$provinsi->name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <br>
                                                                                <select class="form-control select2 " required="required" name="id_kabupatennpwp" id="kabupaten_npwp">
                                                                                    <option>Pilih Kabupaten...</option>
                                                                                </select>
                                                                                <br>
                                                                                <select class="form-control select2 " required="required" name="id_kecamatannpwp" id="kecamatan_npwp">
                                                                                    <option>Pilih Kecamatan...</option>
                                                                                </select>
                                                                                <br>
                                                                                <select class="form-control select2" name="id_desanpwp" id="desa_npwp">
                                                                                    <option>Pilih Desa...</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label mt-3" style="float: left">Keterangan NPWP </label>

                                                                                <textarea width="100%" name="keterangan_alamat_npwp"></textarea>
                                                                                <span style="font-size: 10px; margin-top:-30; color:blue;float:left">*Diisi jika nama desa tidak tercantumkan</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">RT/RW</label>
                                                                        <input class="form-control" type="number" id="rt_npwp" name="rt_npwp" required="required" style="width:100%">

                                                                        <input class="form-control" type="number" id="rw_npwp" name="rw_npwp" required="required" style="width:100%">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">Upload NPWP <span style="font-size:10px;color:#4D006E">(Format : jpeg,png,jpg,gif,svg|max:2048)</span> </label>
                                                                        <input class="form-control" id="gambar_npwp" type="file" name="gambar_npwp" accept="image/*" required>
                                                                        <span style="font-size: 10px; margin-top:-30; color:blue;float:left">*Pastikan npwp terlihat jelas di foto</span>
                                                                    </div>
                                                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row setup-content" id="step-2">
                                                            <div class="col-xs-12">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left;">Nama KTP</label>
                                                                        <input type="text" class="form-control" required="required" id="nama_ktp" name="nama_ktp" placeholder="Nama KTP" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left;">No. KTP</label>
                                                                        <input class="form-control" type="number" id="jumlah_ktp" placeholder="35************" required name="ktp" />
                                                                        <div id="errornik_message">

                                                                        </div>
                                                                    </div>
                                                                    <div class=" form-group">
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <label class="control-label" style="float: left">Alamat KTP</label>
                                                                                <select class="form-control select2" name="id_provinsiktp" required="required" id="provinsi_ktp">
                                                                                    <option value="">Pilih Provinsi...</option>
                                                                                    <?php
                                                                                    $prov = App\Models\Province::all();
                                                                                    ?>
                                                                                    @foreach ($prov as $provinsi)
                                                                                    <option value="{{$provinsi->id}}">{{$provinsi->name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <br>
                                                                                <select class="form-control select2 " required="required" name="id_kabupatenktp" id="kabupaten_ktp">
                                                                                    <option>Pilih Kabupaten...</option>
                                                                                </select>
                                                                                <br>
                                                                                <select class="form-control select2 " required="required" name="id_kecamatanktp" id="kecamatan_ktp">
                                                                                    <option>Pilih Kecamatan...</option>
                                                                                </select>
                                                                                <br>
                                                                                <select class="form-control select2" name="id_desaktp" id="desa_ktp">
                                                                                    <option>Pilih Desa...</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <label class="control-label" style="float: left;font-size:10px;color:#4D006E">Keterangan KTP</label>
                                                                                <textarea width="100%" name="keterangan_alamat_ktp"></textarea>
                                                                                <span style="font-size: 10px; margin-top:-30; color:blue;float:left">*Diisi jika nama desa tidak tercantumkan</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">RT/RW</label>
                                                                        <input class="form-control" type="number" id="rt_ktp" name="rt_ktp" required="required" style="width:100%">
                                                                        <input class="form-control" type="number" id="rw_ktp" name="rw_ktp" required="required" style="width:100%">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">Upload KTP <span style="">(Format : jpeg,png,jpg,gif,svg|max:2048)</span> </label>
                                                                        <input class="form-control" id="gambar_ktp" type="file" name="gambar_ktp" accept="image/*" required>
                                                                        <span style="font-size: 10px; color:blue;float:left">*Pastikan KTP tierlihat jelas di foto</span>
                                                                    </div>
                                                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row setup-content" id="step-3">
                                                            <div class="col-xs-12">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">Nama BANK</label>
                                                                        <select class="form-control select2" onchange="bankCheck(this);" name="nama_bank" id="nama_bank" required="required">
                                                                            <option disabled selected>~Pilih BANK~</option>
                                                                            <option value="BBRI">PT BANK RAKYAT INDONESIA (PERSERO) Tbk</option>
                                                                            <option value="BMRI">PT BANK MANDIRI (PERSERO) Tbk</option>
                                                                            <option value="BBCA">PT BANK CENTRAL ASIA Tbk</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">Nomer Rekening</label>
                                                                        <input class="form-control" type="number" name="nomer_rekening" id="nomor_rekening" required="required" placeholder="123********" />
                                                                        <div id="errorrekening_message">

                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">Nama Penerima</label>
                                                                        <input class="form-control" id="nama_penerima_bank" type="text" name="nama_penerima_bank" required="required" placeholder="Nama Penerima" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">Cabang BANK</label>
                                                                        <input class="form-control" id="cabang_bank" type="text" name="cabang_bank" required="required" placeholder="Cabang BANK" />
                                                                    </div>
                                                                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button">Next</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row setup-content" id="step-4">
                                                            <div class="col-xs-12">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">Nama</label>
                                                                        <input class="form-control" id="nama_vendor" type="text" name="nama_vendor" placeholder="Nama Vendor" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">No. Telp</label>
                                                                        <input class="form-control" type="number" value="" id="nomer_hp" name="nomer_hp" placeholder="+62***********" />
                                                                    </div>

                                                                    <div class=" form-group">
                                                                        <label class="control-label" style="float: left">Email</label>
                                                                        <input class="form-control" id="email" type="email" name="email" onkeyup="nospacesemail(this)" placeholder="vendor@gmail.com" />
                                                                        <div id="erroremail_message">

                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">Badan Usaha</label>
                                                                        <input class="form-control" type="text" name="badan_usaha" placeholder="UD.***" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">Username</label>
                                                                        <input class="form-control" id="username" type="text" onkeyup="nospaces(this)" name="username" placeholder="Username" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">Password</label>
                                                                        <input class="form-control" id="password" type="password" name="password" placeholder="********" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">Konfirmasi Password</label>
                                                                        <input class="form-control" type="password" id="confirm_password" name="password" placeholder="********" />
                                                                        <span id='message' style="font-size: 10px; margin-top:-30; float:left"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">Pakta Integritas <span style="">(Format : jpeg,png,jpg,gif,svg|max:2048)</span> </label>
                                                                        <input class="form-control" id="pakta_integritas" type="file" accept="image/*" name="pakta_integritas" />
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label" style="float: left">Form Identitas Supplier (FIS) <span style="">(Format : jpeg,png,jpg,gif,svg|max:2048)</span> </label>
                                                                        <input class="form-control" id="fis" type="file" accept="image/*" name="fis" />
                                                                    </div>
                                                                    <button class="btn btn-success btn-lg pull-right" id="btn_save_create_user">Finish!</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3"></div>
                    <!--register area end-->
                </div>
            </div>
        </div>
    </div>
</header>
<div class="newletter-popup">
    <div id="boxes" class="newletter-container">
        <div id="dialog" class="window">
            <div id="popup2">
                <span class="b-close"><span>close</span></span>
            </div>
            <div class="box">
                <div class="newletter-title">
                    <h2>PAKTA INTEGRITAS</h2>
                </div>
                <div class="box-content newleter-content">
                    <label class="newletter-label">Download file PAKTA INTEGRITAS &amp; upload pada registrasi.</label>
                    <div id="frm_subscribe">
                        <a href={{asset('dokumen/PAKTA_INTEGRITAS.png')}} download class="btn btn-outline-success" style="background-color:red"><span style="color:white">Download File</span></a>
                    </div>
                    <!-- /#frm_subscribe -->
                </div>
                <!-- /.box-content -->
            </div>
        </div>

    </div>
    <!-- /.box -->
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.0.0.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>

<script type="text/javascript">
    var bankdigit = 15;
    //  var bankdigitBRI =15;
    //  var bankdigitMANDIRI =13;
    //  var bankdigitBCA=10;
    function bankCheck(that) {
        if (that.value == "BBRI") {
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'Apakah Benar BRI?',
                showConfirmButton: true
            });
            bankdigit = 15;
            // document.getElementById("ifBRI").style.display = "block";
            // document.getElementById("ifBCA").style.display = "none";
            // document.getElementById("ifMANDIRI").style.display = "none";
        } else if (that.value == "BMRI") {
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'Apakah Benar MANDIRI?',
                showConfirmButton: true
            });
            bankdigit = 13;
            // document.getElementById("ifMANDIRI").style.display = "block";
            // document.getElementById("ifBCA").style.display = "none";
            // document.getElementById("ifBRI").style.display = "none";
        } else if (that.value == "BBCA") {
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'Apakah Benar BCA?',
                showConfirmButton: true
            });
            bankdigit = 10;
            // document.getElementById("ifBCA").style.display = "block";
            // document.getElementById("ifMANDIRI").style.display = "none";
            // document.getElementById("ifBRI").style.display = "none";
        }
    }
    $('#nomor_rekening').keyup(function(e) {
        if ($(this).val().length >= bankdigit) {
            $(this).val($(this).val().substr(0, bankdigit));
            document.getElementById("nomor_rekening").focus();
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'Nomor Rekening harus ' + bankdigit + ' karakter. Mohon cek kembali!',
                showConfirmButton: false,
                timer: 1500
            });
            $('#errorrekening_message').html('<span class="message" style="font-size: 10px; margin-top:-30; color:green;float:left">No. Rekening Sesuai Digit <i class="fa fa-check"></i></span>').css('color', '#5cb85c');
            // Swal.fire('Info!','Panjang NPWP adalah 15 karakter','warning');
        } else if ($(this).val().length < bankdigit) {
            document.getElementById("nomor_rekening").focus();
            $('#errorrekening_message').html('<span class="message" style="font-size: 10px; margin-top:-30; color:red;float:left">No. Rekening Harus ' + bankdigit + ' Digit</span');
        }
    });
</script>
<script>
    var max_chars = 15;
    $('#jumlah_npwp').keyup(function(e) {
        if ($(this).val().length >= max_chars) {
            $(this).val($(this).val().substr(0, max_chars));
            document.getElementById("jumlah_npwp").focus();
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'No. NPWP harus 15 Digit',
                showConfirmButton: false,
                timer: 1500
            });
            $('#error_message').html('<span class="message" style="font-size: 10px; margin-top:-30; color:green;float:left">No. Npwp Sesuai Digit <i class="fa fa-check"></i></span>').css('color', '#5cb85c');
            // Swal.fire('Info!','Panjang NPWP adalah 15 karakter','warning');
        } else if ($(this).val().length < max_chars) {
            document.getElementById("jumlah_npwp").focus();
            $('#error_message').html('<span class="message" style="font-size: 10px; margin-top:-30; color:red;float:left">No. NPWP Harus 15 Digit</span');
        }
    });
</script>
<script type="text/javascript">
    function nospaces(t) {

        if (t.value.match(/\s/g)) {

            Swal.fire({
                title: 'Maaf',
                text: 'Username harus tanpa spasi',
                icon: 'warning',
                position: 'top',
                showConfirmButton: false,
                timer: 1500
            });

            t.value = t.value.replace(/\s/g, '');

        }

    }

    function nospacesemail(e) {

        if (e.value.match(/\s/g)) {

            Swal.fire({
                title: 'Maaf',
                text: 'Email harus tanpa spasi',
                icon: 'warning',
                position: 'top',
                showConfirmButton: false,
                timer: 1500
            });

            e.value = e.value.replace(/\s/g, '');

        }

    }
    var jumlah_npwp = document.getElementById('jumlah_npwp');
    var username = document.getElementById('username');
    var email = document.getElementById('email');
    var nik = document.getElementById('jumlah_ktp');

    function validasi_username() {
        var username_value = username.value;
        $.ajax({
            type: "GET",
            url: "{{route('user.cekusername')}}/" + username_value,
            async: false,
            success: function(data) {
                var record = JSON.parse(data);
                console.log(record)
                if (record != '0') {
                    Swal.fire({
                        title: 'Maaf!! , Username Sudah Digunakan',
                        text: 'Silahkan Masukan Username Lagi',
                        icon: 'warning',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.value) {
                            document.getElementById("username").focus();
                            return 'sukses';

                        }
                    })
                }
            }
        });
    }

    function validasi_email() {
        var email_value = email.value;
        $.ajax({
            type: "GET",
            url: "{{route('user.get_verifyemail')}}/" + email_value,
            async: false,
            success: function(data) {
                var record = JSON.parse(data);
                console.log(record)
                if (record != '0') {
                    Swal.fire({
                        title: 'Maaf!! , Email Sudah Terdaftar',
                        text: 'Silahkan Masukan Email Lagi',
                        icon: 'warning',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.value) {
                            document.getElementById("email").focus();
                            return 'sukses';

                        }
                    })
                }
            }
        });
    }

    function validasi_npwp() {
        var npwp_value = jumlah_npwp.value;
        $.ajax({
            type: "GET",
            url: "{{route('user.get_npwp')}}/" + npwp_value,
            async: false,
            success: function(data) {
                var record = JSON.parse(data);
                console.log(record)
                if (record != '0') {
                    Swal.fire({
                        title: 'Maaf!! , No. NPWP Sudah Terdaftar',
                        text: 'Silahkan Masukan No. NPWP Lagi',
                        icon: 'warning',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.value) {
                            document.getElementById("jumlah_npwp").focus();
                            return 'sukses';

                        }
                    })
                }
            }
        });
    }

    function validasi_nik() {
        var nik_value = nik.value;
        $.ajax({
            type: "GET",
            url: "{{route('user.get_nik')}}/" + nik_value,
            async: false,
            success: function(data) {
                var record = JSON.parse(data);
                console.log(record)
                if (record != '0') {
                    Swal.fire({
                        title: 'Maaf!! , No. NIK Sudah Terdaftar',
                        text: 'Silahkan Masukan No. NIK Lagi',
                        icon: 'warning',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.value) {
                            document.getElementById("jumlah_ktp").focus();
                            return 'sukses';

                        }
                    })
                }
            }
        });
    }
    jumlah_npwp.addEventListener('keyup', function(e) {
        validasi_npwp();
    });
    email.addEventListener('keyup', function(e) {
        validasi_email();
    });
    nik.addEventListener('keyup', function(e) {
        validasi_nik();
    });
    username.addEventListener('keyup', function(e) {
        validasi_username();
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '#btn_save_create_user', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah data yang kamu input sudah benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then(function(result) {
                if (result.value) {
                    if ($('#nama_npwp').val() == '' || $('#jumlah_npwp').val() == '' || $('#provinsi_npwp').val() == '' || $('#kabupaten_npwp').val() == '' || $('#kecamatan_npwp').val() == '' || $('#rt_npwp').val() == '' || $('#rw_npwp').val() == '' || $('#gambar_npwp').val() == '' || $('#nama_ktp').val() == '' || $('#jumlah_ktp').val() == '' || $('#provinsi_ktp').val() == '' || $('#kabupaten_ktp').val() == '' || $('#kecamatan_ktp').val() == '' || $('#rt_ktp').val() == '' || $('#rw_ktp').val() == '' || $('#gambar_ktp').val() == '' || $('#nama_bank').val() == '' || $('#nomor_rekening').val() == '' || $('#nama_penerima_bank').val() == '' || $('#cabang_bank').val() == '' || $('#nama_vendor').val() == '' || $('#nomer_hp').val() == '' || $('#email').val() == '' || $('#username').val() == '' || $('#password').val() == '' || $('#confirm_password').val() == '' || $('#pakta_integritas').val() == '' || $('#fis').val() == '') {
                        Swal.fire('Mohon Dicek Kembali!', 'Ada Data yang Harus Di isi.', 'warning')
                    } else if ($('#password').val() != $('#confirm_password').val()) {
                        Swal.fire('Gagal!', 'Password Tidak Sesuai.', 'error')

                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Proses Cek Data...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                        });
                        $('#msform').submit();

                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
    });
</script>
<script>
    $('#password, #confirm_password').on('keyup', function() {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('Password Sesuai ' + '<i class="fa fa-check"></i>').css('color', '#5cb85c');
        } else
            $('#message').html('Password Tidak Sesuai ' + '<i class="fa fa-times"></i>').css('color', 'red');
    });
    $('#nomer_hp').keyup(function(phone) {
        var tlpNode = $(this).val();
        if (tlpNode == "") {
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'No HP Harus Terisi',
                showConfirmButton: false,
                timer: 1500
            });
            //   Swal.fire('Info','No HP Harus Terisi','warning');
        } else if (validasi(tlpNode)) {
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'No HP harus Berisi angka',
                showConfirmButton: true
            });
        } else if (tlpNode.length > 12) {
            $(this).val($(this).val().substr(0, 12));
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'Anda memasukan ' + tlpNode.length + ' digit, Maksimal 12 digit',
                showConfirmButton: false,
                timer: 1500
            });
        }

        function validasi(tlp) {
            var tool = new RegExp(/[^0-9-+]/g)
            return tool.test(tlp)
        }
    });
</script>

<script>
    var max_ktp = 16;
    $('#jumlah_ktp').keyup(function(e) {
        if ($(this).val().length >= max_ktp) {
            $(this).val($(this).val().substr(0, max_ktp));
            document.getElementById("jumlah_ktp").focus();
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'Panjang KTP adalah 16 karakter',
                showConfirmButton: false,
                timer: 1500
            });
            // Swal.fire('Info!','Panjang KTP adalah 16 karakter','warning');
            $('#errornik_message').html('<span class="message" style="font-size: 10px; margin-top:-30; color:green;float:left">No. NIK Sesuai Digit <i class="fa fa-check"></i></span>').css('color', '#5cb85c');
            // Swal.fire('Info!','Panjang NPWP adalah 15 karakter','warning');
        } else if ($(this).val().length < max_ktp) {
            document.getElementById("jumlah_ktp").focus();
            $('#errornik_message').html('<span class="message" style="font-size: 10px; margin-top:-30; color:red;float:left">No. NIK Harus 16 Digit</span');
        }
    });
</script>



<script>
    //$('.select2').select2();
</script>
<script>
    $(function() {
        $.ajaxSetup({
            header: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    $(function() {
        $('#provinsi_npwp').on('change', function() {
            let id_provinsi = $('#provinsi_npwp').val();

            $.ajax({
                type: 'GET',
                url: "{{route('user.getkabupaten')}}",
                data: {
                    id_provinsi: id_provinsi
                },
                cache: false,

                success: function(msg) {
                    $('#kabupaten_npwp').html(msg);
                },
                error: function(data) {
                    console.log('error:', data)
                },

            })
        })
        $('#kabupaten_npwp').on('change', function() {
            let id_kabupaten = $('#kabupaten_npwp').val();

            $.ajax({
                type: 'GET',
                url: "{{route('user.getkecamatan')}}",
                data: {
                    id_kabupaten: id_kabupaten
                },
                cache: false,

                success: function(msg) {
                    $('#kecamatan_npwp').html(msg);
                },
                error: function(data) {
                    console.log('error:', data)
                },

            })
        })
        $('#kecamatan_npwp').on('change', function() {
            let id_kecamatan = $('#kecamatan_npwp').val();

            $.ajax({
                type: 'GET',
                url: "{{route('user.getdesa')}}",
                data: {
                    id_kecamatan: id_kecamatan
                },
                cache: false,

                success: function(msg) {
                    $('#desa_npwp').html(msg);
                },
                error: function(data) {
                    console.log('error:', data)
                },

            })
        })

        $('#provinsi_ktp').on('change', function() {
            let id_provinsi = $('#provinsi_ktp').val();

            $.ajax({
                type: 'GET',
                url: "{{route('user.getkabupaten')}}",
                data: {
                    id_provinsi: id_provinsi
                },
                cache: false,

                success: function(msg) {
                    $('#kabupaten_ktp').html(msg);
                },
                error: function(data) {
                    console.log('error:', data)
                },

            })
        })
        $('#kabupaten_ktp').on('change', function() {
            let id_kabupaten = $('#kabupaten_ktp').val();

            $.ajax({
                type: 'GET',
                url: "{{route('user.getkecamatan')}}",
                data: {
                    id_kabupaten: id_kabupaten
                },
                cache: false,

                success: function(msg) {
                    $('#kecamatan_ktp').html(msg);
                },
                error: function(data) {
                    console.log('error:', data)
                },

            })
        })
        $('#kecamatan_ktp').on('change', function() {
            let id_kecamatan = $('#kecamatan_ktp').val();

            $.ajax({
                type: 'GET',
                url: "{{route('user.getdesa')}}",
                data: {
                    id_kecamatan: id_kecamatan
                },
                cache: false,

                success: function(msg) {
                    $('#desa_ktp').html(msg);
                },
                error: function(data) {
                    console.log('error:', data)
                },

            })
        })
    });
</script>
<script>
    $(document).ready(function() {

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;

        $(".next").click(function() {


            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });
        });

        $(".previous").click(function() {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });
        });

        $(".submit").click(function() {
            return true;
        })

    });
</script>

<script>
    $(document).ready(function() {

        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

        allWells.hide();

        navListItems.click(function(e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-primary').addClass('btn-default');
                $item.addClass('btn-primary');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allNextBtn.click(function() {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='number'],input[type='file']"),
                isValid = true;

            $(".form-group").removeClass("has-error");
            for (var i = 0; i < curInputs.length; i++) {
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).closest(".form-group").addClass("has-error");
                }
            }

            if (isValid)
                nextStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-primary').trigger('click');
    });
</script>

@endsection