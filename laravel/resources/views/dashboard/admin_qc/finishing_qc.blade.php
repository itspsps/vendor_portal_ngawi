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
                        <span class="btn-outline btn-sm btn-info">Site Subang</span>
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
                                <i class="flaticon-user"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                Data Finishing QC
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th style="text-align: center;width:2%">No</th>
                                    <th style="text-align: center;width:auto">&nbsp;&nbsp;Kode&nbsp;PO&nbsp;&nbsp;</th>
                                    <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th style="text-align: center;width:auto">&nbsp;&nbsp;Tanggal&nbsp;PO&nbsp;&nbsp; </th>
                                    <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                    <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;</th>
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
                                <h5 class="modal-title" id="exampleModalLongTitle">Output Data Gabah Incoming</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" id="plan_harga">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            

            {{-- list plan hpp --}}
            @foreach ($plan_hpp_gabah_basah as $data)
                <input type="hidden" class="val_plan_hpp"
                    value="{{ $data->min_tp . '#' . $data->max_tp . '#' . $data->harga }}">
            @endforeach

            <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form id="formfinishing_qc" class="m-form m-form--fit m-form--label-align-right" method="post"
                            action="{{ route('qc.lab.save_gabah_finishing_qc') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Data LAB 2</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="gabahincoming_id_data_po" id="gabahincoming_id_data_po">
                                <input type="hidden" name="gabahincoming_id_penerimaan_po" id="gabahincoming_id_penerimaan_po">
                                <input type="hidden" id="gabahincoming_id_bid_user" name="gabahincoming_id_bid_user">
                                <input type="hidden" id="hasil_akhir_tonase" name="hasil_akhir_tonase">
                                <input type="hidden" id="plan_berat_kg_pertruk" name="plan_berat_kg_pertruk">
                                <input type="hidden" id="plan_berat_pk_pertruk" name="plan_berat_pk_pertruk">
                                <input type="hidden" id="plan_berat_beras_pertruk" name="plan_berat_beras_pertruk">
                                <input type="hidden" id="plan_hpp" name="hpp_aktual">
                                <input type="hidden" id="plan_harga_gabah_ongkos_dryer" name="plan_harga_gabah_ongkos_dryer">
                                <input type="hidden" id="plan_harga_pk_perkilo" name="plan_harga_pk_perkilo">
                                <input type="hidden" id="plan_harga_beras_perkilo" name="plan_harga_beras_perkilo">
                                <input type="hidden" id="plan_total_harga_gabah_pertruk" name="plan_total_harga_gabah_pertruk">
                                <input type="hidden" id="plan_total_harga_pk_pertruk" name="plan_total_harga_pk_pertruk">
                                <input type="hidden" id="plan_total_harga_beras_pertruk" name="plan_total_harga_beras_pertruk">

                                {{-- tambahan input --}}
                                <input type="hidden" id="hampa" name="hampa">
                                <input type="hidden" id="kg_after_adjust_hampa" name="kg_after_adjust_hampa">
                                <input type="hidden" id="prosentasi_kg" name="prosentasi_kg">
                                <input type="hidden" id="susut" name="susut">
                                <input type="hidden" id="adjust_susut" name="adjust_susut">
                                <input type="hidden" id="prsentase_ks_kg_after_adjust_susut" name="prsentase_ks_kg_after_adjust_susut">
                                <input type="hidden" id="prsentase_kg_pk" name="prsentase_kg_pk">
                                <input type="hidden" id="adjust_prosentase_kg_pk" name="adjust_prosentase_kg_pk">
                                <input type="hidden" id="presentase_ks_pk" name="presentase_ks_pk">
                                <input type="hidden" id="presentase_putih" name="presentase_putih">
                                <input type="hidden" id="adjust_prosentase_kg_ke_putih" name="adjust_prosentase_kg_ke_putih">
                                <input type="hidden" id="plan_rend_dari_ks_beras" name="plan_rend_dari_ks_beras">
                                <input type="hidden" id="katul" name="katul">
                                <input type="hidden" id="refraksi_broken" name="refraksi_broken">
                                <input type="hidden" id="plan_harga_gabah" name="plan_harga_gabah">
                                <input type="hidden" id="plan_harga_beli_gabah" name="plan_harga_beli_gabah">
                                <input type="hidden" id="harga_berdasarkan_tempat" name="harga_berdasarkan_tempat">
                                <input type="hidden" id="harga_berdasarkan_harga_atas"
                                    name="harga_berdasarkan_harga_atas">
                                <input type="hidden" id="harga_awal" name="harga_awal">
                                <input type="hidden" id="antrian" name="antrian">
                                <input type="hidden" id="dtm" name="dtm">
                                <div id="planhpp" class="form-group">
                                
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Code PO</label>
                                        <input type="text" id="gabahincoming_kode_po" name="gabahincoming_kode_po"
                                            class="form-control m-input" readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Plat</label>
                                        <input type="text" id="gabahincoming_plat" readonly name="gabahincoming_plat"
                                            class="form-control m-input">
                                    </div>
                                </div>
                                <input type="hidden" name="beras_hitam" value="1"> 
                                <input type="hidden"  name="beras_kusam" value="1"> 
                                <input type="hidden"  name="biji_mati" value="1"> 
                                <input type="hidden" name="semu" value="1"> 
                                <input type="hidden"  name="kuning" value="1"> 
                                <input type="hidden" name="mletik_semu" value="1">
                                <input type="hidden"  name="gabah_hitam" value="1">
                                <input type="hidden"  name="gabah_sungutan" value="1"> 
                                <input type="hidden" name="gabah_kopong" value="1">
                                <input type="hidden"   name="aroma_gabah" value="1"> 
                                <input type="hidden"  name="kotoran_gabah" value="1">
                               
                                {{-- <div class="m-form__group form-group">
                                    <label for="">Output Hampa</label>
                                    <div class="m-radio-inline">
                                        <label class="m-radio">
                                            <input type="radio"id="hampa" name="hampa" value="0"> Hampa 3,1/3,5 >
                                            <span></span>
                                        </label>
                                        &nbsp;
                                        <label class="m-radio">
                                            <input type="radio" id="hampa" name="hampa" value="1"> Hampa 3,1/3,5 <
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Output Broken</label>
                                    <div class="m-radio-inline">
                                        <label class="m-radio">
                                            <input type="radio" id="broken" name="broken" value="0"> Broken 65 >
                                            <span></span>
                                        </label>
                                        &nbsp;
                                        <label class="m-radio">
                                            <input type="radio" id="broken" name="broken" value="1"> Broken 65 <
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Output Randoman</label>
                                    <div class="m-radio-inline">
                                        <label class="m-radio">
                                            <input type="radio" id="randoman" name="randoman" value="0"> Randoman 51 <
                                            <span></span>
                                        </label>
                                        &nbsp;
                                        <label class="m-radio">
                                            <input type="radio" id="randoman" name="ranrandomandoman" value="1"> Randoman 51 >
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Output Kadar Air</label>
                                    <div class="m-radio-inline">
                                        <label class="m-radio">
                                            <input type="radio" name="kadar_air" value="0"> Kadar Air  32 >
                                            <span></span>
                                        </label>
                                        &nbsp;
                                        <label class="m-radio">
                                            <input type="radio" name="kadar_air" value="1"> Kadar Air 32 <
                                            <span></span>
                                        </label>
                                    </div>
                                </div> --}}
                                {{-- edit form --}}
                                <div class="m-form__group form-group">
                                    <label for="">KA KS</label>
                                    <input type="number" step="any" required name="kadar_air" id="kadar_air" class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">KA KG</label>
                                    <input type="number" step="any" required name="ka_kg" id="ka_kg" class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Berat Sample Awal KS</label>
                                    <input type="number" step="any" required name="berat_sample_awal_ks" id="berat_sample_awal_ks" class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Berat Sample Awal KG </label>
                                    <input type="number" step="any" required name="berat_sample_awal_kg" id="berat_sample_awal_kg" class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Berat Sample Akhir KG </label>
                                    <input type="number" step="any" required name="berat_sample_akhir_kg" id="berat_sample_akhir_kg" class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Berat Sample PK</label>
                                    <input type="number" step="any" required name="berat_sample_pk" id="berat_sample_pk" class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Berat Sample Beras</label>
                                    <input type="number" step="any" required name="randoman" id="randoman" class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">WH</label>
                                    <input type="number" step="any" required name="wh" id="wh" class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">TP</label>
                                    <input type="number" step="any" required name="tp" id="tp" class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">MD</label>
                                    <input type="number" step="any" required name="md" id="md" class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Broken Setelah Bongkar</label>
                                    <input type="number" step="any" required name="broken" id="broken" class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Plan Harga (Kg)</label>
                                    <input readonly type="number" step="any" required name="plan_harga" id="plan_hargafin"
                                        class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Aksi Harga</label>
                                   <input type="text" readonly name="aksi_harga" id="aksi_harga" value="ON PROCESS" class="form-control m-input">

                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Unloading Location</label>
                                    <input type="text" readonly required name="lokasi_gt" id="lokasi_gt" required class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">DTM</label>
                                    <input type="text" readonly required name="no_dtm" id="no_dtm" required class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Suveyor</label>
                                    <input type="text" required name="surveyor" readonly id="surveyor_bongkar"
                                        class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Keterangan</label>
                                    <input type="text" required name="keterangan" readonly id="keterangan_bongkar"
                                        class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Waktu</label>
                                    <input type="text" required name="waktu" readonly id="waktu_bongkar"
                                        class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Tempat</label>
                                    <input type="text" required name="tempat" readonly id="tempat_bongkar"
                                        class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Z yang dibawa</label>
                                    <input type="text" required name="z_yang_dibawa" readonly id="z_yang_dibawa"
                                        class="form-control m-input">
                                </div>
                                <div class="m-form__group form-group">
                                    <label for="">Z yang ditolak</label>
                                    <input type="text" required name="z_yang_ditolak" readonly id="z_yang_ditolak"
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
                ajax: "{{ route('qc.lab.finishing_qc_lab_2') }}",
                columns: [{
                        data: "id_bid",

                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {data: 'kode_po'},
                    {data: 'nama_vendor'},
                    {data: 'plat_kendaraan'},
                    {data: 'tanggal_po'},
                    {data: 'plan_harga'},
                    {data: 'ckelola'},
                    {data: 'detail_hasil_qc'}

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
                if( $('#z_yang_dibawa').val()=='' | $('#broken').val()=='' | $('#tp').val()=='' | $('#berat_sample_pk').val()=='' | $('#kadar_air').val()=='' | $('#ka_kg').val()=='' | $('#berat_sample_akhir_kg').val()=='' | $('#berat_sample_awal_ks').val()=='' | $('#berat_sample_awal_kg').val()=='' | $('#md').val()=='' | $('#tp').val()=='' | $('#wh').val()=='' | $('#randoman').val()=='') {
                    Swal.fire('Gagal!', 'Data Harus Diisi Semua', 'error')
                } else if($('#plan_hargafin').val()=='' | $('#plan_hargafin').val()=='0'){
                        Swal.fire('Mohon Dicek!', 'Top Price, Price GT/04 dan Plan Hpp harap disi sesuai tanggal PO', 'warning')  
                } else{
                    $('#formfinishing_qc').submit();
                    Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                    
                }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
            $(document).on('click', '#btn_finishing_qc', function() {
                var id = $(this).attr("name");
                var tanggal_po = $(this).data('tanggalpo');
                var url = "{{ route('qc.lab.show_lab_2') }}" + "/" + id;
                var url2 = "{{route('qc.lab.get_plan_hpp') }}" + "/"+ tanggal_po;
                // console.log(tanggal_po);
                 $('#formfinishing_qc').trigger('reset');
            //   $('#modal2').removeData();
            //   location.reload();
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
                        $('#gabahincoming_kode_po').val(parsed.gabahincoming_kode_po);
                        $('#hasil_akhir_tonase').val(parsed.hasil_akhir_tonase);
                        $('#gabahincoming_plat').val(parsed.gabahincoming_plat);
                        $('#gabahincoming_id_data_po').val(parsed.gabahincoming_id_data_po);
                        $('#gabahincoming_id_penerimaan_po').val(parsed.gabahincoming_id_penerimaan_po);
                        $('#gabahincoming_id_bid_user').val(parsed.gabahincoming_id_bid_user);
                        $('#lokasi_gt').val(parsed.lokasi_bongkar1);
                        $('#no_dtm').val(parsed.no_dtm);
                        $('#surveyor_bongkar').val(parsed.surveyor_bongkar);
                        $('#keterangan_bongkar').val(parsed.keterangan_bongkar);
                        $('#waktu_bongkar').val(parsed.waktu_bongkar);
                        $('#tempat_bongkar').val(parsed.tempat_bongkar);
                        $('#z_yang_dibawa').val(parsed.z_yang_dibawa);
                        $('#dtm').val(parsed.no_dtm);
                        if((parsed.lokasi_bongkar1)=='GT'){
                        $('#antrian').val(parsed.antrian1);
                        } else{
                        $('#antrian').val(parsed.antrian2);
                            
                        }
                            
                        $('#z_yang_ditolak').val(parsed.z_yang_ditolak);
                        //console.log(parsed.lokasi_bongkar);
                    }
                });
                $.ajax({
                    type: "GET",
                    url: url2,
                    success: function(response) {
                        var my_orders = $('#planhpp')
                        var parsed = $.parseJSON(response);
                        // console.log(my_orders);
                        $.each(parsed, function(item){
                        my_orders.append("<input type="+'hidden'+" class="+'hpp'+" value=" + parsed[item].min_tp +'#'+ parsed[item].max_tp +'#'+ parsed[item].harga+">" );
                    });
                    }
                });
            });
        });
    </script>

    <script>
        var lokasi_gt = document.getElementById('lokasi_gt');
        var kadar_air = document.getElementById('kadar_air');
        var ka_kg = document.getElementById('ka_kg');
        var berat_sample_awal_ks = document.getElementById('berat_sample_awal_ks');
        var berat_sample_awal_kg = document.getElementById('berat_sample_awal_kg');
        var berat_sample_akhir_kg = document.getElementById('berat_sample_akhir_kg');
        var berat_sample_pk = document.getElementById('berat_sample_pk');
        var randoman = document.getElementById('randoman');
        var wh = document.getElementById('wh');
        var tp = document.getElementById('tp');
        var md = document.getElementById('md');
        var broken = document.getElementById('broken');
        var aksi_harga = document.getElementById('aksi_harga');
        // hidden
        var kg_after_adjust_hampa = document.getElementById('kg_after_adjust_hampa');
        var prosentasi_kg = document.getElementById('prosentasi_kg');
        var susut = document.getElementById('susut');
        var adjust_susut = document.getElementById('adjust_susut');
        var prsentase_ks_kg_after_adjust_susut = document.getElementById('prsentase_ks_kg_after_adjust_susut');
        var prsentase_kg_pk = document.getElementById('prsentase_kg_pk');
        var adjust_prosentase_kg_pk = document.getElementById('adjust_prosentase_kg_pk');
        var presentase_ks_pk = document.getElementById('presentase_ks_pk');
        var presentase_putih = document.getElementById('presentase_putih');
        var adjust_prosentase_kg_ke_putih = document.getElementById('adjust_prosentase_kg_ke_putih');
        var plan_rend_dari_ks_beras = document.getElementById('plan_rend_dari_ks_beras');
        var katul = document.getElementById('katul');
        var refraksi_broken = document.getElementById('refraksi_broken');
        var plan_harga_gabah = document.getElementById('plan_harga_gabah');
        var hampa = document.getElementById('hampa');

        var plan_harga_beli_gabah = document.getElementById('plan_harga_beli_gabah');
        var harga_berdasarkan_tempat = document.getElementById('harga_berdasarkan_tempat');
        var harga_berdasarkan_harga_atas = document.getElementById('harga_berdasarkan_harga_atas');
        var harga_awal = document.getElementById('harga_awal');
        
        var get_id_penerimaan = document.getElementById('gabahincoming_id_penerimaan_po');
        var hasil_akhir_tonase = document.getElementById('hasil_akhir_tonase');
        
        var plan_hargafin = document.getElementById('plan_hargafin');
        // tambahan hidden
        var plan_berat_kg_pertruk = document.getElementById('plan_berat_kg_pertruk');
        var plan_berat_pk_pertruk = document.getElementById('plan_berat_pk_pertruk');
        var plan_berat_beras_pertruk = document.getElementById('plan_berat_beras_pertruk');
        
        var plan_harga_gabah_ongkos_dryer = document.getElementById('plan_harga_gabah_ongkos_dryer');
        var plan_harga_pk_perkilo = document.getElementById('plan_harga_pk_perkilo');
        var plan_harga_beras_perkilo = document.getElementById('plan_harga_beras_perkilo');
        var plan_total_harga_pk_pertruk = document.getElementById('plan_total_harga_pk_pertruk');
        var plan_total_harga_beras_pertruk = document.getElementById('plan_total_harga_beras_pertruk');
        
        var hpp_aktual = document.getElementById('hpp_aktual');

        function rumus() {
            var hasil = "0";
            if (kadar_air.value == 0 || kadar_air.value == '' ||
                ka_kg.value == 0 || ka_kg.value == '' ||
                berat_sample_awal_ks.value == 0 || berat_sample_awal_ks.value == '' ||
                berat_sample_awal_kg.value == 0 || berat_sample_awal_kg.value == '' ||
                berat_sample_akhir_kg.value == 0 || berat_sample_akhir_kg.value == '' ||
                berat_sample_pk.value == 0 || berat_sample_pk.value == '' ||
                randoman.value == 0 || randoman.value == '' ||
                wh.value == 0 || wh.value == '' ||
                tp.value == 0 || tp.value == '' ||
                md.value == 0 || md.value == '' ||
                broken.value == 0 || broken.value == '') {
                hasil = "0";

            } else {
                var berat_tonase = hasil_akhir_tonase.value;
                var id_penerimaan = gabahincoming_id_penerimaan_po.value;
                    kg_after_adjust_hampa.value = berat_sample_akhir_kg.value;
                var perhitungan_prosentasi_kg = parseFloat(kg_after_adjust_hampa.value) / 1.5; 
                    prosentasi_kg.value = round(perhitungan_prosentasi_kg, 2);
                var perhitungan_susut = 100 - prosentasi_kg.value; 
                    susut.value = round(perhitungan_susut, 2);
                var perhitungan_adjust_susut = susut.value * 1.2;
                    adjust_susut.value = round(perhitungan_adjust_susut, 2);
                var perhitungan_prsentase_ks_kg_after_adjust_susut = 100 - adjust_susut.value;
                    prsentase_ks_kg_after_adjust_susut.value = round(perhitungan_prsentase_ks_kg_after_adjust_susut, 2);
                var perhitungan_prsentase_kg_pk = (berat_sample_pk.value / (kg_after_adjust_hampa.value / 100));
                    prsentase_kg_pk.value = round(perhitungan_prsentase_kg_pk, 2);
                var perhitungan_adjust_prosentase_kg_pk = prsentase_kg_pk.value * 0.952;
                    adjust_prosentase_kg_pk.value = round(perhitungan_adjust_prosentase_kg_pk, 2);
                var perhitungan_presentase_ks_pk = prsentase_ks_kg_after_adjust_susut.value * (adjust_prosentase_kg_pk.value / 100);
                    presentase_ks_pk.value = round(prsentase_ks_kg_after_adjust_susut.value * (adjust_prosentase_kg_pk.value / 100), 2);
                var perhitungan_presentase_putih = randoman.value / (kg_after_adjust_hampa.value / 100);
                    presentase_putih.value = round(perhitungan_presentase_putih, 2);
                var perhitungan_adjust_prosentase_kg_ke_putih = presentase_putih.value * 0.952;
                    adjust_prosentase_kg_ke_putih.value = round(perhitungan_adjust_prosentase_kg_ke_putih, 2);
                var perhitungan_plan_rend_dari_ks_beras = (100 - adjust_susut.value) * (adjust_prosentase_kg_ke_putih.value / 100);
                    plan_rend_dari_ks_beras.value = round(perhitungan_plan_rend_dari_ks_beras, 2);
                var perhitungan_katul = ((adjust_prosentase_kg_pk.value - adjust_prosentase_kg_ke_putih.value) /adjust_prosentase_kg_pk.value) * 100;
                    katul.value = round(perhitungan_katul, 2);
                // var perhitungan_plan_harga_gabah_dan_ongkos_drayer = round

                // tambahan rumus
                var perhitungan_plan_berat_kg_pertruk = berat_tonase * (prsentase_ks_kg_after_adjust_susut.value / 100);
                    plan_berat_kg_pertruk.value = round(perhitungan_plan_berat_kg_pertruk);
                var perhitungan_plan_berat_pk_pertruk = berat_tonase * (presentase_ks_pk.value / 100);
                    plan_berat_pk_pertruk.value = round(perhitungan_plan_berat_pk_pertruk);
                var perhitungan_plan_berat_beras_pertruk = berat_tonase * (plan_rend_dari_ks_beras.value / 100);
                    plan_berat_beras_pertruk.value = round(perhitungan_plan_berat_beras_pertruk);
                
                
                  

                // adsfa
                var perhitungan_refraksi_broken = "0";
                var h_broken = broken.value;
                if (parseFloat(h_broken) < 28 && parseFloat(h_broken) > 0) {
                    perhitungan_refraksi_broken = "0";
                } else if (parseFloat(h_broken) >= 28 && parseFloat(h_broken) < 30) {
                    perhitungan_refraksi_broken = "0";
                } else if (parseFloat(h_broken) >= 30 && parseFloat(h_broken) <= 80) {
                    perhitungan_refraksi_broken = "0";
                } else {
                    perhitungan_refraksi_broken = "";
                }
                refraksi_broken.value = perhitungan_refraksi_broken;

                // get plan hpp
                var elems = document.querySelectorAll(".hpp");

                var std_hpp_aktual = 0;
                [].forEach.call(elems, function(el) {
                    var plan_hpp = el.value;
                    arr_hpp = plan_hpp.split("#");

                    if (tp.value >= arr_hpp[0] && tp.value < arr_hpp[1]) {
                        std_hpp_aktual = arr_hpp[2];
                        // console.log(std_hpp_aktual);
                    } else if (tp.value >= arr_hpp[1]){
                        std_hpp_aktual = arr_hpp[2];
                        
                    }

                });
                
                var perhitungan_plan_hpp = std_hpp_aktual;
                    plan_hpp.value = perhitungan_plan_hpp;
                
                var perhitungan_plan_harga_gabah = ((plan_rend_dari_ks_beras.value / 100) * std_hpp_aktual) - 75;
                plan_harga_gabah.value = round(perhitungan_plan_harga_gabah);

                var perhitungan_plan_harga_gabah_ongkos_dryer = (parseInt(plan_harga_gabah.value))+75;
                    plan_harga_gabah_ongkos_dryer.value = perhitungan_plan_harga_gabah_ongkos_dryer;  
                var perhitungan_plan_harga_pk_perkilo = plan_harga_gabah_ongkos_dryer.value  / (presentase_ks_pk.value /100);
                    plan_harga_pk_perkilo.value = round(perhitungan_plan_harga_pk_perkilo);  
                var perhitungan_plan_harga_beras_perkilo = plan_harga_gabah_ongkos_dryer.value  / (plan_rend_dari_ks_beras.value /100);
                    plan_harga_beras_perkilo.value = round(perhitungan_plan_harga_beras_perkilo);  
                var perhitungan_plan_total_harga_gabah_pertruk = berat_tonase * plan_harga_gabah_ongkos_dryer.value;
                    plan_total_harga_gabah_pertruk.value = round(perhitungan_plan_total_harga_gabah_pertruk);  
                var perhitungan_plan_total_harga_pk_pertruk = berat_tonase * plan_harga_pk_perkilo.value;
                    plan_total_harga_pk_pertruk.value = round(perhitungan_plan_total_harga_pk_pertruk);
                var perhitungan_plan_total_harga_beras_pertruk = berat_tonase * plan_harga_beras_perkilo.value;
                    plan_total_harga_beras_pertruk.value = round(perhitungan_plan_total_harga_beras_pertruk);  
                    
                
                var perhitungan_plan_harga_beli_gabah = plan_harga_gabah.value - refraksi_broken.value;
                plan_harga_beli_gabah.value = perhitungan_plan_harga_beli_gabah;
                var perhitungan_hasil = plan_harga_gabah.value;
                harga_berdasarkan_tempat.value = round(perhitungan_hasil);

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
                        } else{
                        harga_atas=record.harga_atas;
                        // console.log("harga atas sekarang " + harga_atas);
                    } 
                        
                    }
                 });
               

                if (harga_berdasarkan_tempat.value >= harga_atas) {
                    console.log("harga diatas yang ditentukan");
                    harga_berdasarkan_harga_atas.value = harga_atas;
                } else {
                    console.log("harga dibwah sesuai rumus");
                    harga_berdasarkan_harga_atas.value = round(harga_berdasarkan_tempat.value);
                }

                harga_awal.value = harga_berdasarkan_harga_atas.value;

                var reaksi_harga = 0;

                if (aksi_harga.value == "ON PROCESS" || aksi_harga.value == "DEAL" || aksi_harga.value == "REJECT") {

                    hasil = harga_awal.value;
                } else {
                    if (reaksi_harga == 0) {
                        hasil = 0;
                    } else {
                        hasil = reaksi_harga + harga_awal.value;
                    }
                }

                var perhitungan_hampa = (berat_sample_awal_kg.value - berat_sample_akhir_kg.value) / (berat_sample_awal_kg
                    .value / 100);
                hampa.value = round(perhitungan_hampa, 1);
                console.log("id_penerimaan = " + id_penerimaan);
                console.log("Hampa = " + hampa.value)
                console.log("kg after djust hampa = " + kg_after_adjust_hampa.value);
                console.log("prosentasi kg = " + prosentasi_kg.value);
                console.log("susut = " + susut.value);
                console.log("adjust susut = " + adjust_susut.value);
                console.log("presentase ks kg after adjust = " + prsentase_ks_kg_after_adjust_susut.value);
                console.log("prsentase kg pk = " + prsentase_kg_pk.value);
                console.log("adjust prosentase kg pk = " + adjust_prosentase_kg_pk.value);
                console.log("presentase ks pk = " + presentase_ks_pk.value);
                console.log("presentase putih = " + presentase_putih.value);
                console.log("adjust prosentase kg ke putih = " + adjust_prosentase_kg_ke_putih.value);
                console.log("plan rend dari ks beras = " + plan_rend_dari_ks_beras.value);
                console.log("katul = " + katul.value);
                console.log("refraksi broken = " + refraksi_broken.value);
                console.log("plan harga gabah = " + plan_harga_gabah.value);
                console.log("hasil akhir = " + hasil);
                console.log("perhitungan plan berat kg pertruk = "+ perhitungan_plan_berat_kg_pertruk);
                console.log("perhitungan plan berat pk pertruk = "+ perhitungan_plan_berat_pk_pertruk);
                console.log("perhitungan plan berat beras per truk = "+ perhitungan_plan_berat_beras_pertruk);
                console.log("plan harga gabah ongkos dryer = "+ perhitungan_plan_harga_gabah_ongkos_dryer);
                console.log("plan harga pk perkilo = "+ perhitungan_plan_harga_pk_perkilo);
                console.log("plan harga beras perkilo = "+ perhitungan_plan_harga_beras_perkilo);
                console.log("plan total harga gabah pertruk = "+ perhitungan_plan_total_harga_gabah_pertruk);
                console.log("plan total harga pk pertruk = "+ perhitungan_plan_total_harga_pk_pertruk);
                console.log("plan total harga beras pertruk = "+ perhitungan_plan_total_harga_beras_pertruk);
            }
            plan_hargafin.value = hasil;
        }

        gabahincoming_id_penerimaan_po.addEventListener('keyup', function(e) {
            rumus();
        });
        kadar_air.addEventListener('keyup', function(e) {
            rumus();
        });
        ka_kg.addEventListener('keyup', function(e) {
            rumus();
        });
        berat_sample_awal_ks.addEventListener('keyup', function(e) {
            rumus();
        });
        berat_sample_awal_kg.addEventListener('keyup', function(e) {
            rumus();
        });
        berat_sample_akhir_kg.addEventListener('keyup', function(e) {
            rumus();
        });
        berat_sample_pk.addEventListener('keyup', function(e) {
            rumus();
        });
        randoman.addEventListener('keyup', function(e) {
            rumus();
        });
        wh.addEventListener('keyup', function(e) {
            rumus();
        });
        tp.addEventListener('keyup', function(e) {
            rumus();
        });
        md.addEventListener('keyup', function(e) {
            rumus();
        });
        broken.addEventListener('keyup', function(e) {
            rumus();
        });

        function funcaksiharga() {
            rumus();
        }


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
    </script>
@endsection
