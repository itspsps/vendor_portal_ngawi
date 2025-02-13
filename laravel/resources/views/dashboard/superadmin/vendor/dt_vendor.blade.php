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

        <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="flaticon2-group kt-font-info"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            List&nbsp;Vendor
                        </h3> &nbsp;

                    </div>
                    <div class="container">
                        <a style="float: right; margin-top:1%" href="{{route('sourching.vendor_export_excel')}}" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-file-excel"> Excel</i></a>
                        <a style="float: right; margin-top:1%" href="{{route('sourching.vendor_export_pdf')}}" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-file-pdf"> PDF</i></a>
                        <a style="float: right; margin-top:1%" href="{{route('sourching.vendor_export_csv')}}" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-file-csv"> CSV</i></a>
                        <a style="float: right; margin-top:1%" href="{{route('sourching.vendor_print')}}" target="_blank" class="btn btn-outline-success m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fas fa-print"> PRINT</i></a>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="mb-2">
                        <a href="{{route('sourching.add_vendor')}}" class="btn btn-sm btn-primary"> <i class="flaticon2-add "></i> Tambah Vendor</a>
                    </div>
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th style="text-align: center">No</th>
                                <th style="text-align: center">ID&nbsp;Vendor</th>
                                <th style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama&nbsp;Vendor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Created&nbsp;At&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center">Email&nbsp;Vendor</th>
                                <th style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Detail&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;User&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center">&nbsp;&nbsp;Action&nbsp;&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('sourching.vendor_update') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Data Vendor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <div class="">
                                    <label>Name Vendor</label>
                                    <input id="name" name="name" placeholder="" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Date Bid</label>
                                    <input id="email" name="email" placeholder="" type="" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Password</label>
                                    <input id="password" name="password" placeholder="" type="" class="form-control m-input">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success m-btn pull-right">Update</button>
                        </div>
                    </form>
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
<script>
    $(function() {
        var table = $('#datatable').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('sourching.vendor_index') }}",
            columns: [{
                    data: "id",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'vendorid'
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'created_at'
                },
                {
                    data: 'email'
                },
                {
                    data: 'detail'
                },
                {
                    data: 'status_user'
                },
                {
                    data: 'status_email'
                },
                {
                    data: 'ckelola'
                },

            ],
            createdRow: function(row, data, index) {

                if (data.vendorid == 'VD') {
                    $('td:eq(1)', row).css('background-color', '#01F9C6'); //Original Date
                }
            },
            "order": []
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        $('body').on('click', '#btn_delete', function() {
            var cek = $(this).data('id');
            console.log(cek);
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Kamu tidak dapat mengembalikan data ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "{{url('sourching/vendor_destroy')}}/" + cek,
                        type: "GET",
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Terhapus!',
                                text: 'Data anda berhasil di hapus.',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#datatable').DataTable().ajax.reload();
                        }
                    });
                } else {
                    Swal.fire("Cancelled", "Your data is safe :)", "error");
                }
            });

        });
        $('body').on('click', '#btn_nonactive', function() {
            var cek = $(this).data('id');
            console.log(cek);
            Swal.fire({
                title: 'Harap Tuggu Sebentar!',
                html: 'Proses Input Data...', // add html attribute if you want or remove
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    $.ajax({
                        url: "{{route('sourching.vendor_status')}}/" + cek,
                        type: "GET",
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data Vendor Aktif',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#datatable').DataTable().ajax.reload();
                            // Swal.fire().close()
                        }
                    });
                },
            });

        });
        $('body').on('click', '#btn_active', function() {
            var cek = $(this).data('id');
            console.log(cek);
            Swal.fire({
                title: 'Harap Tuggu Sebentar!',
                html: 'Proses Input Data...', // add html attribute if you want or remove
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                    $.ajax({
                        url: "{{route('sourching.vendor_status')}}/" + cek,
                        type: "GET",
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data Vendor Tidak Aktif',
                                icon: 'success',
                                timer: 1500
                            })
                            $('#datatable').DataTable().ajax.reload();
                            // Swal.fire().close();
                        }
                    });
                },
            });
        });
        $(document).on('click', '.toedit', function() {
            var id = $(this).attr("name");
            var url = "{{ route('sourching.vendor_show') }}" + "/" + id;

            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    var parsed = $.parseJSON(response);
                    var image = parsed.image_news;
                    $('#id').val(parsed.id);
                    $('#name').val(parsed.name);
                    $('#email').val(parsed.email);
                    $('#password').val(parsed.password_show);

                }
            });
        });
    });
</script>
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
    var max_chars = 15;
    $('#jumlah_npwp').keyup(function(e) {
        if ($(this).val().length == max_chars) {
            validasi_npwp();
            // document.getElementById("jumlah_npwp").focus();
        } else if ($(this).val().length > max_chars) {
            $(this).val($(this).val().substr(0, max_chars));
            validasi_npwp();
            // document.getElementById("jumlah_npwp").focus();

            // Swal.fire('Info!','Panjang NPWP adalah 15 karakter','warning');
        } else if ($(this).val().length < max_chars) {
            document.getElementById("jumlah_npwp").focus();
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
    var jumlah_npwp = document.getElementById('jumlah_npwp');
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
        var npwp_value = jumlah_npwp.value;
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
                            document.getElementById("jumlah_npwp").focus();
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

    function angka(e) {
        if (!/^[0-9]+$/.test(e.value)) {
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
                    if ($('#nama_npwp').val() == '' || $('#jumlah_npwp').val() == '' || $('#provinsi_npwp').val() == '' || $('#kabupaten_npwp').val() == '' || $('#kecamatan_npwp').val() == '' || $('#rt_npwp').val() == '' || $('#rw_npwp').val() == '' || $('#gambar_npwp').val() == '' || $('#nama_ktp').val() == '' || $('#jumlah_ktp').val() == '' || $('#provinsi_ktp').val() == '' || $('#kabupaten_ktp').val() == '' || $('#kecamatan_ktp').val() == '' || $('#rt_ktp').val() == '' || $('#rw_ktp').val() == '' || $('#gambar_ktp').val() == '' || $('#nama_bank').val() == '' || $('#nomor_rekening').val() == '' || $('#nama_penerima_bank').val() == '' || $('#cabang_bank').val() == '' || $('#vendor_id').val() == '' || $('#nama_vendor').val() == '' || $('#nomer_hp').val() == '' || $('#email').val() == '' || $('#username').val() == '' || $('#password').val() == '' || $('#confirm_password').val() == '' || $('#pakta_integritas').val() == '' || $('#fis').val() == '') {
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
                        $('#form_adduser').submit();

                    }
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