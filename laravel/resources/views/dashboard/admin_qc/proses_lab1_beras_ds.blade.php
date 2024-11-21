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
                    <span class="kt-subheader__separator kt-hidden"></span>
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
                            <i class="kt-menu__link-icon   flaticon2-laptop kt-font-danger"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                Lab 1 Beras DS
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


            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
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

            <div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
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

            <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form id="formantrian_qc" class="m-form m-form--fit m-form--label-align-right" method="post"
                            action="{{ route('qc.lab.save_proseslab1_gabah_basah') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Data Lab 1</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="text" id="penerimaan_id_data_po_gb" name="lab1_id_data_po_gb">
                                <input type="hidden" id="id_penerimaan_po_gb" name="id_penerimaan_po_gb">
                                <input type="hidden" id="penerimaan_id_bid_user_gb" name="lab1_id_bid_user_gb">
                                <input type="hidden" id="tanggal_po_gb" name="tanggal_po_gb">
                                <input type="hidden" id="waktu_penerimaan_gb" name="waktu_penerimaan_gb">
                                <input type="hidden" id="date_bid_gb" name="date_bid_gb">

                                {{-- tambahan input --}}
                                <input type="hidden" id="hampa_gb" name="hampa_gb">
                                <input type="hidden" id="kg_after_adjust_hampa_gb" name="kg_after_adjust_hampa_gb">
                                <input type="hidden" id="prosentasi_kg_gb" name="prosentasi_kg_gb">
                                <input type="hidden" id="susut_gb" name="susut_gb">
                                <input type="hidden" id="adjust_susut_gb" name="adjust_susut_gb">
                                <input type="hidden" id="prsentase_ks_kg_after_adjust_susut_gb" name="prsentase_ks_kg_after_adjust_susut_gb">
                                <input type="hidden" id="prsentase_kg_pk_gb" name="prsentase_kg_pk_gb">
                                <input type="hidden" id="adjust_prosentase_kg_pk_gb" name="adjust_prosentase_kg_pk_gb">
                                <input type="hidden" id="presentase_ks_pk_gb" name="presentase_ks_pk_gb">
                                <input type="hidden" id="presentase_putih_gb" name="presentase_putih_gb">
                                <input type="hidden" id="adjust_prosentase_kg_ke_putih_gb" name="adjust_prosentase_kg_ke_putih_gb">
                                <input type="hidden" id="plan_rend_dari_ks_beras_gb" name="plan_rend_dari_ks_beras_gb">
                                <input type="hidden" id="katul_gb" name="katul_gb">
                                <input type="hidden" id="refraksi_broken_gb" name="refraksi_broken_gb">
                                <input type="hidden" id="plan_harga_gabah_gb" name="plan_harga_gabah_gb">

                                <div class="form-group">
                                    <div class="">
                                        <label>Kode PO</label>
                                        <input type="text" id="penerimaan_kode_po_gb" name="lab1_kode_po_gb" class="form-control m-input" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Nopol</label>
                                        <input type="text" id="plat_kendaraan_gb" readonly name="lab1_plat_gb" class="form-control m-input">
                                    </div>
                                </div>
                                <div id="planhpp" class="form-group"></div>

                                {{-- edit form --}}
                                <div class="m-form__group form-group">
                                    <label for="">KA KS</label>
                                    <input type="number" step="any" required name="kadar_air_gb" id="kadar_air_gb" class="form-control m-input" value="27.0">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">KA KG</label>
                                    <input type="number" step="any" required name="ka_kg_gb" id="ka_kg_gb" class="form-control m-input" value="13.6">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Berat Sample Awal KS</label>
                                    <input type="number" step="any" required name="berat_sample_awal_ks_gb" id="berat_sample_awal_ks_gb" class="form-control m-input" value="150">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Berat Sample Awal KG</label>
                                    <input type="number" step="any" required name="berat_sample_awal_kg_gb"  id="berat_sample_awal_kg_gb" class="form-control m-input" value="131.3">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Berat Sample Akhir KG</label>
                                    <input type="number" step="any" required name="berat_sample_akhir_kg_gb" id="berat_sample_akhir_kg_gb" class="form-control m-input" value="129.8">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Berat Sample PK</label>
                                    <input type="number" step="any" required name="berat_sample_pk_gb" id="berat_sample_pk_gb" class="form-control m-input" value="105.0">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Berat Sample Beras</label>
                                    <input type="number" step="any" required name="randoman_gb" id="randoman_gb" class="form-control m-input" value="89.7">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">WH</label>
                                    <input type="number" step="any" required name="wh_gb" id="wh_gb" class="form-control m-input" value="44.6">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">TP</label>
                                    <input type="number" step="any" required name="tp_gb" id="tp_gb" class="form-control m-input" value="3.38">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">MD</label>
                                    <input type="number" step="any" required name="md_gb" id="md_gb" class="form-control m-input" value="124">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Broken Setelah Bongkar</label>
                                    <input type="number" step="any" required name="broken_gb" id="broken_gb" class="form-control m-input" value="53.0">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Status Lab</label>
                                    <select class="form-select form-control m-input" onchange="yesnoCheck(this);" id="keterangan_lab_1" required name="keterangan_lab_1_gb" aria-label="Default select example">
                                      <option value="">--Hasil Lab 1--</option>
                                      <option name="keterangan_lab_1_gb" value="Unload">Bongkar</option>
                                      <option name="keterangan_lab_1_gb" value="Pending">Pending</option>
                                      <option name="keterangan_lab_1_gb" value="Reject">Tolak</option>
                                    </select>
                                </div>
                                <div class="m-form__group form-group" id="ifYes" style="display: none;">
									<label>Location</label>
									<div class="kt-radio-inline">
										<label class="kt-radio">
											<input type="radio" value="UTARA" id="lokasigt_gb" class="form-control m-input" name="lokasi_gt_gb"> UTARA
											<span></span>
										</label>
										<label class="kt-radio">
											<input type="radio" value="SELATAN" id="lokasi04_gb" class="form-control m-input" name="lokasi_gt_gb"> SELATAN
											<span></span>
										</label>
									</div>
								</div>
								<div class="m-form__group form-group">
                                    <label for="">Keterangan</label>
                                    <input type="text" step="any" required name="keterangan_lab_gb" id="keterangan_lab_gb" class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Plan Harga (Kg)</label>
                                    <input readonly type="number" step="any" required name="plan_harga_gb" id="plan_harga_gb"
                                        class="form-control m-input">
                                </div>
                                
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                                <button id="btn_save" type="submit" class="btn btn-success m-btn pull-right">Save</button>
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
                title: 'Pilih Lokasi Bongkar',
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
                ajax: "{{ route('qc.lab.proses_lab1_beras_ds_index') }}",
                columns: [{
                        data: "id_bid",

                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'waktu_penerimaan'},
                    {data: 'kode_po'},
                    {data: 'tanggal_po'},
                    {data: 'nama_vendor'},
                    {data: 'plat_kendaraan'},
                    {data: 'keterangan_penerimaan_po'},
                    {data: 'ckelola'}

                ],
                "order": []
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
                    var lok = document.getElementById('lokasigt_gb');
                    var lok1 = document.getElementById('lokasi04_gb');
                    if($('#kadar_air_gb').val()=='' | $('#ka_kg_gb').val()=='' | lok.checked==false && lok1.checked==false | $('#berat_sample_awal_ks_gb').val()=='' | $('#berat_sample_awal_kg_gb').val()=='' | $('#berat_sample_akhir_kg_gb').val()=='' | $('#berat_sample_pk_gb').val()=='' | $('#randoman_gb').val()=='' | $('#wh_gb').val()=='' | $('#tp_gb').val()=='' | $('#md_gb').val()=='' | $('#keterangan_lab_1_gb').find(":selected").val()=='' | $('#broken_gb').val()=='' | $('#keterangan_lab1_gb').val()=='' ){
                    Swal.fire('Gagal!', 'Data Harus Diisi.', 'error')
                    } else if($('#plan_harga_gb').val()=='' | $('#plan_harga_gb').val()=='0'){
                        Swal.fire('Mohon Dicek!', 'Top Price, Price GT/04 dan Plan Hpp harap disi sesuai tanggal PO', 'warning')
                    } else{
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
                var url = '{{ route('qc.lab.gabah_incoming_qc') }}' + "/" + id;
                var url2 = "{{route('qc.lab.get_plan_hpp_gabah_basah') }}" + "/"+ tanggal_po;
                $('#formantrian_qc').trigger('reset');
            //   $('#modal2').removeData();
               $('#modal2').on('hidden.bs.modal', function (e) {   
              location.reload();
            
            $('#modal2').show();
        })
            $('#modal2').modal('show');
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        // console.log(response);
                        var parsed = $.parseJSON(response);
                        $('#id_penerimaan_po_gb').val(parsed.id_penerimaan_po);
                        $('#penerimaan_kode_po_gb').val(parsed.penerimaan_kode_po);
                        $('#penerimaan_id_data_po_gb').val(parsed.penerimaan_id_data_po);
                        $('#penerimaan_id_bid_user_gb').val(parsed.penerimaan_id_bid_user);
                        $('#plat_kendaraan_gb').val(parsed.plat_kendaraan);
                        $('#tanggal_po_gb').val(parsed.tanggal_po);
                        $('#date_bid_gb').val(parsed.date_bid);
                        $('#waktu_penerimaan_gb').val(parsed.waktu_penerimaan);
                        $('#min_tp_gb').val(parsed.min_tp);
                        $('#max_tp_gb').val(parsed.max_tp);
                        $('#harga_hpp_gb').val(parsed.harga);
                        // console.log(parsed.bid_user_id);
                    }
                });
                
                $.ajax({
                    type: "GET",
                    url: url2,
                    success: function(response) {
                        var my_orders = $('#planhpp')
                        var parsed = JSON.parse(response);
                        console.log(parsed);
                        $.each(parsed, function(item){
                        my_orders.append("<input type="+'hidden'+" class="+'hpp'+" value=" + parsed[item].min_tp_gb +'#'+ parsed[item].max_tp_gb +'#'+ parsed[item].harga_gb+">" );
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
                var url = '{{ route('qc.lab.lokasi_bongkar') }}' + "/" + id;
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
    
        var get_id_penerimaan = document.getElementById('id_penerimaan_po_gb');
    
        var kadar_air_gb = document.getElementById('kadar_air_gb');
        var ka_kg_gb = document.getElementById('ka_kg_gb');
        var berat_sample_awal_ks_gb = document.getElementById('berat_sample_awal_ks_gb');
        var berat_sample_awal_kg_gb = document.getElementById('berat_sample_awal_kg_gb');
        var berat_sample_akhir_kg_gb = document.getElementById('berat_sample_akhir_kg_gb');
        var berat_sample_pk_gb = document.getElementById('berat_sample_pk_gb');
        var randoman_gb = document.getElementById('randoman_gb');
        var wh_gb = document.getElementById('wh_gb');
        var tp_gb = document.getElementById('tp_gb');
        var md_gb = document.getElementById('md_gb');
        var broken_gb = document.getElementById('broken_gb');
        // hidden
        var kg_after_adjust_hampa_gb = document.getElementById('kg_after_adjust_hampa_gb');
        var prosentasi_kg_gb = document.getElementById('prosentasi_kg_gb');
        var susut_gb = document.getElementById('susut_gb');
        var adjust_susut_gb = document.getElementById('adjust_susut_gb');
        var prsentase_ks_kg_after_adjust_susut_gb = document.getElementById('prsentase_ks_kg_after_adjust_susut_gb');
        var prsentase_kg_pk_gb = document.getElementById('prsentase_kg_pk_gb');
        var adjust_prosentase_kg_pk_gb = document.getElementById('adjust_prosentase_kg_pk_gb');
        var presentase_ks_pk_gb = document.getElementById('presentase_ks_pk_gb');
        var presentase_putih_gb = document.getElementById('presentase_putih_gb');
        var adjust_prosentase_kg_ke_putih_gb = document.getElementById('adjust_prosentase_kg_ke_putih_gb');
        var plan_rend_dari_ks_beras_gb = document.getElementById('plan_rend_dari_ks_beras_gb');
        var katul_gb = document.getElementById('katul_gb');
        var refraksi_broken_gb = document.getElementById('refraksi_broken_gb');
        var plan_harga_gabah_gb = document.getElementById('plan_harga_gabah_gb');
        var hampa_gb = document.getElementById('hampa_gb');

        var plan_harga = document.getElementById('plan_harga_gb');

        function rumus() {
            var hasil = "0";
            if (kadar_air_gb.value              == 0 || kadar_air_gb.value == '' ||
                ka_kg_gb.value                  == 0 || ka_kg_gb.value == '' ||
                berat_sample_awal_ks_gb.value   == 0 || berat_sample_awal_ks_gb.value == '' ||
                berat_sample_awal_kg_gb.value   == 0 || berat_sample_awal_kg_gb.value == '' ||
                berat_sample_akhir_kg_gb.value  == 0 || berat_sample_akhir_kg_gb.value == '' ||
                berat_sample_pk_gb.value        == 0 || berat_sample_pk_gb.value == '' ||
                randoman_gb.value               == 0 || randoman_gb.value == '' ||
                wh_gb.value                     == 0 || wh_gb.value == '' ||
                tp_gb.value                     == 0 || tp_gb.value == '' ||
                md_gb.value                     == 0 || md_gb.value == '' ||
                broken_gb.value                 == 0 || broken_gb.value == '') {
                hasil = "0";

            } else {
                var id_penerimaan                                       = id_penerimaan_po_gb.value;
                kg_after_adjust_hampa_gb.value                          = berat_sample_akhir_kg_gb.value;
                var perhitungan_prosentasi_kg                           = parseFloat(kg_after_adjust_hampa_gb.value) / 1.5
                prosentasi_kg_gb.value                                  = round(perhitungan_prosentasi_kg, 2);
                var perhitungan_susut                                   = 100 - prosentasi_kg_gb.value
                susut_gb.value                                          = round(perhitungan_susut, 2);
                var perhitungan_adjust_susut                            = susut_gb.value * 1.2;
                adjust_susut_gb.value                                   = round(perhitungan_adjust_susut, 2);
                var perhitungan_prsentase_ks_kg_after_adjust_susut      = 100 - adjust_susut_gb.value;
                prsentase_ks_kg_after_adjust_susut_gb.value             = round(perhitungan_prsentase_ks_kg_after_adjust_susut, 2);
                var perhitungan_prsentase_kg_pk                         = (berat_sample_pk_gb.value / (kg_after_adjust_hampa_gb.value / 100));
                prsentase_kg_pk_gb.value                                = round(perhitungan_prsentase_kg_pk, 2);
                var perhitungan_adjust_prosentase_kg_pk                 = prsentase_kg_pk_gb.value * 0.952;
                adjust_prosentase_kg_pk_gb.value                        = round(perhitungan_adjust_prosentase_kg_pk, 2);
                var perhitungan_presentase_ks_pk                        = prsentase_ks_kg_after_adjust_susut_gb.value * (adjust_prosentase_kg_pk_gb.value / 100);
                presentase_ks_pk_gb.value                               = round(prsentase_ks_kg_after_adjust_susut_gb.value * (adjust_prosentase_kg_pk_gb.value / 100), 2);
                var perhitungan_presentase_putih                        = randoman_gb.value / (kg_after_adjust_hampa_gb.value / 100);
                presentase_putih_gb.value                               = round(perhitungan_presentase_putih, 2);
                var perhitungan_adjust_prosentase_kg_ke_putih           = presentase_putih_gb.value * 0.952;
                adjust_prosentase_kg_ke_putih_gb.value                  = round(perhitungan_adjust_prosentase_kg_ke_putih, 2);
                var perhitungan_plan_rend_dari_ks_beras                 = (100 - adjust_susut_gb.value) * (adjust_prosentase_kg_ke_putih_gb.value / 100);
                plan_rend_dari_ks_beras_gb.value                        = round(perhitungan_plan_rend_dari_ks_beras,2);
                var  perhitungan_katul                                  = ((adjust_prosentase_kg_pk_gb.value - adjust_prosentase_kg_ke_putih_gb.value) / adjust_prosentase_kg_pk_gb.value) * 100;
                katul_gb.value                                          = round(perhitungan_katul, 2);
                var perhitungan_refraksi_broken                         = "0";
                var h_broken                                            = broken_gb.value;
                if (parseFloat(h_broken) < 28 && parseFloat(h_broken) > 0) {
                    perhitungan_refraksi_broken = "0";
                } else if (parseFloat(h_broken) >= 28 && parseFloat(h_broken) < 30) {
                    perhitungan_refraksi_broken = "0";
                } else if (parseFloat(h_broken) >= 30 && parseFloat(h_broken) <= 80) {
                    perhitungan_refraksi_broken = "0";
                } else {
                    perhitungan_refraksi_broken = "";
                }
                refraksi_broken_gb.value = perhitungan_refraksi_broken;

                // get plan hpp
               
                var elems = document.querySelectorAll(".hpp");
                    // console.log(elems);
                
                var std_hpp_incoming = 0;
                [].forEach.call(elems, function(el) {
                    var plan_hpp = el.value;
                    // console.log(plan_hpp);
                    arr_hpp = plan_hpp.split("#");
                    // console.log(arr_hpp[2]);
                    if (tp_gb.value >= arr_hpp[0] && tp_gb.value <= arr_hpp[1]) {
                        std_hpp_incoming = arr_hpp[2];
                    } else if (tp_gb.value >= arr_hpp[1]){
                        std_hpp_incoming = arr_hpp[2];
                        
                    }
                    console.log(std_hpp_incoming);
                
//                     }

                });
                // console.log(min_tp,max_tp, harga_hpp);
                var perhitungan_plan_harga_gabah = ((plan_rend_dari_ks_beras_gb.value / 100) * std_hpp_incoming) - 75;
                plan_harga_gabah_gb.value = round(perhitungan_plan_harga_gabah, 0);
                hasil = plan_harga_gabah_gb.value;
                console.log(hasil);

                // if (plan_harga_gabah.value == 0 || plan_harga_gabah.value == '') {
                //     hasil = "0";
                // } else {
                //     if (status_gabah == "UTARA" || status_gabah == "SELATAN") {
                //         var perhitungan_hasil = plan_harga_gabah.value - refraksi_broken.value;
                //         hasil = round(perhitungan_hasil, 2);
                //     } else {
                //         var perhitungan_hasil = plan_harga_gabah.value - refraksi_broken.value;
                //         hasil = round(perhitungan_hasil);

                //     }
                // }
                $.ajax({
                    type: "GET",
                    url: "{{route('get_price_top_gabah_basah')}}" + "/" + id_penerimaan,
                    async: false,
                    success: function(data){
                        var record = JSON.parse(data);
                        // console.log(record)
                        if(record==null){
                            Swal.fire({
                        title: 'Maaf, Anda Tidak Bisa Input',
                        text: 'Harap input HARGA ATAS Sesuai Tanggal PO',
                        icon: 'warning',
                        allowOutsideClick: false
                    }).then((result) => {
                         if (result.value) {
                     window.location.href = "{{ route('qc.lab.harga_atas_gabah_basah') }}";
                             
                         }
                    })
                        } 
                    }
                 });
                 $.ajax({
                    type: "GET",
                    url: "{{route('get_count_plan_hpp_gabah_basah')}}" + "/" + id_penerimaan,
                    async: false,
                    success: function(data){
                        var record = JSON.parse(data);
                        console.log(record)
                        if(record=='0'){
                            Swal.fire({
                        title: 'Maaf, Anda Tidak Bisa Input',
                        text: 'Harap input PLAN HPP Sesuai Tanggal PO',
                        icon: 'warning',
                        allowOutsideClick: false
                    }).then((result) => {
                         if (result.value) {
                     window.location.href = "{{ route('qc.lab.plan_hpp_gabah_basah') }}";
                             
                         }
                    })
                        } 
                    }
                 });
                var perhitungan_hampa = (berat_sample_awal_kg_gb.value - berat_sample_akhir_kg_gb.value) / (berat_sample_awal_kg_gb.value / 100);
                hampa_gb.value = round(perhitungan_hampa, 1);
                console.log("id_penerimaan = " + id_penerimaan);
                console.log("Hampa = " + hampa_gb.value)
                console.log("kg after djust hampa = " + kg_after_adjust_hampa_gb.value);
                console.log("prosentasi kg = " + prosentasi_kg_gb.value);
                console.log("susut = " + susut_gb.value);
                console.log("adjust susut = " + adjust_susut_gb.value);
                console.log("presentase ks kg after adjust = " + prsentase_ks_kg_after_adjust_susut_gb.value);
                console.log("prsentase kg pk = " + prsentase_kg_pk_gb.value);
                console.log("adjust prosentase kg pk = " + adjust_prosentase_kg_pk_gb.value);
                console.log("presentase ks pk = " + presentase_ks_pk_gb.value);
                console.log("presentase putih = " + presentase_putih_gb.value);
                console.log("adjust prosentase kg ke putih = " + adjust_prosentase_kg_ke_putih_gb.value);
                console.log("plan rend dari ks beras = " + plan_rend_dari_ks_beras_gb.value);
                console.log("katul = " + katul_gb.value);
                console.log("refraksi broken = " + refraksi_broken_gb.value);
                console.log("plan harga gabah = " + plan_harga_gabah_gb.value);
                console.log("hasil akhir = " + hasil)
            }
            plan_harga.value = hasil;

        }

        id_penerimaan_po_gb.addEventListener('keyup', function(e) {
            rumus();
        });

        kadar_air_gb.addEventListener('keyup', function(e) {
            rumus();
        });
        ka_kg_gb.addEventListener('keyup', function(e) {
            rumus();
        });
        berat_sample_awal_ks_gb.addEventListener('keyup', function(e) {
            rumus();
        });
        berat_sample_awal_kg_gb.addEventListener('keyup', function(e) {
            rumus();
        });
        berat_sample_akhir_kg_gb.addEventListener('keyup', function(e) {
            rumus();
        });
        berat_sample_pk_gb.addEventListener('keyup', function(e) {
            rumus();
        });
        randoman_gb.addEventListener('keyup', function(e) {
            rumus();
        });
        wh_gb.addEventListener('keyup', function(e) {
            rumus();
        });
        tp_gb.addEventListener('keyup', function(e) {
            rumus();
        });
        md_gb.addEventListener('keyup', function(e) {
            rumus();
        });
        broken_gb.addEventListener('keyup', function(e) {
            rumus();
        });

        function round(value, exp) {
            if (typeof exp === 'undefined' || +exp === 0)
                return Math.round(value);

            value = +value;
            exp = +exp;

            if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
                return NaN;

            // Shift
            value = value.toString().split('e');
            value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));

            // Shift back
            value = value.toString().split('e');
            return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
        }
        
        var changeprice=false;
    </script>
@endsection
