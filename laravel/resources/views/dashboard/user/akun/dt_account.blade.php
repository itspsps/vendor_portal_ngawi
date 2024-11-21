@extends('dashboard.user.layout.main1')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')
@include('sweetalert::alert')
<div class="account_page_bg" style=" background-image: url('public/assets_user/assets/img/slider/bg_sawah.jpg');background-size: cover;">
    <div class="container">
        <section class="main_content_area">
            <div class="account_dashboard">
                <div class="row">
                    <div class="col-sm-10 col-md-10 col-lg-10 mx-auto">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content">


                            <div class="row">
                                <div class="col-12">
                                    <div class="product_header">
                                        <div class="section_title s_title_style3">
                                            <ul class="nav" role="tablist">
                                                <li>
                                                    <a class="btn btn-outline-danger" style="background-color: #4D006E;" data-toggle="tab" href="/" role="tab" aria-controls="kediri" aria-selected="false">
                                                        <span style="color: white;">
                                                            <i class="fa fa-user"></i>&nbsp;UPDATE PROFIL
                                                        </span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container" style="border-radius: 10px; background-color: white">
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
                                                <!-- <input type="file" name="file_paktaintegritas" id="file_paktaintegritas" accept="image/*"> -->
                                                <iframe id="file_gambar_pakta" src="{{asset('img/pakta_integritas/profile_user/'.$profil->pakta_integritas)}}" style="height: 500px; width: 100%;"></iframe>
                                                <label>Gambar Form Identitas Supplier (FIS)</label></br>
                                                <!-- <input type="file" name="file_fis" id="file_fis" accept="image/*"> -->
                                                <img src="{{asset('img/fis/profile_user/'.$profil->fis)}}" width="30%" alt="">
                                        </div>
                                    </div>
                                </div>
                                <button id="btn_updateakun" class="col-lg-12 mb-3 text-center btn btn-primary">Update</button>
                                </form>
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
    $(document).on('click', '#btn_home', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
    $(document).on('click', '#btn_login', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
    $(document).on('click', '#btn_profil', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
    });
    $(document).on('click', '#btn_akun', function(e) {
        Swal.fire({
            allowOutsideClick: false,
            background: 'transparent',
            onBeforeOpen: () => {
                Swal.showLoading()
            },
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