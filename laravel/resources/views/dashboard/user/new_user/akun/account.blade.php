@extends('dashboard.user.new_user.layouts.main')

@section('content')
<div class="container-xxl bg-white p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 1rem; height: 1rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-primary" style="width: 1rem; height: 1rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-grow text-primary" style="width: 1rem; height: 1rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    @include('dashboard.user.new_user.layouts.header')



    <!-- Features Start -->
    <div class="container-xxl py-5" id="feature" style="margin-top: -40%;">
        <div class="container py-5 px-lg-5">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h5 class="text-primary-gradient fw-medium mb-5">PROFILE</h5>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <i class="bi bi-person-circle fa-3x text-white"></i>
                        </div>
                        <form id="form_profile" method="POST" action="{{route('user.new_akun_update')}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$profil->id}}">
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
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nama_vendor" name="nama_vendor" placeholder="Nama" value="{{$profil->nama_vendor}}">
                                        <label for="name">Nama</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="badan_usaha" name="badan_usaha" placeholder="Badan Usaha" value="{{$profil->sps_alias_c}}">
                                        <label for="badan_usaha">Badan Usaha</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="username" onkeyup="nospaces(this)" name="username" placeholder="Username" value="{{$profil->username}}">
                                        <label for="username">Username</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" onkeyup="nospacesemail(this)" id="email" name="email" placeholder="Email" value="{{$profil->email}}">
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="{{$profil->password_show}}">
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="nomer_hp" name="nomer_hp" placeholder="Password" value="{{$profil->nomer_hp}}">
                                        <label for="nomer_hp">No. Telepon</label>
                                    </div>
                                </div>
                                <div class="col-12" style="text-align: left;">
                                    <label>Pakta Integritas</label>
                                    <br>
                                    <a href="{{asset('img/pakta_integritas/profile_user/'.$profil->pakta_integritas)}}" target="_blank" class="btn btn-sm btn-primary-gradient"><i class="bi bi-file-earmark-arrow-down"></i>&nbsp;Download</a>
                                    <br>
                                    <br>
                                    <label>FIS (Form Identitas Supplier)</label>
                                    <br>
                                    <a data-bs-toggle="offcanvas" href="#offcanvas_lihat_fis" role="button" aria-controls="offcanvas_lihat_fis" class="btn btn-sm btn-primary-gradient text-white"><i class="bi bi-eye"></i>&nbsp;Lihat</a>
                                </div>

                                <div class="col-12 text-center">
                                    <button id="btn_updateakun" class="btn btn-sm btn-primary-gradient rounded-pill py-2 px-3" type="button">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvas_lihat_fis" aria-labelledby="offcanvasExampleLabel1" style="height:auto !important; border-radius: 10px 10px 0px 0px; box-shadow: 16px 16px 16px 13px #000; margin: 0; position: fixed;">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasExampleLabel1">FORM IDENTITAS SUPPLIER</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="text-ccenter">
                        @if($profil->fis==''||$profil->fis==NULL)
                        <p>Tidak Ada File FIS</p>
                        @else
                        <img src="{{asset('img/fis/profile_user/'.$profil->fis)}}" width="100%" alt="">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->


    @include('dashboard.user.new_user.layouts.menu')
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $(document).on('click', '#btn_klik', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            html: ' <div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div>',
            showCancelButton: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                // Swal.showLoading()
            },
        });
    });
    window.onbeforeunload = function() {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            html: ' <div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div>',
            showCancelButton: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                // Swal.showLoading()
            },
        });
    };

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
                            html: ' <div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div>',
                            showCancelButton: false,
                            showConfirmButton: false,
                            onBeforeOpen: () => {
                                // Swal.showLoading()
                            },
                        });
                        $('#form_profile').submit();
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
                            html: ' <div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div><div class="spinner-grow text-primary spinner-grow-sm me-2" role="status"></div>',
                            showCancelButton: false,
                            showConfirmButton: false,
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
            // $('img[id=file_tagihan]').attr('src', 'https://subang.suryapangansemesta.store/public/dokumen/tagihan/' + file);
            PDFObject.embed("https://ngawi.suryapangansemesta.store/public/dokumen/manual_book/Buku Panduan Penggunaan Aplikasi VP-NGAWI.pdf");
        });

    });
</script>
@endsection