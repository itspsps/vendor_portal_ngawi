@extends('dashboard.superadmin.layout.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <h3 class="kt-subheader__title">
                    E-PROCUREMENT
                </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="" class="kt-subheader__breadcrumbs-link">
                        SURYA PANGAN SEMESTA
                    </a>
                    <span class="btn-outline btn-sm btn-info">Site Ngawi</span>
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
                                <div class="card-title" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4">
                                    <i class="flaticon-add-circular-button"></i> Tambah Broadcast
                                </div>
                            </div>
                            <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4">
                                <div class="card-body">
                                    <form id="formaddbroadcast" action="{{ route('sourching.broadcast_store') }}" method="post" class="kt-form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-wizard-v4__form">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="kt-section__body">
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Judul Broadcast</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="text" class="form-control" id="judul_broadcast" name="judul_broadcast">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Waktu Broadcast</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="date" class="form-control" id="waktu_broadcast" name="waktu_broadcast">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Gambar Broadcast</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="file" class="form-control" id="gambar_broadcast" accept="image/*" name="gambar_broadcast">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">
                                                                        Deskripsi Broadcast</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <textarea class="form-control" id="isi_broadcast" name="isi_broadcast"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button id="btn_savebroadcast" type="submit" class="btn btn-success m-btn pull-right">Simpan</button>
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

        <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="flaticon-user"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Broadcast
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th style="text-align: center">No</th>
                                <th style="text-align: center;">Judul Broadcast</th>
                                <th style="text-align: center;">Waktu Broadcast</th>
                                <th style="text-align: center">Deskripsi Broadcast</th>
                                <th style="text-align: center">Gambar Deskripsi</th>
                                <th style="text-align: center">Action</th>
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
                    <form id="formupdatebroadcast" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('sourching.broadcast_update') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Data Broadcast</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_broadcast" id="id_broadcast" value="">
                            <div class="form-group">
                                <div class="">
                                    <label>Judul Broadcast</label>
                                    <input id="judul_broadcast_update" name="judul_broadcast_update" placeholder="" type="text" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Waktu Broadcast</label>
                                    <input id="waktu_broadcast_update" name="waktu_broadcast_update" placeholder="" type="date" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Deskripsi Broadcast</label>
                                    <input id="isi_broadcast_update" name="isi_broadcast_update" placeholder="" type="text" class="form-control m-input" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Gambar Broadcast</label>
                                    <input id="gambar_broadcast_update" name="gambar_broadcast_update" placeholder="" type="file" accept="image/*" class="form-control m-input">
                                    <img id="gambar_broadcast" width="100%">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
            ajax: "{{ route('sourching.broadcast_index') }}",
            columns: [{
                    data: "id",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'broadcast_judul'
                },
                {
                    data: 'broadcast_date'
                },
                {
                    data: 'broadcast_text'
                },
                {
                    data: 'gambar_broadcast'
                },
                {
                    data: 'ckelola'
                },

            ],
            "order": []
        });

    });


    $(document).on('click', '#btn_savebroadcast', function(e) {
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
                if ($('#judul_broadcast').val() == '' || $('#isi_broadcast').val() == '' || $('#waktu_broadcast').val() == '') {
                    Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')
                } else {
                    $('#formaddbroadcast').submit();
                    Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                }
            } else {
                Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

            }
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        $(document).on('click', '.toedit', function() {
            var id = $(this).attr("name");
            var url = "{{route('sourching.broadcast_show') }}" + "/" + id;

            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    var parsed = $.parseJSON(response);
                    var image = parsed.broadcast_file;
                    // console.log(image);
                    $('#id_broadcast').val(parsed.id_broadcast);
                    $('#judul_broadcast_update').val(parsed.broadcast_judul);
                    $('#waktu_broadcast_update').val(parsed.broadcast_date);
                    $('#isi_broadcast_update').val(parsed.broadcast_text);
                    $('img[id=gambar_broadcast]').attr('src', 'https://ngawi.suryapangansemesta.store/public/img/broadcast/' + image);
                }
            });
        });
        $('#gambar_broadcast_update').change(function() {

            let reader = new FileReader();
            // console.log(reader);
            reader.onload = (e) => {

                $('img[id=gambar_broadcast]').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });
    });
</script>
@endsection