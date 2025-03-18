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
                <h5 class="text-primary-gradient fw-medium mb-5">TENTANG APLIKASI</h5>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative bg-light rounded pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary-gradient rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <img src="{{asset('img/bid/pp_bid.jpg')}}" class="rounded-circle" alt="" width="95%">
                        </div>
                        <div class="text-center mt-3">
                            <video width="320" height="100%" controls style="video::-webkit-media-controls-fullscreen-button {}">
                                <source src="{{asset('video_panduan.mp4')}}" type="video/mp4">
                            </video>
                        </div>
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
            PDFObject.embed("https://subang.suryapangansemesta.store/public/dokumen/manual_book/Buku Panduan Penggunaan Aplikasi VP-SUBANG.pdf");
        });

    });
</script>
@endsection