@extends('dashboard.user.layout.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')
@include('sweetalert::alert')
<div class="account_page_bg">
    <div class="container">
        <section class="main_content_area">
            <div class="account_dashboard">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <!-- Nav tabs -->
                        <div class="container" style="background-color: white">
                            <div class="dashboard_tab_button">
                                <ul role="tablist" class="nav flex-column dashboard-list">
                                    <li><a href="#profile" data-toggle="tab" class="nav-link active show"> <i class="fa fa-user"></i> Pengaturan Profil</a></li>
                                    <li> <a href="#ktp" data-toggle="tab" class="nav-link"><i class="fa fa-id-card"></i> Pengaturan KTP</a></li>
                                    <li> <a href="#npwp" data-toggle="tab" class="nav-link"><i class="fa fa-id-card"></i> Pengaturan NPWP</a></li>
                                    <li> <a href="#orders" data-toggle="tab" class="nav-link"><i class="fa fa-money"></i> Pengaturan Bank</a></li>
                                    <li><a href="#downloads" data-toggle="tab" class="nav-link"><i class="fa fa-cogs"></i> Pusat Bantuan</a></li>
                                    <li><a href="#address" data-toggle="tab" class="nav-link "><i class="fa fa-list-ul"></i> Menu Lainnya</a></li>
                                    <li><a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link"><i class="fa fa-sign-out"></i>&nbsp;Log Out</a>
                                    </li>
                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content">



                            <div class="tab-pane active show" id="profile">
                                <h3>Profil</h3>
                                <div class="container" style="background-color: white">
                                    <div class="login">
                                        <div class="login_form_container">
                                            <div class="account_login_form">
                                                <form id="form_updateakun" action="{{ route('user.akun_update') }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <!--integrasi epicor-->
                                                    <input type="hidden" name="vendorid" value="{{$profil->vendorid}}">
                                                    <input type="hidden" name="name" value="{{$profil->name}}">
                                                    <input type="hidden" name="address1" value="{{$profil->address1}}">
                                                    <input type="hidden" name="address2" value="{{$profil->address2}}">
                                                    <input type="hidden" name="address3" value="{{$profil->address3}}">
                                                    <input type="hidden" name="city" value="{{$profil->city}}">
                                                    <input type="hidden" name="state" value="{{$profil->state}}">
                                                    <input type="hidden" name="taxpayerid" value="{{$profil->taxpayerID}}">
                                                    <input type="hidden" name="sps_namenpwp_c" value="{{$profil->SPS_NameNPWP_c}}">
                                                    <input type="hidden" name="sps_alamatnpwp_c" value="{{$profil->SPS_AlamatNPWP_c}}">
                                                    <input type="hidden" name="sps_phonenum_c" value="{{$profil->SPS_phonenum_c}}">
                                                    <input type="hidden" name="emailaddress" value="{{$profil->email}}">
                                                    <input type="hidden" name="termscode" value="{{$profil->termscode}}">
                                                    <input type="hidden" name="bankacctnumber" value="{{$profil->nomer_rekening}}">
                                                    <input type="hidden" name="bankname" value="{{$profil->BankName}}">
                                                    <input type="hidden" name="bankbranchcode" value="{{$profil->BankBranchCode}}">
                                                    <input type="hidden" name="sps_niksupplier_c" value="{{$profil->ktp}}">
                                                    <!--end integrasi epicor-->
                                                    <input type="hidden" name="id" value="{{$profil->id}}">
                                                    <label>Nama Vendor</label>
                                                    <input type="text" id="nama_vendor" class="form control" name="nama_vendor" value="{{$profil->nama_vendor}}">
                                                    <label>Badan Usaha</label>
                                                    <input type="text" id="badan_usaha" name="badan_usaha" value="{{$profil->sps_alias_c}}">
                                                    <label>Username</label>
                                                    <input type="text" id="username" onkeyup="nospaces(this)" name="username" value="{{$profil->username}}">
                                                    <label>Email</label>
                                                    <input type="email" id="email" onkeyup="nospacesemail(this)" value="{{$profil->email}}" name="email">
                                                    <label>Password</label>
                                                    <input type="text" id="password" name="password" value="{{$profil->password_show}}">
                                                    <label>No. Telp</label>
                                                    <input type="number" id="nomer_hp" value="{{$profil->nomer_hp}}" name="nomer_hp">
                                                    <label>Gambar Pakta Integritas</label></br>
                                                    <input type="file" name="file_paktaintegritas" id="file_paktaintegritas" accept="image/*">
                                                    <!-- <img src="{{asset('img/pakta_integritas/profile_user/'.$profil->pakta_integritas)}}" width="30%" alt=""></br> -->
                                                    <label>Gambar Form Identitas Supplier (FIS)</label></br>
                                                    <!-- <input type="file" name="file_fis" id="file_fis" accept="image/*"> -->
                                                    <img src="{{asset('img/fis/profile_user/'.$profil->fis)}}" width="30%" alt="">
                                                    <div class="save_button primary_btn default_button">
                                                        <button id="btn_updateakun">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="ktp">
                                <h3>KTP</h3>
                                <div class="container" style="background-color: white">
                                    <div class="login">
                                        <div class="login_form_container">
                                            <div class="account_login_form">
                                                <form id="form_updatektp" action="{{ route('user.ktp_update') }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <!--integrasi epicor-->
                                                    <input type="hidden" name="vendorid" value="{{$profil->vendorid}}">
                                                    <input type="hidden" name="name" value="{{$profil->name}}">
                                                    <input type="hidden" name="sps_alias_c" value="{{$profil->sps_alias_c}}">
                                                    <input type="hidden" name="address1" value="{{$profil->address1}}">
                                                    <input type="hidden" name="address2" value="{{$profil->address2}}">
                                                    <input type="hidden" name="address3" value="{{$profil->address3}}">
                                                    <input type="hidden" name="city" value="{{$profil->city}}">
                                                    <input type="hidden" name="state" value="{{$profil->state}}">
                                                    <input type="hidden" name="taxpayerid" value="{{$profil->taxpayerID}}">
                                                    <input type="hidden" name="sps_namenpwp_c" value="{{$profil->SPS_NameNPWP_c}}">
                                                    <input type="hidden" name="sps_alamatnpwp_c" value="{{$profil->SPS_AlamatNPWP_c}}">
                                                    <input type="hidden" name="sps_phonenum_c" value="{{$profil->SPS_phonenum_c}}">
                                                    <input type="hidden" name="emailaddress" value="{{$profil->emailaddress}}">
                                                    <input type="hidden" name="termscode" value="{{$profil->termscode}}">
                                                    <input type="hidden" name="bankname" value="{{$profil->BankName}}">
                                                    <input type="hidden" name="bankacctnumber" value="{{$profil->BankAcctNumber}}">
                                                    <input type="hidden" name="bankbranchcode" value="{{$profil->BankBranchCode}}">
                                                    <input type="hidden" name="sps_niksupplier_c" value="{{$profil->SPS_niksupplier_c}}">
                                                    <!--end integrasi epicor-->

                                                    <input type="hidden" name="id" value="{{$profil->id}}">
                                                    <label>Nama KTP</label>
                                                    <input type="text" id="nama_ktp" name="nama_ktp" value="{{$profil->nama_ktp}}">
                                                    <label>No. KTP</label>
                                                    <input type="number" id="jumlahktp" name="ktp" value="{{$profil->ktp}}">
                                                    <!--<input type="number" id="ktp" name="ktp" value="{{$profil->id_provinsiktp}}">-->
                                                    <label>Alamat KTP</label>
                                                    <select class="form-control select2" name="id_provinsiktp" required="required" id="provinsi_ktp">
                                                        <option value="">Pilih Provinsi...</option>
                                                        <?php
                                                        $prov = App\Models\Province::all();
                                                        ?>

                                                        @foreach ($prov as $provinsi)
                                                        <option value="{{$provinsi->id}}" {{($provinsi->id == $profil->id_provinsiktp) ? 'selected' : ''}}>{{$provinsi->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <br>
                                                    <?php
                                                    $kab = App\Models\Regency::Where('province_id', $profil->id_provinsiktp)->get();
                                                    // echo $kab;
                                                    ?>
                                                    <select class="form-control select2 " required="required" name="id_kabupatenktp" id="kabupaten_ktp">
                                                        <option>Pilih Kabupaten...</option>
                                                        @foreach ($kab as $kabupaten)
                                                        <option value="{{$kabupaten->id}}" {{($kabupaten->id == $profil->id_kabupatenktp) ? 'selected' : ''}}>{{$kabupaten->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <br>
                                                    <?php
                                                    $kec = App\Models\District::Where('regency_id', $profil->id_kabupatenktp)->get();
                                                    // echo $kec;
                                                    ?>
                                                    <select class="form-control select2 " required="required" name="id_kecamatanktp" id="kecamatan_ktp">
                                                        <option>Pilih Kecamatan...</option>
                                                        @foreach ($kec as $kecamatan)
                                                        <option value="{{$kecamatan->id}}" {{($kecamatan->id == $profil->id_kecamatanktp) ? 'selected' : ''}}>{{$kecamatan->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <br>
                                                    <?php
                                                    $desa = App\Models\Village::Where('district_id', $profil->id_kecamatanktp)->get();
                                                    // echo $kec;
                                                    ?>
                                                    <select class="form-control select2" name="id_desaktp" id="desa_ktp">
                                                        <option>Pilih Desa...</option>
                                                        @foreach ($desa as $desa)
                                                        <option value="{{$desa->id}}" {{($desa->id == $profil->id_desaktp) ? 'selected' : ''}}>{{$desa->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>Keterangan KTP</label>
                                                    <input type="text" name="keterangan_alamat_ktp" value="{{$profil->keterangan_alamat_ktp}}">
                                                    <label>RT KTP</label>
                                                    <input type="text" id="rt_ktp" name="rt_ktp" value="{{$profil->rt_ktp}}">
                                                    <label>RW KTP</label>
                                                    <input type="number" id="rw_ktp" value="{{$profil->rt_ktp}}" name="rw_ktp">
                                                    <label>Gambar KTP</label></br>
                                                    <input type="file" name="file_ktp" id="file_ktp" accept="image/*">
                                                    <img src="{{asset('img/ktp/profile_user/'.$profil->gambar_ktp)}}" width="30%" alt="">
                                                    <div class="save_button primary_btn default_button">
                                                        <button id="btn_updatektp">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="npwp">
                                <h3>NPWP</h3>
                                <div class="container" style="background-color: white">
                                    <div class="login">
                                        <div class="login_form_container">
                                            <div class="account_login_form">
                                                <form id="form_updatenpwp" action="{{ route('user.npwp_update') }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <!--integrasi epicor-->
                                                    <input type="hidden" name="vendorid" value="{{$profil->vendorid}}">
                                                    <input type="hidden" name="name" value="{{$profil->name}}">
                                                    <input type="hidden" name="sps_alias_c" value="{{$profil->sps_alias_c}}">
                                                    <input type="hidden" name="address1" value="{{$profil->address1}}">
                                                    <input type="hidden" name="address2" value="{{$profil->address2}}">
                                                    <input type="hidden" name="address3" value="{{$profil->address3}}">
                                                    <input type="hidden" name="city" value="{{$profil->city}}">
                                                    <input type="hidden" name="state" value="{{$profil->state}}">
                                                    <input type="hidden" name="taxpayerid" value="{{$profil->taxpayerID}}">
                                                    <input type="hidden" name="sps_namenpwp_c" value="{{$profil->SPS_NameNPWP_c}}">
                                                    <input type="hidden" name="sps_alamatnpwp_c" value="{{$profil->SPS_AlamatNPWP_c}}">
                                                    <input type="hidden" name="sps_phonenum_c" value="{{$profil->SPS_phonenum_c}}">
                                                    <input type="hidden" name="emailaddress" value="{{$profil->emailaddress}}">
                                                    <input type="hidden" name="termscode" value="{{$profil->termscode}}">
                                                    <input type="hidden" name="bankname" value="{{$profil->BankName}}">
                                                    <input type="hidden" name="bankacctnumber" value="{{$profil->BankAcctNumber}}">
                                                    <input type="hidden" name="bankbranchcode" value="{{$profil->BankBranchCode}}">
                                                    <input type="hidden" name="sps_niksupplier_c" value="{{$profil->SPS_niksupplier_c}}">
                                                    <!--end integrasi epicor-->

                                                    <input type="hidden" name="id" value="{{$npwp->id}}">
                                                    <label>Nama NPWP</label>
                                                    <input type="text" id="nama_npwp" name="nama_npwp" value="{{$npwp->nama_npwp}}">
                                                    <label>No. NPWP</label>
                                                    <input type="text" id="jumlahnpwp" name="npwp" value="{{$npwp->npwp}}">
                                                    <label>Alamat NPWP</label>
                                                    <select class="form-control select2" name="id_provinsinpwp" required="required" id="provinsi_npwp">
                                                        <option value="">Pilih Provinsi...</option>
                                                        <?php
                                                        $prov = App\Models\Province::all();
                                                        ?>
                                                        @foreach ($prov as $provinsi)
                                                        <option value="{{$provinsi->id}}" {{($provinsi->id == $profil->id_provinsinpwp) ? 'selected' : ''}}>{{$provinsi->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <br>
                                                    <?php
                                                    $kab = App\Models\Regency::Where('province_id', $profil->id_provinsinpwp)->get();
                                                    // echo $kab;
                                                    ?>
                                                    <select class="form-control select2 " required="required" name="id_kabupatennpwp" id="kabupaten_npwp">
                                                        <option>Pilih Kabupaten...</option>
                                                        @foreach ($kab as $kabupaten)
                                                        <option value="{{$kabupaten->id}}" {{($kabupaten->id == $profil->id_kabupatennpwp) ? 'selected' : ''}}>{{$kabupaten->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <br>
                                                    <?php
                                                    $kec = App\Models\District::Where('regency_id', $profil->id_kabupatennpwp)->get();
                                                    // echo $kec;
                                                    ?>
                                                    <select class="form-control select2 " required="required" name="id_kecamatannpwp" id="kecamatan_npwp">
                                                        <option>Pilih Kecamatan...</option>
                                                        @foreach ($kec as $kecamatan)
                                                        <option value="{{$kecamatan->id}}" {{($kecamatan->id == $profil->id_kecamatannpwp) ? 'selected' : ''}}>{{$kecamatan->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <br>
                                                    <?php
                                                    $desa = App\Models\Village::Where('district_id', $profil->id_kecamatannpwp)->get();
                                                    // echo $kec;
                                                    ?>
                                                    <select class="form-control select2" name="id_desanpwp" id="desa_npwp">
                                                        <option>Pilih Desa...</option>
                                                        @foreach ($desa as $desa)
                                                        <option value="{{$desa->id}}" {{($desa->id == $profil->id_desanpwp) ? 'selected' : ''}}>{{$desa->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label>Keterangan Alamat NPWP</label>
                                                    <input type="text" name="keterangan_alamat_npwp" value="{{$npwp->keterangan_alamat_npwp}}">
                                                    <label>RT NPWP</label>
                                                    <input type="number" id="rt_npwp" value="{{$npwp->rt_npwp}}" name="rt_npwp">
                                                    <label>RW NPWP</label>
                                                    <input type="number" id="rw_npwp" value="{{$npwp->rw_npwp}}" name="rw_npwp">
                                                    <label>Gambar NPWP</label></br>
                                                    <input type="file" name="file_npwp" id="file_npwp" accept="image/*">
                                                    <img src="{{asset('img/npwp/profile_user/'.$npwp->gambar_npwp)}}" width="30%" alt="">
                                                    <div class="save_button primary_btn default_button">
                                                        <button id="btn_updatenpwp">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="orders">
                                <h3>Bank</h3>
                                <div class="container" style="background-color: white">
                                    <div class="login">
                                        <div class="login_form_container">
                                            <div class="account_login_form">
                                                <form id="form_updatebank" action="{{ route('user.bank_update') }}" method="post">
                                                    @csrf
                                                    <!--integrasi epicor-->
                                                    <input type="hidden" name="vendorid" value="{{$profil->vendorid}}">
                                                    <input type="hidden" name="name" value="{{$profil->name}}">
                                                    <input type="hidden" name="sps_alias_c" value="{{$profil->sps_alias_c}}">
                                                    <input type="hidden" name="address1" value="{{$profil->address1}}">
                                                    <input type="hidden" name="address2" value="{{$profil->address2}}">
                                                    <input type="hidden" name="address3" value="{{$profil->address3}}">
                                                    <input type="hidden" name="city" value="{{$profil->city}}">
                                                    <input type="hidden" name="state" value="{{$profil->state}}">
                                                    <input type="hidden" name="taxpayerid" value="{{$profil->taxpayerID}}">
                                                    <input type="hidden" name="sps_namenpwp_c" value="{{$profil->SPS_NameNPWP_c}}">
                                                    <input type="hidden" name="sps_alamatnpwp_c" value="{{$profil->SPS_AlamatNPWP_c}}">
                                                    <input type="hidden" name="sps_phonenum_c" value="{{$profil->SPS_phonenum_c}}">
                                                    <input type="hidden" name="emailaddress" value="{{$profil->emailaddress}}">
                                                    <input type="hidden" name="termscode" value="{{$profil->termscode}}">
                                                    <input type="hidden" name="bankname" value="{{$profil->BankName}}">
                                                    <input type="hidden" name="bankacctnumber" value="{{$profil->BankAcctNumber}}">
                                                    <input type="hidden" name="bankbranchcode" value="{{$profil->BankBranchCode}}">
                                                    <input type="hidden" name="SPS_niksupplier_c" value="{{$profil->SPS_niksupplier_c}}">
                                                    <input type="hidden" name="BankBranchCode" value="{{$profil->BankBranchCode}}">
                                                    <!--end integrasi epicor-->
                                                    <input type="hidden" name="id" value="{{$bank->id}}">
                                                    <label>Nama Bank</label>
                                                    <select class="form-control select2" onchange="bankCheck(this);" name="nama_bank" id="nama_bank" required="required">
                                                        <option disabled>~Pilih BANK~</option>
                                                        <option value="BBRI" @if(old('nama_bank', $bank->nama_bank) === 'BBRI') selected @endif >BANK BRI</option>
                                                        <option value="BMRI" @if(old('nama_bank', $bank->nama_bank) === 'BMRI') selected @endif >BANK MANDIRI</option>
                                                        <option value="BBCA" @if(old('nama_bank', $bank->nama_bank) === 'BBCA') selected @endif >BANK BCA</option>
                                                    </select>
                                                    <label>Nomer Rekening</label>
                                                    <input type="text" value="{{$bank->nomer_rekening}}" id="nomer_rekening" name="nomer_rekening">
                                                    <label>Nama Penerima</label>
                                                    <input type="text" name="nama_penerima_bank" id="nama_penerima_bank" value="{{$bank->nama_penerima_bank}}">
                                                    <label>Cabang Bank</label>
                                                    <input type="text" value="{{$bank->cabang_bank}}" id="cabang_bank" name="cabang_bank">
                                                    <div class="save_button primary_btn default_button">
                                                        <button id="btn_updatebank">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="downloads">
                                <h3> Pusat Bantuan</h3>
                                <div class="container" style="background-color: white">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="faq-style-wrap" id="faq-five">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h5 class="panel-title">
                                                            <a id="octagon" class="" role="button" data-toggle="collapse" data-target="#faq-collapse1" aria-expanded="true" aria-controls="faq-collapse1">
                                                                <span class="button-faq"></span>Layanan</a>
                                                        </h5>
                                                    </div>
                                                    <div id="faq-collapse1" class="collapse show" aria-expanded="true" role="tabpanel" data-parent="#faq-five" style="">
                                                        <div class="panel-body">
                                                            <h3>Layanan Pelanggan</h3>
                                                            <p>JL. RAYA NGAWI MADIUN KM 13 TAMBAKROMO KECAMATAN GENENG KAB. NGAWI JAWA TIMUR 63271 INDONESIA</p>
                                                            <h3>Layanan Jam Kerja</h3>
                                                            <p>Senin-Jumat : 08.00-17.00</p>
                                                            <p>Sabtu : 08.00-14.00</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h5 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse2" aria-expanded="false" aria-controls="faq-collapse2">
                                                                <span class="button-faq"></span>Pusat Panggilan</a>
                                                        </h5>
                                                    </div>
                                                    <div id="faq-collapse2" class="collapse" aria-expanded="false" role="tabpanel" data-parent="#faq-five" style="">
                                                        <div class="panel-body">
                                                            <h3>Telepon </h3>
                                                            <a href="https://wa.me/628979868775" class="btn btn-success btn-sm"> <i class="fa fa-whatsapp"></i> 08979868775</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h5 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse3" aria-expanded="false" aria-controls="faq-collapse3">
                                                                <span class="button-faq"></span>Kirim Pesan</a>
                                                        </h5>
                                                    </div>
                                                    <div id="faq-collapse3" class="collapse" role="tabpanel" data-parent="#faq-five">
                                                        <div class="panel-body">
                                                            <h3>Whatsapp</h3>
                                                            <a href="https://wa.me/628979868775" class="btn btn-success btn-sm"> <i class="fa fa-whatsapp"></i> 08979868775</a>
                                                            <h3>Email</h3>
                                                            <p>it.dev.sps@gmail.com</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="address">
                                <div class="container" style="background-color: white">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="faq-style-wrap" id="faq-five">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h5 class="panel-title">
                                                            <a id="octagon" class="" role="button" data-toggle="collapse" data-target="#faq-1" aria-expanded="true" aria-controls="faq-collapse1">
                                                                <span class="button-faq"></span>Prosedur Aplikasi</a>
                                                        </h5>
                                                    </div>
                                                    <div id="faq-1" class="collapse show" aria-expanded="true" role="tabpanel" data-parent="#faq-five" style="">
                                                        <div class="panel-body">
                                                            <h3>Prosedur Aplikasi VP-NGAWI </h3>
                                                            <div class="details text-center">
                                                                <p class="file-name">Buku Panduan Penggunaan Aplikasi VP-NGAWI.pdf</p>
                                                                <img src="{{asset('pdf.png')}}" alt="File Manual Book" width="70%">
                                                                <div class="buttons">
                                                                    <button class="btn_download btn btn-info btn-sm"><i class="fa fa-download"></i> Download</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h5 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-2" aria-expanded="false" aria-controls="faq-collapse2">
                                                                <span class="button-faq"></span>Tentang Lelang</a>
                                                        </h5>
                                                    </div>
                                                    <div id="faq-2" class="collapse" aria-expanded="false" role="tabpanel" data-parent="#faq-five" style="">
                                                        <div class="panel-body">
                                                            <h3>Tetang Lelang</h3>
                                                            <p style="text-align: justify">Digunakan untuk pendaftaraan lelang oleh supplier gabah dan memantau proses lelang
                                                                yang diajukan serta mengetahui segala informasi lelang oleh supplier dengan tampilan
                                                                versi android/ mobile.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h5 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-3" aria-expanded="false" aria-controls="faq-collapse3">
                                                                <span class="button-faq"></span>Tentang VP-NGAWI</a>
                                                        </h5>
                                                    </div>
                                                    <div id="faq-3" class="collapse" role="tabpanel" data-parent="#faq-five">
                                                        <div class="panel-body">
                                                            <h3>Tentang Aplikasi</h3>
                                                            <p style="text-align: justify">Version 1.0</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-details">
                                <h3>Account details </h3>
                                <div class="login">
                                    <div class="login_form_container">
                                        <div class="account_login_form">
                                            <form action="#">
                                                <p>Already have an account? <a href="#">Log in instead!</a></p>
                                                <div class="input-radio">
                                                    <span class="custom-radio"><input type="radio" value="1" name="id_gender"> Mr.</span>
                                                    <span class="custom-radio"><input type="radio" value="1" name="id_gender"> Mrs.</span>
                                                </div> <br>
                                                <label>First Name</label>
                                                <input type="text" name="first-name">
                                                <label>Last Name</label>
                                                <input type="text" name="last-name">
                                                <label>Email</label>
                                                <input type="text" name="email-name">
                                                <label>Password</label>
                                                <input type="password" name="user-password">
                                                <label>Birthdate</label>
                                                <input type="text" placeholder="MM/DD/YYYY" value="" name="birthday">
                                                <span class="example">
                                                    (E.g.: 05/31/1970)
                                                </span>
                                                <br>
                                                <span class="custom_checkbox">
                                                    <input type="checkbox" value="1" name="optin">
                                                    <label>Receive offers from our partners</label>
                                                </span>
                                                <br>
                                                <span class="custom_checkbox">
                                                    <input type="checkbox" value="1" name="newsletter">
                                                    <label>Sign up for our newsletter<br><em>You may unsubscribe at any moment. For that purpose, please find our contact info in the legal notice.</em></label>
                                                </span>
                                                <div class="save_button primary_btn default_button">
                                                    <button type="submit">Save</button>
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
        </section>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(function() {
        $.ajaxSetup({
            header: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

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
    var max_chars = 15;
    $('#jumlahnpwp').keyup(function(e) {
        if ($(this).val().length >= max_chars) {
            $(this).val($(this).val().substr(0, max_chars));
            document.getElementById("jumlahnpwp").focus();
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'Panjang NPWP adalah 15 karakter',
                showConfirmButton: false,
                timer: 1500
            });
            // Swal.fire('Info!','Panjang NPWP adalah 15 karakter','warning');
        }
    });
    var max_ktp = 16;
    $('#jumlahktp').keyup(function(e) {
        if ($(this).val().length >= max_ktp) {
            $(this).val($(this).val().substr(0, max_ktp));
            document.getElementById("jumlahktp").focus();
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'Panjang KTP adalah 16 karakter',
                showConfirmButton: false,
                timer: 1500
            });
            // Swal.fire('Info!','Panjang KTP adalah 16 karakter','warning');
        }
    });
    $('#nomer_rekening').keyup(function(e) {
        if ($(this).val().length >= bankdigit) {
            $(this).val($(this).val().substr(0, bankdigit));
            document.getElementById("nomer_rekening").focus();
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'Nomor Rekening harus ' + bankdigit + ' karakter. Mohon cek kembali!',
                showConfirmButton: false,
                timer: 1500
            });
            // if (length !== bankdigit) {
            //     document.getElementById('nomor_rekening').value;
            //     alert('Nomor Rekening harus ' + bankdigit + ' karakter. Mohon cek kembali!');
            //     document.getElementById('nomor_rekening').focus();
        }
    });
    $(document).on('keypress', '#nomer_rekening', function(e) {
        var val = $(this).val();
        var regex = /^(\+|-)?(\d*\.?\d*)$/;
        if (regex.test(val + String.fromCharCode(e.charCode))) {
            return true;
        }
        return false;
    });
    $(function() {
        $(document).on('click', '#btn_updateakun', function(e) {
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
                    if ($('#username').val() == '' || $('#password').val() == '' || $('#nama_vendor').val() == '' || $('#email').val() == '' || $('#nomer_hp').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')
                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Proses Update Data...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                        });
                        $('#form_updateakun').submit();
                        // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#btn_updatektp', function(e) {
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
                    if ($('#nama_ktp').val() == '' || $('#jumlahktp').val() == '' || $('#rt_ktp').val() == '' || $('#rw_ktp').val() == '' || $('#provinsi_ktp').val() == '' || $('#kabupaten_ktp').val() == '' || $('#kecamatan_ktp').val() == '' || $('#desa_ktp').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Terisi Semua.', 'error')
                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Proses Update Data...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                        });
                        $('#form_updatektp').submit();

                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#btn_updatenpwp', function(e) {
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
                    if ($('#nama_npwp').val() == '' || $('#jumlahnpwp').val() == '' || $('#rt_npwp').val() == '' || $('#rw_npwp').val() == '' || $('#provinsi_npwp').val() == '' || $('#kabupaten_npwp').val() == '' || $('#kecamatan_npwp').val() == '' || $('#desa_npwp').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')
                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Proses Update Data...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                        });
                        $('#form_updatenpwp').submit();

                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#btn_updatebank', function(e) {
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
                    if ($('#nama_bank').val() == '' || $('#nomer_rekening').val() == '' || $('#nama_penerima_bank').val() == '' || $('#cabang_bank').val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')
                    } else {
                        Swal.fire({
                            title: 'Harap Tuggu Sebentar!',
                            html: 'Proses Update Data...', // add html attribute if you want or remove
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                        });
                        $('#form_updatebank').submit();

                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#btn_download', function() {
            console.log(file);
            // $('img[id=file_tagihan]').attr('src', 'https://ngawi.suryapangansemesta.store/public/dokumen/tagihan/' + file);
            PDFObject.embed("https://ngawi.suryapangansemesta.store/public/dokumen/manual_book/Buku Panduan Penggunaan Aplikasi VP-NGAWI.pdf");
        });
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
@endsection