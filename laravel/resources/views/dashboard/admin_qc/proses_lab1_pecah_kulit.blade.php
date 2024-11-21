@extends('dashboard.admin_qc.layout.main')
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
                <span class="kt-subheader__separator kt-text"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        SURYA PANGAN SEMESTA
                    </a>
                    <span class="btn-outline btn-sm btn-info">Site Ngawi</span>
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
                            <i class="kt-menu__link-icon    flaticon2-laptop kt-font-warning"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Lab 1 Pecah Kulit
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%">No</th>
                                <th style="text-align: center;width:auto">Waktu&nbsp;Sampai</th>
                                <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                <th style="text-align: center;width:auto">Tanggal&nbsp;PO</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Nama&nbsp;Supplier&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;Asal&nbsp;</th>
                                <th style="text-align: center;width:auto">Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="m-form m-form--fit m-form--label-align-right">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Data Lab</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="">
                                    <h1>The data has been entered</h1>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="m-form m-form--fit m-form--label-align-right">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Lab Results</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="">
                                    <h1 id="lokasi_bongkar"></h1>
                                </div>
                                <div class="">
                                    <h1 id="antrian_bongkar"></h1>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="formantrian_qc" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('qc.lab.save_proseslab1_pecah_kulit') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Proses Lab 1 Pecah Kulit</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <!--ID-->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" id="lab1_id_data_po_pk" name="lab1_id_data_po_pk">
                            <input type="hidden" id="lab1_id_penerimaan_po_pk" name="lab1_id_penerimaan_po_pk">
                            <input type="hidden" id="lab1_id_bid_user_pk" name="lab1_id_bid_user_pk">
                            <input type="hidden" id="tanggal_po_pk" name="tanggal_po_pk">
                            <input type="hidden" id="waktu_penerimaan_pk" name="waktu_penerimaan_pk">
                            <input type="hidden" id="date_bid_pk" name="date_bid_pk">

                            {{-- tambahan input --}}
                            <!--<label>presentase</label>-->
                            <input type="hidden" id="presentase_hampa_pk" name="presentase_hampa_pk">
                            <input type="hidden" id="presentase_pk_bersih_pk" name="presentase_pk_bersih_pk">
                            <input type="hidden" id="presentase_katul_pk" name="presentase_katul_pk">
                            <input type="hidden" id="presentase_beras_pk" name="presentase_beras_pk">
                            <input type="hidden" id="presentase_butir_patah_pk" name="presentase_butir_patah_pk">
                            <input type="hidden" id="presentase_butir_patah_beras_pk" name="presentase_butir_patah_beras_pk">
                            <input type="hidden" id="presentase_butir_patah_beras_adjust_pk" name="presentase_butir_patah_beras_adjust_pk">
                            <input type="hidden" id="refraksi_ka_pk" name="refraksi_ka_pk">
                            <input type="hidden" id="refraksi_hampa_pk" name="refraksi_hampa_pk">
                            <input type="hidden" id="refraksi_katul_pk" name="refraksi_katul_pk">
                            <input type="hidden" id="refraksi_tr_pk" name="refraksi_tr_pk">
                            <input type="hidden" id="refraksi_butir_patah_pk" name="refraksi_butir_patah_pk">
                            <input type="hidden" id="reward_hampa_pk" name="reward_hampa_pk">
                            <input type="hidden" id="reward_katul_pk" name="reward_katul_pk">
                            <input type="hidden" id="reward_tr_pk" name="reward_tr_pk">
                            <input type="hidden" id="reward_butir_patah_pk" name="reward_butir_patah_pk">
                            <input type="hidden" id="plan_kualitas_pk" name="plan_kualitas_pk">
                            <input type="hidden" id="harga_atas_pk" name="harga_atas_pk">
                            <input type="hidden" id="harga_incoming_pk" name="harga_incoming_pk">
                            <input type="hidden" id="plan_harga_aktual_pk" name="plan_harga_aktual_pk">
                            <input type="hidden" id="aktual_kualitas_pk" name="aktual_kualitas_pk">
                            <input type="hidden" id="harga_awal_pk" name="harga_awal_pk">
                            <input type="hidden" id="aksi_harga_pk" name="aksi_harga_pk">
                            <input type="hidden" id="reaksi_harga_pk" name="reaksi_harga_pk">
                            <div id="tbl_refraksi_success" class="alert alert-success alert-dismissible fade show">
                                <strong><i class="fa fa-check-circle"></i></strong>&nbsp;Parameter Lab Refraksi Terisi.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                            </div>
                            <div id="tbl_refraksi_error" class="alert alert-danger alert-dismissible fade show">
                                <strong><i class="fa fa-exclamation-circle"></i></strong>&nbsp;Parameter Lab Refraksi Kosong.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                            </div>
                            <div id="tbl_reward_success" class="alert alert-success alert-dismissible fade show">
                                <strong><i class="fa fa-check-circle"></i></strong>&nbsp;Parameter Lab Reward Terisi.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                            </div>
                            <div id="tbl_reward_error" class="alert alert-danger alert-dismissible fade show">
                                <strong><i class="fa fa-exclamation-circle"></i></strong>&nbsp;Parameter Lab Reward Kosong.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                            </div>
                            <div id="tbl_kualitas_success" class="alert alert-success alert-dismissible fade show">
                                <strong><i class="fa fa-check-circle"></i></strong>&nbsp;Parameter Lab Kualitas Terisi.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                            </div>
                            <div id="tbl_kualitas_error" class="alert alert-danger alert-dismissible fade show">
                                <strong><i class="fa fa-exclamation-circle"></i></strong>&nbsp;Parameter Lab Kualitas Kosong.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                            </div>
                            <div id="tbl_harga_atas_success" class="alert alert-success alert-dismissible fade show">
                                <strong><i class="fa fa-check-circle"></i></strong>&nbsp;Harga Atas Terisi.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                            </div>
                            <div id="tbl_harga_atas_error" class="alert alert-danger alert-dismissible fade show">
                                <strong><i class="fa fa-exclamation-circle"></i></strong>&nbsp;Harga Atas Kosong.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Kode PO</label>
                                    <input type="text" id="lab1_kode_po_pk" name="lab1_kode_po_pk" class="form-control m-input" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Nopol</label>
                                    <input type="text" id="lab1_plat_pk" readonly name="lab1_plat_pk" class="form-control m-input">
                                </div>
                            </div>
                            <div id="parameter_ka_pk" class="form-group"></div>
                            <div id="parameter_hampa_pk" class="form-group"></div>
                            <div id="parameter_katul_pk" class="form-group"></div>
                            <div id="parameter_tr_pk" class="form-group"></div>
                            <div id="parameter_butir_patah_pk" class="form-group"></div>
                            <div id="parameter_reward_kadar_air_pk" class="form-group"></div>
                            <div id="parameter_reward_hampa_pk" class="form-group"></div>
                            <div id="parameter_reward_katul_pk" class="form-group"></div>
                            <div id="parameter_reward_tr_pk" class="form-group"></div>
                            <div id="parameter_reward_butir_patah_pk" class="form-group"></div>
                            <div id="parameter_lab_pk_kualitas" class="form-group"></div>
                            {{-- edit form --}}
                            <div class="m-form__group form-group">
                                <label for="">KA (%)</label>
                                <input type="text" step="any" required name="ka_pk" id="ka_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">PK</label>
                                <input type="text" step="any" required name="pk_pk" id="pk_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">PK Bersih</label>
                                <input type="text" step="any" required name="pk_bersih_pk" id="pk_bersih_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Beras</label>
                                <input type="text" step="any" required name="beras_pk" id="beras_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Butir Patah</label>
                                <input type="text" step="any" required name="butir_patah_pk" id="butir_patah_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Hampa</label>
                                <input type="text" step="any" readonly required name="hampa_pk" id="hampa_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Katul</label>
                                <input type="text" step="any" readonly required name="katul_pk" id="katul_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">WH (%)</label>
                                <input type="text" step="any" required name="wh_pk" id="wh_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">TR (%)</label>
                                <input type="text" step="any" required name="tr_pk" id="tr_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">MD</label>
                                <input type="text" step="any" required name="md_pk" id="md_pk" class="form-control m-input" value="">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Status Lab</label>
                                <select class="form-select form-control m-input" id="keterangan_lab_1_pk" required name="output_lab_pk" aria-label="Default select example">
                                    <option value="">--Hasil Lab 1--</option>
                                    <option name="output_lab_pk" value="Unload">Bongkar</option>
                                    <option name="output_lab_pk" value="Pending">Pending</option>
                                    <option name="output_lab_pk" value="Reject">Tolak</option>
                                </select>
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Keterangan</label>
                                <input type="text" step="any" required name="keterangan_lab_pk" id="keterangan_lab_pk" class="form-control m-input">
                            </div>
                            <div class="m-form__group form-group">
                                <label for="">Plan Harga (Kg)</label>
                                <input readonly type="text" disabled step="any" required name="harga_akhir_pk" id="harga_akhir_pk" class="form-control m-input">
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button id="btn_save" class="btn btn-success m-btn pull-right">Save</button>
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
<script type="text/javascript">
    function yesnoCheck(that) {
        if (that.value == "Unload") {
            Swal.fire({
                position: 'top',
                icon: 'warning',
                title: 'Input Lokasi Bongkar',
                showConfirmButton: true
            });
            document.getElementById("ifYes").style.display = "block";
        } else {
            document.getElementById("ifYes").style.display = "none";
        }
    }
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
            ajax: "{{ route('qc.lab.proses_lab1_pecah_kulit_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'waktu_penerimaan'
                },
                {
                    data: 'kode_po'
                },
                {
                    data: 'tanggal_po'
                },
                {
                    data: 'nama_vendor'
                },
                {
                    data: 'plat_kendaraan'
                },
                {
                    data: 'keterangan_penerimaan_po'
                },
                {
                    data: 'ckelola'
                }

            ],
            "order": []
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('keypress', '#ka_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#pk_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#pk_bersih_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#beras_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#butir_patah', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#wh_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#tr_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });
        $(document).on('keypress', '#md_pk', function(e) {
            var val = $(this).val();
            var regex = /^(\+|-)?(\d*\.?\d*)$/;
            if (regex.test(val + String.fromCharCode(e.charCode))) {
                return true;
            }
            return false;
        });

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
                    if ($('#ka_pk').val() == '' | $('#pk_pk').val() == '' | $('#pk_bersih_pk').val() == '' | $('#beras_pk').val() == '' | $('#butir_patah').val() == '' | $('#wh_pk').val() == '' | $('#tr_pk').val() == '' | $('#md_pk').val() == '' | $('#keterangan_lab_1_pk').find(":selected").val() == '') {
                        Swal.fire('Gagal!', 'Data Harus Diisi.', 'error')
                    } else if ($('#harga_akhir_pk').val() == '' | $('#harga_akhir_pk').val() == '0') {
                        Swal.fire('Mohon Dicek!', 'Harga Atas, Parameter LAB PK Tidak Boleh Kosong', 'warning')
                    } else {
                        $('#formantrian_qc').submit();
                        Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#btn_notif', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Informasi',
                icon: 'warning',
                text: "Selesaikan Dahulu Di Output Lab 1",
                position: top
            })
        });
        $(document).on('click', '#btn_notif2', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Informasi',
                icon: 'warning',
                text: "Urut Sesuai Dengan Waktu Sampai",
                position: top
            })
        });
        $(document).on('click', '.proses_lab_1', function() {
            var id = $(this).attr("name");
            var tanggal_po = $(this).data('tanggalpo');
            // console.log(tanggal_po);
            var url = "{{ route('qc.lab.gabah_incoming_qc') }}" + "/" + id;
            var url2 = "{{route('qc.lab.get_parameter_lab_pk_kadar_air') }}" + "/" + tanggal_po;
            var url3 = "{{route('qc.lab.get_parameter_lab_pk_hampa') }}" + "/" + tanggal_po;
            var url4 = "{{route('qc.lab.get_parameter_lab_pk_katul') }}" + "/" + tanggal_po;
            var url5 = "{{route('qc.lab.get_parameter_lab_pk_tr') }}" + "/" + tanggal_po;
            var url6 = "{{route('qc.lab.get_parameter_lab_pk_butiran_patah') }}" + "/" + tanggal_po;
            var url7 = "{{route('qc.lab.get_parameter_lab_pk_kualitas') }}" + "/" + tanggal_po;
            var url8 = "{{route('get_price_top_pecah_kulit') }}" + "/" + id;
            var url9 = "{{route('qc.lab.get_parameter_lab_pk_reward_hampa') }}" + "/" + tanggal_po;
            var url10 = "{{route('qc.lab.get_parameter_lab_pk_reward_tr') }}" + "/" + tanggal_po;
            var url11 = "{{route('qc.lab.get_parameter_lab_pk_reward_katul') }}" + "/" + tanggal_po;
            var url12 = "{{route('qc.lab.get_parameter_lab_pk_reward_butir_patah') }}" + "/" + tanggal_po;
            var url13 = "{{route('qc.lab.get_parameter_lab_pk_reward_kadar_air') }}" + "/" + tanggal_po;
            var url14 = "{{route('qc.lab.get_parameter_lab_pk_tabel_refraksi') }}" + "/" + tanggal_po;
            var url15 = "{{route('qc.lab.get_parameter_lab_pk_tabel_reward') }}" + "/" + tanggal_po;
            var url16 = "{{route('qc.lab.get_parameter_lab_pk_tabel_kualitas') }}" + "/" + tanggal_po;
            $('#formantrian_qc').trigger('reset');
            //   $('#modal2').removeData();
            $('#modal2').on('hidden.bs.modal', function(e) {
                $('#parameter_ka_pk').empty();
                $('#parameter_hampa_pk').empty();
                $('#parameter_katul_pk').empty();
                $('#parameter_tr_pk').empty();
                $('#parameter_butir_patah_pk').empty();
                $('#parameter_reward_kadar_air_pk').empty();
                $('#parameter_reward_hampa_pk').empty();
                $('#parameter_reward_katul_pk').empty();
                $('#parameter_reward_tr_pk').empty();
                $('#parameter_reward_butir_patah_pk').empty();
                $('#parameter_lab_pk_kualitas').empty();
            })
            $('#modal2').modal('show');
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#lab1_id_penerimaan_po_pk').val(parsed.id_penerimaan_po);
                    $('#lab1_kode_po_pk').val(parsed.penerimaan_kode_po);
                    $('#lab1_id_data_po_pk').val(parsed.penerimaan_id_data_po);
                    $('#lab1_id_bid_user_pk').val(parsed.penerimaan_id_bid_user);
                    $('#lab1_plat_pk').val(parsed.plat_kendaraan);
                    $('#tanggal_po_pk').val(parsed.tanggal_po);
                    $('#date_bid_pk').val(parsed.date_bid);
                    $('#waktu_penerimaan_pk').val(parsed.waktu_penerimaan);
                    $('#min_tp_pk').val(parsed.min_tp_pk);
                    $('#max_tp_pk').val(parsed.max_tp_pk);
                    $('#harga_hpp_pk').val(parsed.harga);
                    // if ($('#harga_akhir_pk').val() == '0') {
                    //     $('#btn_save').attr('disabled', 'true'); // updated according to http://stackoverflow.com/questions/7637790/how-to-remove-disabled-attribute-with-jquery-ie
                    // } else {
                    //     $('#btn_save').attr('disabled', 'false'); // updated according to http://stackoverflow.com/questions/7637790/how-to-remove-disabled-attribute-with-jquery-ie
                    // }
                    // console.log(parsed.bid_user_id);
                }
            });
            $.ajax({
                type: "GET",
                url: url14,
                success: function(response) {
                    var parsed = JSON.parse(response);
                    console.log(parsed);
                    if (parsed == '16') {
                        document.getElementById('tbl_refraksi_error').style.display = 'none';
                        document.getElementById('tbl_refraksi_success').style.display = 'block';
                    } else {
                        document.getElementById('tbl_refraksi_error').style.display = 'block';
                        document.getElementById('tbl_refraksi_success').style.display = 'none';
                    }
                }
            });
            $.ajax({
                type: "GET",
                url: url15,
                success: function(response) {
                    var parsed = JSON.parse(response);
                    console.log(parsed);
                    if (parsed == '5') {
                        document.getElementById('tbl_reward_error').style.display = 'none';
                        document.getElementById('tbl_reward_success').style.display = 'block';
                    } else {
                        document.getElementById('tbl_reward_error').style.display = 'block';
                        document.getElementById('tbl_reward_success').style.display = 'none';
                    }
                }
            });
            $.ajax({
                type: "GET",
                url: url7,
                success: function(response) {
                    var my_orders = $('#parameter_lab_pk_kualitas')
                    var parsed = JSON.parse(response);
                    console.log(parsed);
                    if (parsed.length == '4') {
                        document.getElementById('tbl_kualitas_error').style.display = 'none';
                        document.getElementById('tbl_kualitas_success').style.display = 'block';
                        $.each(parsed, function(item) {
                            my_orders.append("<input type=" + 'text' + " class=" + 'parameter_lab_pk_kualitas' + " value=" + parsed[item].min_parameter_lab_pk_tr_kualitas + '#' + parsed[item].max_parameter_lab_pk_tr_kualitas + '#' + parsed[item].min_parameter_lab_pk_butirpatah_kualitas + '#' + parsed[item].max_parameter_lab_pk_butirpatah_kualitas + '#' + parsed[item].kualitas_parameter_lab_pk + ">");
                        });
                    } else {
                        document.getElementById('tbl_kualitas_error').style.display = 'block';
                        document.getElementById('tbl_kualitas_success').style.display = 'none';
                    }
                }
            });
            $.ajax({
                type: "GET",
                url: url2,
                success: function(response) {
                    var my_orders = $('#parameter_ka_pk')
                    var parsed = JSON.parse(response);
                    // console.log(parsed);
                    $.each(parsed, function(item) {
                        my_orders.append("<input type=" + 'text' + " class=" + 'parameter_ka_pk' + " value=" + parsed[item].min_ka_parameter_lab_pk_ka + '#' + parsed[item].max_ka_parameter_lab_pk_ka + '#' + parsed[item].harga_parameter_lab_pk_ka + ">");
                    });
                }
            });
            $.ajax({
                type: "GET",
                url: url3,
                success: function(response) {
                    var my_orders = $('#parameter_hampa_pk')
                    var parsed = JSON.parse(response);
                    // console.log(parsed);
                    $.each(parsed, function(item) {
                        my_orders.append("<input type=" + 'text' + " class=" + 'parameter_hampa_pk' + " value=" + parsed[item].min_parameter_lab_pk_hampa + '#' + parsed[item].max_parameter_lab_pk_hampa + '#' + parsed[item].harga_parameter_lab_pk_hampa + ">");
                    });
                }
            });
            $.ajax({
                type: "GET",
                url: url4,
                success: function(response) {
                    var my_orders = $('#parameter_katul_pk')
                    var parsed = JSON.parse(response);
                    // console.log(parsed);
                    $.each(parsed, function(item) {
                        my_orders.append("<input type=" + 'text' + " class=" + 'parameter_katul_pk' + " value=" + parsed[item].min_parameter_lab_pk_katul + '#' + parsed[item].max_parameter_lab_pk_katul + '#' + parsed[item].harga_parameter_lab_pk_katul + ">");
                    });
                }
            });
            $.ajax({
                type: "GET",
                url: url5,
                success: function(response) {
                    var my_orders = $('#parameter_tr_pk')
                    var parsed = JSON.parse(response);
                    // console.log(parsed);
                    $.each(parsed, function(item) {
                        my_orders.append("<input type=" + 'text' + " class=" + 'parameter_tr_pk' + " value=" + parsed[item].min_parameter_lab_pk_tr + '#' + parsed[item].max_parameter_lab_pk_tr + '#' + parsed[item].harga_parameter_lab_pk_tr + ">");
                    });
                }
            });
            $.ajax({
                type: "GET",
                url: url6,
                success: function(response) {
                    var my_orders = $('#parameter_butir_patah_pk')
                    var parsed = JSON.parse(response);
                    // console.log(parsed);
                    $.each(parsed, function(item) {
                        my_orders.append("<input type=" + 'text' + " class=" + 'parameter_butir_patah_pk' + " value=" + parsed[item].min_parameter_lab_pk_butiran_patah + '#' + parsed[item].max_parameter_lab_pk_butiran_patah + '#' + parsed[item].harga_parameter_lab_pk_butiran_patah + ">");
                    });
                }
            });
            $.ajax({
                type: "GET",
                url: url8,
                success: function(response) {
                    var parsed = $.parseJSON(response);
                    if (parsed == '' | parsed == null) {
                        document.getElementById('tbl_harga_atas_error').style.display = 'block';
                        document.getElementById('tbl_harga_atas_success').style.display = 'none';
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'SPV Belum input HARGA ATAS Sesuai Tanggal PO : ' + tanggal_po,
                            icon: 'warning',
                            allowOutsideClick: false
                        })
                    } else {
                        document.getElementById('tbl_harga_atas_error').style.display = 'none';
                        document.getElementById('tbl_harga_atas_success').style.display = 'block';
                        $('#harga_atas_pk').val(parsed.harga_atas_pk);
                    }
                }
            });
            $.ajax({
                type: "GET",
                url: url9,
                success: function(response) {
                    var my_orders = $('#parameter_reward_hampa_pk')
                    var parsed = JSON.parse(response);
                    console.log(parsed);
                    $.each(parsed, function(item) {
                        my_orders.append("<input type=" + 'text' + " class=" + 'parameter_reward_hampa_pk' + " value=" + parsed[item].value_parameter_lab_pk_reward_hampa + '#' + parsed[item].reward_parameter_lab_pk_reward_hampa + ">");
                    });
                }
            });
            $.ajax({
                type: "GET",
                url: url10,
                success: function(response) {
                    var my_orders = $('#parameter_reward_tr_pk')
                    var parsed = JSON.parse(response);
                    console.log(parsed);
                    $.each(parsed, function(item) {
                        my_orders.append("<input type=" + 'text' + " class=" + 'parameter_reward_tr_pk' + " value=" + parsed[item].value_parameter_lab_pk_reward_tr + '#' + parsed[item].reward_parameter_lab_pk_reward_tr + ">");
                    });
                }
            });
            $.ajax({
                type: "GET",
                url: url11,
                success: function(response) {
                    var my_orders = $('#parameter_reward_katul_pk')
                    var parsed = JSON.parse(response);
                    console.log(parsed);
                    $.each(parsed, function(item) {
                        my_orders.append("<input type=" + 'text' + " class=" + 'parameter_reward_katul_pk' + " value=" + parsed[item].value_parameter_lab_pk_reward_katul + '#' + parsed[item].reward_parameter_lab_pk_reward_katul + ">");
                    });
                }
            });
            $.ajax({
                type: "GET",
                url: url12,
                success: function(response) {
                    var my_orders = $('#parameter_reward_butir_patah_pk')
                    var parsed = JSON.parse(response);
                    console.log(parsed);
                    $.each(parsed, function(item) {
                        my_orders.append("<input type=" + 'text' + " class=" + 'parameter_reward_butir_patah_pk' + " value=" + parsed[item].value_parameter_lab_pk_reward_butir_patah + '#' + parsed[item].reward_parameter_lab_pk_reward_butir_patah + ">");
                    });
                }
            });
            $.ajax({
                type: "GET",
                url: url13,
                success: function(response) {
                    var my_orders = $('#parameter_reward_kadar_air_pk')
                    var parsed = JSON.parse(response);
                    console.log(parsed);
                    $.each(parsed, function(item) {
                        my_orders.append("<input type=" + 'text' + " class=" + 'parameter_reward_kadar_air_pk' + " value=" + parsed[item].value_parameter_lab_pk_reward_kadar_air + '#' + parsed[item].reward_parameter_lab_pk_reward_kadar_air + ">");
                    });
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(function() {

        $(document).on('click', '.lokasi_bongkar', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.lab.lokasi_bongkar') }}" + "/" + id;
            // console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    // console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#lokasi_bongkar_gb').text("Gudang = " + parsed.lokasi_bongkar);
                    $('#antrian_bongkar_gb').text("Antrian = " + parsed.antrian);
                }
            });
        });
    });
</script>
<script>
    var get_id_penerimaan = document.getElementById('lab1_id_penerimaan_po_pk');

    var ka_pk = document.getElementById('ka_pk');
    var pk_pk = document.getElementById('pk_pk');
    var pk_bersih_pk = document.getElementById('pk_bersih_pk');
    var beras_pk = document.getElementById('beras_pk');
    var butir_patah_pk = document.getElementById('butir_patah_pk');
    var hampa_pk = document.getElementById('hampa_pk');
    var katul_pk = document.getElementById('katul_pk');
    var wh_pk = document.getElementById('wh_pk');
    var tr_pk = document.getElementById('tr_pk');
    var md_pk = document.getElementById('md_pk');
    // hidden
    var presentase_hampa_pk = document.getElementById('presentase_hampa_pk');
    var presentase_pk_bersih_pk = document.getElementById('presentase_pk_bersih_pk');
    var presentase_katul_pk = document.getElementById('presentase_katul_pk');
    var presentase_beras_pk = document.getElementById('presentase_beras_pk');
    var presentase_butir_patah_pk = document.getElementById('presentase_butir_patah_pk');
    var presentase_butir_patah_beras_pk = document.getElementById('presentase_butir_patah_beras_pk');
    var presentase_butir_patah_beras_adjust_pk = document.getElementById('presentase_butir_patah_beras_adjust_pk');
    var refraksi_ka_pk = document.getElementById('refraksi_ka_pk');
    var refraksi_hampa_pk = document.getElementById('refraksi_hampa_pk');
    var refraksi_katul_pk = document.getElementById('refraksi_katul_pk');
    var refraksi_tr_pk = document.getElementById('refraksi_tr_pk');
    var refraksi_butir_patah_pk = document.getElementById('refraksi_butir_patah_pk');
    var reward_hampa_pk = document.getElementById('reward_hampa_pk');
    var reward_katul_pk = document.getElementById('reward_katul_pk');
    var reward_tr_pk = document.getElementById('reward_tr_pk');
    var reward_butir_patah_pk = document.getElementById('reward_butir_patah_pk');
    var plan_kualitas_pk = document.getElementById('plan_kualitas_pk');
    var harga_atas_pk = document.getElementById('harga_atas_pk');
    var harga_incoming_pk = document.getElementById('harga_incoming_pk');
    var plan_harga_aktual_pk = document.getElementById('plan_harga_aktual_pk');
    var aktual_kualitas_pk = document.getElementById('aktual_kualitas_pk');
    var harga_awal_pk = document.getElementById('harga_awal_pk');
    var aksi_harga_pk = document.getElementById('aksi_harga_pk');
    var reaksi_harga_pk = document.getElementById('reaksi_harga_pk');
    var harga_akhir_pk = document.getElementById('harga_akhir_pk');
    var keterangan_pk = document.getElementById('keterangan_pk');
    var tanggal_po_pk = document.getElementById('tanggal_po_pk');


    var plan_harga = document.getElementById('plan_harga_pk');

    function hasilhampakatul() {
        hasil_hampa_pk = parseFloat(pk_pk.value) - parseFloat(pk_bersih_pk.value);
        hasil_katul_pk = parseFloat(pk_bersih_pk.value) - parseFloat(beras_pk.value);
        hampa_pk.value = round(hasil_hampa_pk, 2);
        katul_pk.value = round(hasil_katul_pk, 2);
        console.log(hasil_katul_pk);

    }

    function rumus() {
        var hasil = "0";
        var par = '3';
        if (ka_pk.value == 0 || ka_pk.value == '' ||
            pk_pk.value == 0 || pk_pk.value == '' ||
            pk_bersih_pk.value == 0 || pk_bersih_pk.value == '' ||
            beras_pk.value == 0 || beras_pk.value == '' ||
            butir_patah_pk.value == 0 || butir_patah_pk.value == '' ||
            wh_pk.value == 0 || wh_pk.value == '' ||
            tr_pk.value == 0 || tr_pk.value == '' ||
            md_pk.value == 0 || md_pk.value == '') {
            harga_akhir_pk.value = "0";

        } else {
            // Presentase
            hasil_presentase_hampa_pk = hampa_pk.value / parseFloat(pk_pk.value) * 100;
            presentase_hampa_pk.value = round(hasil_presentase_hampa_pk, 2);

            hasil_presentase_pk_bersih_pk = (pk_bersih_pk.value / pk_pk.value) * 100;
            presentase_pk_bersih_pk.value = round(hasil_presentase_pk_bersih_pk, 2);

            hasil_presentase_katul_pk = (katul_pk.value / pk_pk.value) * 100;
            presentase_katul_pk.value = round(hasil_presentase_katul_pk, 1);

            hasil_presentase_beras_pk = (beras_pk.value / pk_pk.value) * 100;
            presentase_beras_pk.value = round(hasil_presentase_beras_pk, 1);

            hasil_presentase_butir_patah_pk = (butir_patah_pk.value / pk_pk.value) * 100;
            presentase_butir_patah_pk.value = round(hasil_presentase_butir_patah_pk, 1);

            hasil_presentase_butir_patah_beras_pk = (butir_patah_pk.value / beras_pk.value) * 100;
            presentase_butir_patah_beras_pk.value = round(hasil_presentase_butir_patah_beras_pk, 1);

            hasil_presentase_butir_patah_beras_adjust_pk = parseFloat(presentase_butir_patah_beras_pk.value) + parseInt(3.0)
            presentase_butir_patah_beras_adjust_pk.value = round(hasil_presentase_butir_patah_beras_adjust_pk, 1);

            // Refraksi
            var elems = document.querySelectorAll(".parameter_ka_pk");
            var elems1 = document.querySelectorAll(".parameter_hampa_pk");
            var elems2 = document.querySelectorAll(".parameter_katul_pk");
            var elems3 = document.querySelectorAll(".parameter_tr_pk");
            var elems4 = document.querySelectorAll(".parameter_butir_patah_pk");
            var elems5 = document.querySelectorAll(".parameter_lab_pk_kualitas");
            var elems6 = document.querySelectorAll(".parameter_reward_hampa_pk");
            var elems7 = document.querySelectorAll(".parameter_reward_katul_pk");
            var elems8 = document.querySelectorAll(".parameter_reward_tr_pk");
            var elems9 = document.querySelectorAll(".parameter_reward_butir_patah_pk");

            var std_hpp_incoming = 0;
            // get parameter lab Kadar Air PK
            [].forEach.call(elems, function(el) {
                var params_ka = el.value;
                // console.log(plan_hpp);
                arr_ka = params_ka.split("#");
                // console.log(arr_ka[2]);
                if (ka_pk.value >= arr_ka[0] && ka_pk.value <= arr_ka[1]) {
                    if (arr_ka[2] == '0') {
                        std_ka_pk = '0'
                    } else if (arr_ka[2] == 'TOLAK') {
                        std_ka_pk = 'TOLAK'
                    } else {
                        std_ka_pk = round((parseFloat(ka_pk.value) - parseFloat(arr_ka[0])) * parseInt(arr_ka[2]));
                    }
                    // console.log(parseFloat(std_ka_pk));
                } else if (ka_pk.value >= arr_ka[1]) {
                    std_ka_pk = "TOLAK";

                }


            });
            // get parameter lab Hampa PK
            [].forEach.call(elems1, function(el1) {
                var params_hampa = el1.value;
                // console.log(plan_hpp);
                arr_hampa = params_hampa.split("#");
                if (presentase_hampa_pk.value >= arr_hampa[0] && presentase_hampa_pk.value <= arr_hampa[1]) {
                    std_hampa_pk = arr_hampa[2];
                    console.log(arr_hampa[2]);
                    if (arr_hampa[2] == '0') {
                        std_hampa_pk = '0'
                    } else {
                        std_hampa_pk = round((parseFloat(presentase_hampa_pk.value) - parseFloat(arr_hampa[0])) * parseInt(arr_hampa[2]));
                        // console.log(parseFloat(std_hampa_pk));
                    }
                    // console.log(parseFloat(std_hampa_pk));
                } else if (presentase_hampa_pk.value >= arr_hampa[1]) {
                    std_hampa_pk = "TOLAK";

                }
                // console.log(std_hampa_pk);


            });
            // get parameter lab Katul PK
            [].forEach.call(elems2, function(el1) {
                var params_katul = el1.value;
                // console.log(plan_hpp);
                arr_katul = params_katul.split("#");
                if (presentase_katul_pk.value >= arr_katul[0] && presentase_katul_pk.value <= arr_katul[1]) {
                    std_katul_pk = arr_katul[2];
                    // console.log(arr_katul[2]);
                    if (arr_katul[2] == '0') {
                        std_katul_pk = '0'
                    } else {
                        std_hampa_pk = round((parseFloat(presentase_katul_pk.value) - parseFloat(arr_katul[0])) * parseInt(arr_katul[2]));
                        // console.log(parseFloat(std_katul_pk));
                    }
                    // console.log(parseFloat(std_katul_pk));
                } else if (presentase_katul_pk.value >= arr_katul[1]) {
                    std_katul_pk = "TOLAK";

                }
                // console.log(std_katul_pk);


            });
            // get parameter lab TR PK
            [].forEach.call(elems3, function(el1) {
                var params_tr = el1.value;
                // console.log(plan_hpp);
                arr_tr = params_tr.split("#");
                if (tr_pk.value >= arr_tr[0] && tr_pk.value <= arr_tr[1]) {
                    std_tr_pk = arr_tr[2];
                    console.log(arr_tr[2]);

                    console.log(parseFloat(std_tr_pk));
                } else if (tr_pk.value >= arr_tr[1]) {
                    std_tr_pk = "0";

                }
                console.log(std_tr_pk);


            });
            // get parameter lab Butir Patah PK
            [].forEach.call(elems4, function(el1) {
                var params_butiran_patah = el1.value;
                // console.log(plan_hpp);
                arr_butiran_patah = params_butiran_patah.split("#");
                if (presentase_butir_patah_beras_adjust_pk.value > arr_butiran_patah[0] && presentase_butir_patah_beras_adjust_pk.value <= arr_butiran_patah[1]) {
                    std_butiran_patah_pk = arr_butiran_patah[2];
                    console.log(std_butiran_patah_pk);
                    if (arr_butiran_patah[2] == '0') {
                        std_butiran_patah_pk = '0'
                    } else if (arr_butiran_patah[2] == 'TOLAK') {
                        std_butiran_patah_pk = 'TOLAK'
                    } else {
                        std_butiran_patah_pk = round((parseFloat(presentase_butir_patah_beras_adjust_pk.value) - parseFloat(arr_butiran_patah[0])) * parseFloat(arr_butiran_patah[2]), 1);

                    }
                } else if (presentase_butir_patah_beras_adjust_pk.value >= arr_butiran_patah[1]) {
                    std_butiran_patah_pk = arr_butiran_patah[2];
                }
            });
            // Reward Hampa
            [].forEach.call(elems6, function(el1) {
                var params_reward_hampa = el1.value;
                // console.log(plan_hpp);
                arr_reward_hampa = params_reward_hampa.split("#");
                if (presentase_hampa_pk.value < arr_reward_hampa[0]) {
                    std_reward_hampa_pk = round((parseFloat(arr_reward_hampa[0]) - parseFloat(presentase_hampa_pk.value)) * arr_reward_hampa[1], 1);
                } else {
                    std_reward_hampa_pk = 0;
                }
            });
            // Reward Katul
            [].forEach.call(elems7, function(el1) {
                var params_reward_katul = el1.value;
                // console.log(plan_hpp);
                arr_reward_katul = params_reward_katul.split("#");
                if (presentase_katul_pk.value < arr_reward_katul[0]) {
                    std_reward_katul_pk = round((arr_reward_katul[0] - presentase_katul_pk.value) * arr_reward_katul[1], 1);
                } else {
                    std_reward_katul_pk = 0;
                }
            });
            // Reward TR
            [].forEach.call(elems8, function(el1) {
                var params_reward_tr = el1.value;
                // console.log(plan_hpp);
                arr_reward_katul = params_reward_tr.split("#");
                if (tr_pk.value >= arr_reward_katul[0]) {
                    std_reward_tr_pk = arr_reward_katul[1];
                } else {
                    std_reward_tr_pk = 0;
                }
            });
            // Reward Butir Patah
            [].forEach.call(elems9, function(el1) {
                var params_reward_butir_patah = el1.value;
                // console.log(plan_hpp);
                arr_reward_butir_patah = params_reward_butir_patah.split("#");
                if (parseFloat(presentase_butir_patah_beras_pk.value) < arr_reward_butir_patah[0]) {
                    std_reward_butir_patah_pk = round((arr_reward_butir_patah[0] - presentase_butir_patah_beras_pk.value) * arr_reward_butir_patah[1], 1);
                } else {
                    std_reward_butir_patah_pk = 0;
                }
            });
            // get parameter lab Kualitas PK
            [].forEach.call(elems5, function(el1) {
                var params_kualitas = el1.value;
                arr_kualitas = params_kualitas.split("#");
                if (presentase_butir_patah_beras_adjust_pk.value >= arr_kualitas[2] && presentase_butir_patah_beras_adjust_pk.value <= arr_kualitas[3]) {
                    std_kualitas_pk = arr_kualitas[4];
                }
            });
            $.ajax({
                type: "GET",
                url: "{{route('get_count_refraksi_ka')}}" + "/" + get_id_penerimaan.value,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    console.log(record);
                    if (record == '0') {
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'SPV Belum input Parameter Kadar Air Sesuai Tanggal PO :' + tanggal_po_pk.value,
                            icon: 'warning',
                            allowOutsideClick: false
                        })
                    } else {
                        refraksi_ka_pk.value = std_ka_pk;

                    }
                }
            });
            $.ajax({
                type: "GET",
                url: "{{route('get_count_refraksi_hampa')}}" + "/" + get_id_penerimaan.value,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    if (record == '0') {
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'SPV Belum input Parameter Hampa Sesuai Tanggal PO :' + tanggal_po_pk.value,
                            icon: 'warning',
                            allowOutsideClick: false
                        })
                    } else {

                        refraksi_hampa_pk.value = std_hampa_pk;
                    }
                }
            });
            $.ajax({
                type: "GET",
                url: "{{route('get_count_refraksi_katul')}}" + "/" + get_id_penerimaan.value,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    if (record == '0') {
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'SPV Belum input Parameter Katul Sesuai Tanggal PO :' + tanggal_po_pk.value,
                            icon: 'warning',
                            allowOutsideClick: false
                        })
                    } else {
                        refraksi_katul_pk.value = std_katul_pk;

                    }
                }
            });
            $.ajax({
                type: "GET",
                url: "{{route('get_count_refraksi_tr')}}" + "/" + get_id_penerimaan.value,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    if (record == '0') {
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'SPV Belum input Parameter TR Sesuai Tanggal PO :' + tanggal_po_pk.value,
                            icon: 'warning',
                            allowOutsideClick: false
                        })
                    } else {
                        refraksi_tr_pk.value = std_tr_pk;

                    }
                }
            });
            $.ajax({
                type: "GET",
                url: "{{route('get_count_refraksi_butiran_patah')}}" + "/" + get_id_penerimaan.value,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    if (record == '0') {
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'SPV Belum input Parameter Butir Patah Sesuai Tanggal PO :' + tanggal_po_pk.value,
                            icon: 'warning',
                            allowOutsideClick: false
                        })
                    } else {
                        refraksi_butir_patah_pk.value = std_butiran_patah_pk;

                    }
                }
            });

            // Reward
            $.ajax({
                type: "GET",
                url: "{{route('get_count_reward_hampa')}}" + "/" + get_id_penerimaan.value,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    if (record == '0') {
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'SPV Belum input Parameter Reward Hampa Sesuai Tanggal PO :' + tanggal_po_pk.value,
                            icon: 'warning',
                            allowOutsideClick: false
                        })
                    } else {

                        reward_hampa_pk.value = std_reward_hampa_pk;
                    }
                }
            });
            $.ajax({
                type: "GET",
                url: "{{route('get_count_reward_katul')}}" + "/" + get_id_penerimaan.value,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    if (record == '0') {
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'SPV Belum input Parameter Reward Katul Sesuai Tanggal PO :' + tanggal_po_pk.value,
                            icon: 'warning',
                            allowOutsideClick: false
                        })
                    } else {
                        reward_katul_pk.value = std_reward_katul_pk;

                    }
                }
            });
            $.ajax({
                type: "GET",
                url: "{{route('get_count_reward_tr')}}" + "/" + get_id_penerimaan.value,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    if (record == '0') {
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'SPV Belum input Parameter Reward TR Sesuai Tanggal PO :' + tanggal_po_pk.value,
                            icon: 'warning',
                            allowOutsideClick: false
                        })
                    } else {
                        reward_tr_pk.value = std_reward_tr_pk;

                    }
                }
            });
            $.ajax({
                type: "GET",
                url: "{{route('get_count_reward_butir_patah')}}" + "/" + get_id_penerimaan.value,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    if (record == '0') {
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'SPV Belum input Parameter Reward Butir Patah Sesuai Tanggal PO :' + tanggal_po_pk.value,
                            icon: 'warning',
                            allowOutsideClick: false
                        })
                    } else {

                        reward_butir_patah_pk.value = std_reward_butir_patah_pk;
                    }
                }
            });

            // Kualitas
            $.ajax({
                type: "GET",
                url: "{{route('get_count_lab_kualitas')}}" + "/" + get_id_penerimaan.value,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    if (record == '0') {
                        Swal.fire({
                            title: 'Maaf, Anda Tidak Bisa Input',
                            text: 'SPV Belum input Parameter Kualitas Sesuai Tanggal PO :' + tanggal_po_pk.value,
                            icon: 'warning',
                            allowOutsideClick: false
                        })
                    } else {
                        plan_kualitas_pk.value = std_kualitas_pk;

                    }
                }
            });

            // harga Incoming
            var hasil_harga_incoming_pk = 0;
            if (refraksi_ka_pk.value == 'TOLAK' || refraksi_hampa_pk.value == 'TOLAK' || refraksi_katul_pk.value == 'TOLAK' || refraksi_tr_pk.value == 'TOLAK' || refraksi_butir_patah_pk.value == 'TOLAK') {
                harga_incoming_pk.value = 'TOLAK'
            } else {
                params_reward = (parseFloat(reward_hampa_pk.value) + parseFloat(reward_katul_pk.value) + parseFloat(reward_tr_pk.value) + parseFloat(reward_butir_patah_pk.value));
                params_refraksi = (parseFloat(refraksi_ka_pk.value) + parseFloat(refraksi_hampa_pk.value) + parseFloat(refraksi_katul_pk.value) + parseFloat(refraksi_katul_pk.value) + parseFloat(refraksi_butir_patah_pk.value));
                hasil_harga_incoming_pk = parseInt(harga_atas_pk.value) + parseFloat(params_reward - params_refraksi);
                harga_incoming_pk.value = parseInt(hasil_harga_incoming_pk);
            }
            // Plan Harga Aktual
            var hasil_harga_aktual_pk = 0;
            if (refraksi_ka_pk.value == 'TOLAK' || refraksi_hampa_pk.value == 'TOLAK' || refraksi_katul_pk.value == 'TOLAK' || refraksi_tr_pk.value == 'TOLAK' || refraksi_butir_patah_pk.value == 'TOLAK') {
                plan_harga_aktual_pk.value = 'TOLAK'
            } else {
                params_reward = (parseFloat(reward_hampa_pk.value) + parseFloat(reward_katul_pk.value) + parseFloat(reward_tr_pk.value) + parseFloat(reward_butir_patah_pk.value));
                params_refraksi = (parseFloat(refraksi_ka_pk.value) + parseFloat(refraksi_hampa_pk.value) + parseFloat(refraksi_katul_pk.value) + parseFloat(refraksi_katul_pk.value) + parseFloat(refraksi_butir_patah_pk.value));
                hasil_harga_aktual_pk = parseInt(harga_atas_pk.value) + parseFloat(params_reward - params_refraksi);

                plan_harga_aktual_pk.value = cariaktual(hasil_harga_aktual_pk);
            }
            aktual_kualitas_pk.value = plan_kualitas_pk.value;

            if (plan_harga_aktual_pk.value == 'TOLAK') {
                harga_awal_pk.value = 'TOLAK'
            } else if (plan_harga_aktual_pk.value >= harga_atas_pk.value) {
                harga_awal_pk.value = harga_atas_pk.value;

            } else {
                harga_awal_pk.value = plan_harga_aktual_pk.value;

            }
            harga_akhir_pk.value = harga_awal_pk.value;
            console.log(hasil);
            if (harga_akhir_pk.value == 0 || harga_akhir_pk.value == '') {
                harga_akhir_pk.value = "0";
                console.log("harga 0");
            } else if (harga_akhir_pk.value == 'TOLAK') {
                console.log("TOLAK");
                $('#output_lab_pk > option[value="Reject"]').prop('selected', true);
                $('#output_lab_pk > option[value="Pending"]').attr('selected', false);
                $('#output_lab_pk > option[value="Unload"]').attr('selected', false);
                $('#output_lab_pk > option[value="Reject"]').attr('disabled', false);
                $('#output_lab_pk > option[value="Unload"]').attr('disabled', true);
                $('#output_lab_pk > option[value="Pending"]').attr('disabled', true);
            } else {
                $('#output_lab_pk > option[value=""]').prop('selected', true);

            }
        }

    }
    var typingTimer; //timer identifier
    var doneTypingInterval = 2000;

    function cariaktual(x) {
        return Math.floor(x / 25) * 25;
    }
    lab1_id_penerimaan_po_pk.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(rumus, doneTypingInterval);
        hasilhampakatul();
    });

    ka_pk.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        hasilhampakatul();
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    pk_pk.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        hasilhampakatul();
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    pk_bersih_pk.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        hasilhampakatul();
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    beras_pk.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        hasilhampakatul();
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    butir_patah_pk.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        hasilhampakatul();
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    hampa_pk.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        hasilhampakatul();
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    katul_pk.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        hasilhampakatul();
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    wh_pk.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        hasilhampakatul();
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    tr_pk.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        hasilhampakatul();
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    md_pk.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        hasilhampakatul();
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });
    md_pk.addEventListener('keyup', function(e) {
        clearTimeout(typingTimer);
        hasilhampakatul();
        typingTimer = setTimeout(rumus, doneTypingInterval);
    });

    function round(value, exp) {
        if (typeof exp === 'undefined' || +exp === 0)
            return Math.round(value);

        value = +value;
        exp = +exp;

        if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
            return 0;

        // Shift
        value = value.toString().split('e');
        value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

        // Shift back
        value = value.toString().split('e');
        return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
    }

    var changeprice = false;
</script>
@endsection