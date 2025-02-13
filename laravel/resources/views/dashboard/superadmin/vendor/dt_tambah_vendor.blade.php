@extends('dashboard.superadmin.layout.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
{{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{csrf_token()}}"> --}}
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
                <span class="btn-outline btn-sm btn-info mr-3">NGAWI</span>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Data Vendor
                    </a>
                </div>
            </div>
        </div>
    </div>


    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet ">
                <div class="">
                    <!--begin::Accordion-->
                    <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                        <div class="card">
                            <div class="card-header" id="headingOne4">
                                <div class="card-title " data-toggle="collapse" data-target="#collapseOne4" aria-expanded="true" aria-controls="collapseOne4">
                                    <i class="flaticon2-add kt-font-primary"></i> Tambah Vendor
                                </div>
                            </div>
                            <div id="collapseOne4" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample4">
                                <div class="card-body">
                                    <form class="m-form m-form--fit m-form--label-align-right" role="form" id="form_adduser" name="validasi" action="{{ route('sourching.vendor_store') }}" method="POST" enctype="multipart/form-data" id="msform">
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
                                        <div class="m-portlet__body">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active show" data-toggle="tab" href="#m_tabs_1_1">
                                                        <i class="la la-credit-card"></i> DATA NPWP
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#m_tabs_1_2">
                                                        <i class="la la-cc-discover"></i> DATA KTP
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#m_tabs_1_3">
                                                        <i class="la la-money"></i> DATA PEMBAYARAN
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#m_tabs_1_4">
                                                        <i class="la la-user"></i> DATA PROFIL
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#m_tabs_1_5">
                                                        <i class="la la-user"></i> DOKUMEN
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="m_tabs_1_1" role="tabpanel">
                                                    <div class="m-portlet__body">
                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input" class="col-12 col-form-label">Nama NPWP</label>
                                                            <div class="col-10">
                                                                <input class="form-control m-input  @error('nama_npwp') is-invalid @enderror" type="text" required="required" id="nama_npwp" name="nama_npwp" placeholder="Nama NPWP" value="{{old('nama_npwp')}}">
                                                                @error('nama_npwp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row " style="margin-top: -1%;">
                                                            <label for="example-search-input" class="col-12 col-form-label">Nomer NPWP</label>
                                                            <div class="col-10">
                                                                <input class="form-control m-input @error('npwp') is-invalid @enderror" type="text" required="required" id="npwp" name="npwp" placeholder="123*************" value="{{old('npwp')}}">
                                                                @error('npwp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <div class="col-lg-6">
                                                                <label for="id_provinsinpwp" class="form-label">Alamat NPWP</label>
                                                                <select class="form-control @error('id_provinsinpwp') is-invalid @enderror" name="id_provinsinpwp" required="required" id="provinsi_npwp">
                                                                    <option value="">Pilih Provinsi...</option>
                                                                    <?php
                                                                    $prov = App\Models\Province::all();
                                                                    $kab = App\Models\Regency::Where('province_id', old('id_provinsinpwp'))->orderBy('name', 'ASC')->get();
                                                                    $kec = App\Models\District::Where('regency_id', old('id_kabupatennpwp'))->orderBy('name', 'ASC')->get();
                                                                    $desa = App\Models\Village::Where('district_id', old('id_kecamatannpwp'))->orderBy('name', 'ASC')->get();
                                                                    ?>
                                                                    @foreach ($prov as $provinsi)
                                                                    @if(old('id_provinsinpwp') == $provinsi["id"])
                                                                    <option selected value="{{$provinsi->id}}">{{$provinsi->name}}</option>
                                                                    @else
                                                                    <option value="{{$provinsi->id}}">{{$provinsi->name}}</option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('id_provinsinpwp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                                <br>
                                                                <select class="form-control  @error('id_kabupatennpwp') is-invalid @enderror" required="required" name="id_kabupatennpwp" id="kabupaten_npwp">
                                                                    <option value="">Pilih Kabupaten...</option>
                                                                    @foreach($kab as $data)
                                                                    <option value="{{$data->id}}" {{($data->id == old('id_kabupatennpwp')) ? 'selected' : ''}}>{{$data->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('id_kabupatennpwp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                                <br>
                                                                <select class="form-control select123 @error('id_kecamatannpwp') is-invalid @enderror" required="required" name="id_kecamatannpwp" id="kecamatan_npwp">
                                                                    <option value="">Pilih Kecamatan...</option>
                                                                    @foreach($kec as $data)
                                                                    <option value="{{$data->id}}" {{($data->id == old('id_kecamatannpwp')) ? 'selected' : ''}}>{{$data->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('id_kecamatannpwp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                                <br>
                                                                <select class="form-control select123 @error('id_desanpwp') is-invalid @enderror" required="required" name="id_desanpwp" id="desa_npwp">
                                                                    <option value="">Pilih Desa...</option>
                                                                    @foreach($desa as $data)
                                                                    <option value="{{$data->id}}" {{($data->id == old('id_desanpwp')) ? 'selected' : ''}}>{{$data->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('id_desanpwp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <label for="example-email-input" class="form-label col-12">Keterangan NPWP</label>
                                                                <textarea name="keterangan_alamat_npwp" class="form-control col-lg-12 @error('keterangan_alamat_npwp') is-invalid @enderror">{{old('keterangan_alamat_npwp')}}</textarea>
                                                                <span style="font-size: 10px; margin-top:-30; color:blue;float:left">*Diisi jika nama desa tidak tercantumkan</span>
                                                                @error('keterangan_alamat_npwp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <label for="example-search-input" class="col-12 col-form-label">RT/RW</label>
                                                            <div class="col-5">
                                                                <input class="form-control m-input @error('rt_npwp') is-invalid @enderror" type="number" id="rt_npwp" name="rt_npwp" required="required" placeholder="01" value="{{old('rt_npwp')}}">
                                                                @error('rt_npwp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-5">
                                                                <input class="form-control m-input @error('rw_npwp') is-invalid @enderror" type="number" id="rw_npwp" name="rw_npwp" required="required" placeholder="01" value="{{old('rw_npwp')}}">
                                                                @error('rw_npwp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="m_tabs_1_2" role="tabpanel">
                                                    <div class="m-portlet__body">
                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input" class="col-12 col-form-label">Nama KTP</label>
                                                            <div class="col-10">
                                                                <input class="form-control m-input @error('nama_ktp') is-invalid @enderror" type="text" required="required" id="nama_ktp" name="nama_ktp" placeholder="Nama KTP" value="{{old('nama_ktp')}}">
                                                                @error('nama_ktp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <label for="example-search-input" class="col-12 col-form-label">Nomer KTP</label>
                                                            <div class="col-10">
                                                                <input class="form-control m-input @error('ktp') is-invalid @enderror" type="number" id="jumlah_ktp" required="required" name="ktp" placeholder="35*************" value="{{old('ktp')}}">
                                                                @error('ktp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $kab = App\Models\Regency::Where('province_id', old('id_provinsiktp'))->orderBy('name', 'ASC')->get();
                                                        $kec = App\Models\District::Where('regency_id', old('id_kabupatenktp'))->orderBy('name', 'ASC')->get();
                                                        $desa = App\Models\Village::Where('district_id', old('id_kecamatanktp'))->orderBy('name', 'ASC')->get();
                                                        ?>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <div class="col-lg-6">
                                                                <label for="example-email-input" class="col-12 col-form-label">Alamat KTP</label>
                                                                <select class="form-control select123 @error('id_provinsiktp') is-invalid @enderror" name="id_provinsiktp" required="required" id="provinsi_ktp">
                                                                    <option value="">Pilih Provinsi...</option>
                                                                    @foreach ($prov as $provinsi)
                                                                    @if(old('id_provinsiktp') == $provinsi["id"])
                                                                    <option selected value="{{$provinsi->id}}">{{$provinsi->name}}</option>
                                                                    @else
                                                                    <option value="{{$provinsi->id}}">{{$provinsi->name}}</option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                                @error('id_provinsiktp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                                <br>
                                                                <select class="form-control select123 @error('id_kabupatenktp') is-invalid @enderror" required="required" name="id_kabupatenktp" id="kabupaten_ktp">
                                                                    <option value="">Pilih Kabupaten...</option>
                                                                    @foreach($kab as $data)
                                                                    <option value="{{$data->id}}" {{($data->id == old('id_kabupatenktp')) ? 'selected' : ''}}>{{$data->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('id_kabupatenktp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                                <br>
                                                                <select class="form-control select123 @error('id_kecamatanktp') is-invalid @enderror" required="required" name="id_kecamatanktp" id="kecamatan_ktp">
                                                                    <option value="">Pilih Kecamatan...</option>
                                                                    @foreach($kec as $data)
                                                                    <option value="{{$data->id}}" {{($data->id == old('id_kecamatanktp')) ? 'selected' : ''}}>{{$data->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('id_kecamatanktp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                                <br>
                                                                <select class="form-control select123 @error('id_desaktp') is-invalid @enderror" required="required" name="id_desaktp" id="desa_ktp">
                                                                    <option value="">Pilih Desa...</option>
                                                                    @foreach($desa as $data)
                                                                    <option value="{{$data->id}}" {{($data->id == old('id_desaktp')) ? 'selected' : ''}}>{{$data->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('id_desaktp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-lg-6" style="margin-top: 2%;">
                                                                <label for="example-email-input" class="form-label col-12">Keterangan KTP</label>
                                                                <textarea name="keterangan_alamat_ktp" class="form-control col-lg-12"></textarea>
                                                                <span style="font-size: 10px; margin-top:-30; color:blue;float:left">*Diisi jika nama desa tidak tercantumkan</span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <label for="example-search-input" class="col-12 col-form-label">RT/RW</label>
                                                            <div class="col-5">
                                                                <input class="form-control m-input @error('rt_ktp') is-invalid @enderror" type="text" id="rt_ktp" name="rt_ktp" required="required" placeholder="RT" value="{{old('rt_ktp')}}">
                                                                @error('rt_ktp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="col-5">
                                                                <input class="form-control m-input @error('rw_ktp') is-invalid @enderror" type="text" id="rw_ktp" name="rw_ktp" required="required" placeholder="RW" value="{{old('rw_ktp')}}">
                                                                @error('rw_ktp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="m_tabs_1_3" role="tabpanel">
                                                    <div class="m-portlet__body">
                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input" class="col-12 col-form-label">Nama Bank</label>
                                                            <div class="col-10">
                                                                <select class="form-control  m-input select123 @error('nama_bank') is-invalid @enderror" onchange="bankCheck(this);" name="nama_bank" id="nama_bank" required="required">
                                                                    <option disabled selected value="">Pilih BANK</option>
                                                                    <option value="BB00100" {{(old('nama_bank') == 'BB00100') ? 'selected' : ''}}>BANK BRI</option>
                                                                    <option value="BB00200" {{(old('nama_bank') == 'BB00200') ? 'selected' : ''}}>BANK MANDIRI</option>
                                                                    <option value="BB00700" {{(old('nama_bank') == 'BB00700') ? 'selected' : ''}}>BANK BCA</option>
                                                                </select>
                                                                @error('nama_bank')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <label for="example-search-input" class="col-12 col-form-label">Nomer Rekening</label>
                                                            <div class="col-10">
                                                                <input class="form-control m-input @error('nomer_rekening') is-invalid @enderror" type="number" name="nomer_rekening" id="nomor_rekening" required="required" placeholder="123********" value="{{old('nomer_rekening')}}">
                                                                @error('nomer_rekening')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                            <div id="errorrekening_message">
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <label for="example-search-input" class="col-12 col-form-label">Nama Penerima</label>
                                                            <div class="col-10">
                                                                <input class="form-control m-input @error('nama_penerima_bank') is-invalid @enderror" type="text" id="nama_penerima_bank" name="nama_penerima_bank" required="required" placeholder="Nama Penerima" value="{{old('nama_penerima_bank')}}">
                                                                @error('nama_penerima_bank')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <label for="example-search-input" class="col-12 col-form-label">Cabang Bank</label>
                                                            <div class="col-10">
                                                                <input class="form-control m-input @error('cabang_bank') is-invalid @enderror" type="text" id="cabang_bank" name="cabang_bank" required="required" placeholder="Cabang BANK" value="{{old('cabang_bank')}}">
                                                                @error('cabang_bank')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="m_tabs_1_4" role="tabpanel">
                                                    <div class="m-portlet__body">
                                                        <!-- <div class="form-group m-form__group row">
                                                            <label for="example-text-input" class="col-12 col-form-label">ID VENDOR (EPICOR)</label>
                                                            <div class="col-10">
                                                                <input class="form-control m-input" type="text" id="vendor_id" name="vendor_id" required="required" placeholder="ID Vendor" value="">
                                                            </div>
                                                        </div> -->
                                                        <div class="form-group m-form__group row">
                                                            <label for="example-text-input" class="col-12 col-form-label">Nama Vendor</label>
                                                            <div class="col-10">
                                                                <input class="form-control m-input @error('nama_vendor') is-invalid @enderror" type="text" id="nama_vendor" name="nama_vendor" required="required" placeholder="Nama Vendor" value="{{old('nama_vendor')}}">
                                                                @error('nama_vendor')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <label for="example-search-input" class="col-12 col-form-label">No. Telp</label>
                                                            <div class="col-10">
                                                                <input class="form-control m-input @error('nomer_hp') is-invalid @enderror" type="text" id="nomer_hp" name="nomer_hp" placeholder="+62***********" value="{{old('nomer_hp')}}">
                                                                @error('nomer_hp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <label for="example-search-input" class="col-12 col-form-label">Username</label>
                                                            <div class="col-10">
                                                                <input class="form-control m-input @error('username') is-invalid @enderror" type="text" id="username" name="username" onkeyup="nospaces(this)" required="required" placeholder="Username" value="{{old('username')}}">
                                                                <div class="error_message_username">
                                                                    @error('username')
                                                                    <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <label for="example-search-input" class="col-12 col-form-label">Email Vendor</label>
                                                            <div class="col-10">
                                                                <input class="form-control m-input @error('email') is-invalid @enderror" type="email" id="email" name="email" onkeyup="nospacesemail(this)" required="required" placeholder="example@gmail.com" value="{{old('email')}}">
                                                                <div class="error_message_email">
                                                                    @error('email')
                                                                    <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <label for="example-search-input" class="col-12 col-form-label">Badan usaha</label>
                                                            <div class="col-10">
                                                                <input class="form-control m-input @error('badan_usaha') is-invalid @enderror" type="text" id="badan_usaha" name="badan_usaha" required="required" placeholder="UD." value="{{old('badan_usaha')}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <label for="example-search-input" class="col-12 col-form-label">Password</label>
                                                            <div class="col-10">
                                                                <input class="form-control m-input @error('password') is-invalid @enderror" type="password" id="password" name="password" required="required" placeholder="********" value="{{old('password')}}">
                                                                @error('password')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <label for="example-search-input" class="col-12 col-form-label">Konfirmasi&nbsp;Password</label>
                                                            <div class="col-10">
                                                                <input class="form-control m-input @error('password') is-invalid @enderror" type="password" id="confirm_password" name="password" required="required" placeholder="********" value="{{old('password')}}">
                                                                <div class="message_password">
                                                                    @error('password')
                                                                    <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                    @enderror
                                                                    <!-- <span id='message_password' style="font-size: 10px; margin-top:-30; float:left"></span> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="m_tabs_1_5" role="tabpanel">
                                                    <div class="m-portlet__body">
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <label for="example-password-input" class="col-12 col-form-label">Upload NPWP</label>
                                                            <div class="col-10">
                                                                <input class="form-control @error('gambar_npwp') is-invalid @enderror" type="file" id="gambar_npwp" name="gambar_npwp" accept="image/*" value="{{old('gambar_npwp')}}">
                                                                <span class="btn btn-label-info btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>*Pastikan npwp terlihat jelas di foto</span>
                                                                @error('gambar_npwp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <label for="example-password-input" class="col-12 col-form-label">Upload KTP</label>
                                                            <div class="col-10">
                                                                <input class="form-control m-input @error('gambar_ktp') is-invalid @enderror" type="file" id="gambar_ktp" name="gambar_ktp" accept="image/*" required>
                                                                <span class="btn btn-label-info btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>*Pastikan KTP tierlihat jelas di foto</span>
                                                                @error('gambar_ktp')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <label for="example-password-input" class="col-12 col-form-label">Pakta Integritas <span style="">(Format : PDF)</span></label>
                                                            <div class="col-10">
                                                                <input class="form-control md-input @error('pakta_integritas') is-invalid @enderror" type="file" accept="application/pdf" id="pakta_integritas" name="pakta_integritas" required="required">
                                                                <span class="btn btn-label-info btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>*Pastikan Pakta Integritas tierlihat jelas di foto</span>
                                                                @error('pakta_integritas')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" style="margin-top: -1%;">
                                                            <label for="example-password-input " class="col-12 col-form-label">Pakta Integritas <span style="">(Format : jpeg,png,jpg,gif,svg|max:2048)</span></label>
                                                            <div class="col-10">
                                                                <input class="form-control md-input @error('fis') is-invalid @enderror" type="file" accept="image/*" id="fis" name="fis" required="required">
                                                                <span class="btn btn-label-info btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>*Pastikan FIS tierlihat jelas di foto</span>
                                                                @error('fis')
                                                                <span class="btn btn-label-danger btn-sm" style="font-weight: bold;"><i class="flaticon2-information"></i>{{$message}}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <button type="submit" id="btn_save" class="btn btn-success m-btn mb-3 pull-right"><i class="flaticon2-telegram-logo"></i>&nbsp;SIMPAN</button>
                                                    </div>
                                                </div>
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

    </div>

    <!-- end:: Content -->
</div>
@endsection
@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(function() {
        $('.selectpicker').selectpicker();
    });
</script>

<script type="text/javascript">
    function space(str, after) {
        if (!str) {
            return false;
        }
        after = after || 4;
        var v = str.replace(/[^\dA-Z]/g, ''),
            reg = new RegExp(".{" + after + "}", "g");
        return v.replace(reg, function(a) {
            return a + ' ';
        });
    }

    var el = document.getElementById('npwp');
    el.addEventListener('keyup', function() {
        this.value = space(this.value, 4);
    });

    var old_value_bank = "{{old('nama_bank')}}";
    if (old_value_bank == 'BB00700') {
        bankdigit = 10;
    } else if (old_value_bank == 'BB00100') {
        bankdigit = 15;
    } else {
        bankdigit = 13;
    }

    //  var bankdigitBRI =15;
    //  var bankdigitMANDIRI =13;
    //  var bankdigitBCA=10;
    function bankCheck(that) {
        if (that.value == "BB00100") {
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
        } else if (that.value == "BB00200") {
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
        } else if (that.value == "BB00700") {
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
    var max_chars = 19;
    $('#npwp').keyup(function(e) {
        if ($(this).val().length == max_chars) {
            validasi_npwp();
            // document.getElementById("npwp").focus();
        } else if ($(this).val().length > max_chars) {
            $(this).val($(this).val().substr(0, max_chars));
            validasi_npwp();
            // document.getElementById("npwp").focus();

            // Swal.fire('Info!','Panjang NPWP adalah 15 karakter','warning');
        } else if ($(this).val().length < max_chars) {
            document.getElementById("npwp").focus();
            $('.error_message').empty();
            $('.error_message').append('<button type="button" class="btn btn-label-danger btn-sm btn-bold"><i class="flaticon2-information"></i>&nbsp;NPWP Harus 15 Digit</button>');
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
    var npwp = document.getElementById('npwp');
    var username = document.getElementById('username');
    var email = document.getElementById('email');
    var nik = document.getElementById('jumlah_ktp');
    var typingTimer; //timer identifier
    var doneTypingInterval = 2000;

    function validasi_username() {
        var username_value = username.value;

        $.ajax({
            type: "GET",
            url: "{{route('sourching.cekusername')}}/" + username_value,
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
                            $('.error_message_username').empty();
                            $('.error_message_username').append('<button type="button" class="btn btn-label-danger btn-sm btn-bold"><i class="flaticon2-information"></i>&nbsp;Username Sudah Terdaftar</button>');
                            return 'sukses';

                        }
                    })
                } else {
                    $('.error_message_username').empty();
                    $('.error_message_username').append('<button type="button" class="btn btn-label-success btn-sm btn-bold"><i class="flaticon2-check-mark"></i>&nbsp;Username Sesuai</button>');
                }
            }
        });
    }

    function validasi_email() {
        var email_value = email.value;
        $.ajax({
            type: "GET",
            url: "{{route('sourching.get_verifyemail')}}/" + email_value,
            async: false,
            success: function(data) {
                var record = JSON.parse(data);
                console.log(record)
                if (record != '0') {
                    Swal.fire({
                        title: 'Maaf!! , Email Sudah Terdaftar',
                        text: 'Silahkan Masukan Email lainya Lagi',
                        icon: 'warning',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.value) {
                            document.getElementById("email").focus();
                            $('.error_message_email').empty();
                            $('.error_message_email').append('<button type="button" class="btn btn-label-danger btn-sm btn-bold"><i class="flaticon2-information"></i>&nbsp;Email Sudah Terdaftar</button>');
                            return 'sukses';

                        }
                    })
                } else {
                    $('.error_message_email').empty();
                    $('.error_message_email').append('<button type="button" class="btn btn-label-success btn-sm btn-bold"><i class="flaticon2-check-mark"></i>&nbsp;Email Sesuai</button>');
                }
            }
        });
    }

    function validasi_npwp() {
        var npwp_value = npwp.value;
        // console.log(npwp_value);
        $.ajax({
            type: "GET",
            url: "{{route('sourching.get_npwp')}}/" + npwp_value,
            async: false,
            success: function(data) {
                var record = JSON.parse(data);
                console.log(record)
                if (record != '0') {
                    Swal.fire({
                        title: 'Maaf!!  No. NPWP Sudah Terdaftar',
                        text: 'Silahkan Masukan No. NPWP Lagi',
                        icon: 'warning',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.value) {
                            document.getElementById("npwp").focus();
                            $('.error_message').empty();
                            $('.error_message').append('<button type="button" class="btn btn-label-danger btn-sm btn-bold"><i class="flaticon2-information"></i>&nbsp;NPWP Sudah Terdaftar</button>');
                            return 'sukses';

                        }
                    })
                } else {

                    $('.error_message').empty();
                    $('.error_message').append('<button type="button" class="btn btn-label-success btn-sm btn-bold"><i class="flaticon2-check-mark"></i>&nbsp;NPWP Benar</button>');
                }
            }
        });
    }

    function validasi_nik() {
        var nik_value = nik.value;
        $.ajax({
            type: "GET",
            url: "{{route('sourching.get_nik')}}/" + nik_value,
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
                            $('.error_message_ktp').empty();
                            $('.error_message_ktp').append('<button type="button" class="btn btn-label-danger btn-sm btn-bold"><i class="flaticon2-information"></i>&nbsp;NIK Sudah Terdaftar</button>');
                            return 'sukses';

                        }
                    })
                } else {

                    $('.error_message_ktp').empty();
                    $('.error_message_ktp').append('<button type="button" class="btn btn-label-success btn-sm btn-bold"><i class="flaticon2-check-mark"></i>&nbsp;NIK Benar</button>');
                }
            }
        });
    }

    // if (/^[\d ]*$/.test(e.value)) {
    function angka(e) {
        if (/^[0-9]+$/.test(e.value)) {
            e.value = e.value.substring(0, e.value.length - 1);
        }
    }
    username.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(validasi_username, doneTypingInterval);
    });
    email.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(validasi_email, doneTypingInterval);
    });
</script>
<script>
    $('#password, #confirm_password').on('keyup', function() {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('.message_password').empty();
            $('.message_password').append('<button type="button" class="btn btn-label-success btn-sm btn-bold"><i class="flaticon2-check-mark"></i>&nbsp;Password Sesuai</button>');
        } else {
            $('.message_password').empty();
            $('.message_password').append('<button type="button" class="btn btn-label-danger btn-sm btn-bold"><i class="flaticon2-information"></i>&nbsp;Password Tidak Sesuai</button>');
        }

    });
    $('#nomer_hp').keyup(function(phone) {
        var tlpNode = $(this).val();
        if (validasi(tlpNode)) {
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
        if ($(this).val().length > max_ktp) {
            $(this).val($(this).val().substr(0, max_ktp));
            document.getElementById("jumlah_ktp").focus();
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'Panjang KTP adalah 16 karakter',
                showConfirmButton: false,
                timer: 1500
            });
            validasi_nik();
            // Swal.fire('Info!','Panjang NPWP adalah 15 karakter','warning');
        } else if ($(this).val().length == max_ktp) {
            validasi_nik();
        } else if ($(this).val().length < max_ktp) {
            document.getElementById("jumlah_ktp").focus();
            $('.error_message_ktp').empty();
            $('.error_message_ktp').append('<button type="button" class="btn btn-label-danger btn-sm btn-bold"><i class="flaticon2-information"></i>&nbsp;NIK harus 16 Digit</button>');
        }
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '#btn_save', function(e) {
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

                    Swal.fire({
                        title: 'Harap Tuggu Sebentar!',
                        html: 'Proses Cek Data...', // add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });
                    $('#form_adduser').submit();

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
    });
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
                url: "{{route('sourching.getkabupaten')}}",
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
                url: "{{route('sourching.getkecamatan')}}",
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
                url: "{{route('sourching.getdesa')}}",
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
                url: "{{route('sourching.getkabupaten')}}",
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
                url: "{{route('sourching.getkecamatan')}}",
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
                url: "{{route('sourching.getdesa')}}",
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
@endsection