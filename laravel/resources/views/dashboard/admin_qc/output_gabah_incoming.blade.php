@extends('dashboard.admin_qc.layout.main')
@section('title')
SURYA PANGAN SEMESTA
@endsection
@section('content')
@include('sweetalert::alert')
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
                            <span class="btn-outline btn-sm btn-info">Site Ngawi</span>
                            Hasil Lab 1
                        </h3>
                    </div>
                    
                </div>
                 <form class="" method="post" action="{{route('qc.lab.download_output_lab1_excel')}}" enctype="multipart/form-data">
                <div style="margin-left: 10px; margin-top:10px;" class="row input-daterange">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                    <div class="col-md-4">
                        <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
                    </div>
                    <div class="col-md-4">
                        <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                        <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                        <button type="submit" name="btn_export" id="btn_export" class="btn btn-success"><i class="fa fa-file-excel"></i>Excel</button>
                    </div>
                </div>
                    </form>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%">No</th>
                                <th style="text-align: center;width:auto">Kode&nbsp;PO</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Supplier&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">Sampai&nbsp;Disatpam</th>
                                <th style="text-align: center;width:auto">Tanggal&nbsp;PO </th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nopol&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">Asal</th>
                                <th style="text-align: center;width:auto">Lokasi&nbsp;Bongkar</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:auto">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="text-align: center;width:20px">KA&nbsp;KS</th>
                                <th style="text-align: center;width:20px">KA&nbsp;KG</th>
                                <th style="text-align: center;width:20px">Berat&nbsp;Sample&nbsp;Awal&nbsp;KS</th>
                                <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Awal&nbsp;KG</th>
                                <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Akhir&nbsp;KG </th>
                                <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;PK </th>
                                <th style="text-align: center;width:auto">Berat&nbsp;Sample&nbsp;Beras </th>
                                <th style="text-align: center;width:auto">WH </th>
                                <th style="text-align: center;width:auto">TP </th>
                                <th style="text-align: center;width:auto">MD </th>
                                <th style="text-align: center;width:auto">BROKEN </th>

                                <th style="text-align: center;width:auto">Hampa&nbsp;(%) </th>
                                <th style="text-align: center;width:auto">KG&nbsp;After&nbsp;Adjust&nbsp;Hampa</th>
                                <th style="text-align: center;width:auto">(%)&nbsp;KG</th>
                                <th style="text-align: center;width:auto">(%)&nbsp;Susut</th>
                                <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;Susut&nbsp;1,2</th>
                                <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;-&nbsp;KG&nbsp;After&nbsp;Adjust&nbsp;Susut</th>
                                <th style="text-align: center;width:auto">(%)&nbsp;KG&nbsp;-&nbsp;PK</th>
                                <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;-&nbsp;PK&nbsp;0,9952</th>
                                <th style="text-align: center;width:auto">(%)&nbsp;KS&nbsp;-&nbsp;PK</th>
                                <th style="text-align: center;width:auto">(%)&nbsp;Putih</th>
                                <th style="text-align: center;width:auto">Adjust&nbsp;(%)&nbsp;KG&nbsp;-&nbsp;Putih&nbsp;0,952</th>
                                <th style="text-align: center;width:auto">Plan&nbsp;Rend&nbsp;KS&nbsp;-&nbsp;Beras</th>
                                <th style="text-align: center;width:auto">Katul</th>
                                <th style="text-align: center;width:auto">Refraksi&nbsp;Broken&nbsp;(Rp)</th>
                                <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Gabah&nbsp;(Rp/Kg)</th>
                                <th style="text-align: center;width:auto">Plan&nbsp;Harga&nbsp;Gabah</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_to_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form_edit" class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('qc.lab.update_gabah_incoming_qc') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Lab 1</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="gabahincoming_id_data_po" id="penerimaan_id_data_po" value="">
                    <input type="hidden" name="gabahincoming_id_penerimaan_po" id="gabahincoming_id_penerimaan_po">
                    <input type="hidden" id="id_gabahincoming_qc" name="id_gabahincoming_qc">
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
                    <input type="hidden" id="lokasibongkar" name="lokasibongkar">
                    <input type="hidden" id="tanggal_po" name="tanggal_po">
                    <input type="hidden" id="date_bid" name="date_bid">

                    <div class="form-group">
                        <div class="">
                            <label>Code PO</label>
                            <input type="text" id="gabahincoming_kode_po" name="gabahincoming_kode_po" class="form-control m-input" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <label>Nopol</label>
                            <input type="text" id="gabahincoming_plat" readonly name="gabahincoming_plat" class="form-control m-input">
                        </div>
                    </div>
                    <input type="hidden" name="beras_hitam" value="1">
                    <input type="hidden" name="beras_kusam" value="1">
                    <input type="hidden" name="biji_mati" value="1">
                    <input type="hidden" name="semu" value="1">
                    <input type="hidden" name="kuning" value="1">
                    <input type="hidden" name="mletik_semu" value="1">
                    <input type="hidden" name="gabah_hitam" value="1">
                    <input type="hidden" name="gabah_sungutan" value="1">
                    <input type="hidden" name="gabah_kopong" value="1">
                    <input type="hidden" name="aroma_gabah" value="1">
                    <input type="hidden" name="kotoran_gabah" value="1">
                    <div id="planhpp" class="form-group">
                        </div>
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
                        <label for="">Berat Sample Awal KG</label>
                        <input type="number" step="any" required name="berat_sample_awal_kg" id="berat_sample_awal_kg" class="form-control m-input">
                    </div>
                    <div class="m-form__group form-group">
                        <label for="">Berat Sample Akhir KG</label>
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
                        <label for="">Lab Result Information </label>
                        <select class="form-select form-control m-input" onchange="yesnoCheck(this);" id="keterangan_lab_1" required name="keterangan_lab_1" aria-label="Default select example">
                            <option value="">--Output Lab 1--</option>
                            <option name="keterangan_lab_1" value="Unload">Unload</option>
                            <option name="keterangan_lab_1" value="Pending">Pending</option>
                            <option name="keterangan_lab_1" value="Reject">Reject</option>
                        </select>
                    </div>
                    <div class="m-form__group form-group" id="ifYes" style="display: none;">
                        <label>Location</label>
                        <div class="kt-radio-inline">
                            <label class="kt-radio">
                                <input type="radio" value="GT" onclick="newprice()" class="form-control m-input" name="lokasi_gt"> GT
                                <span></span>
                            </label>
                            <label class="kt-radio">
                                <input type="radio" value="04" onclick="newprice()" class="form-control m-input" name="lokasi_gt"> 04
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="m-form__group form-group">
                        <label for="">Keterangan</label>
                        <input type="text" step="any" required name="keterangan_lab1" id="keterangan_lab1" class="form-control m-input">
                    </div>
                    <div class="m-form__group form-group">
                        <label for="">Plan Harga (Kg)</label>
                        <input readonly type="number" step="any" required name="plan_harga" id="plan_harga" class="form-control m-input">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                    <button id="btn_update" type="submit" class="btn btn-success m-btn pull-right">Save</button>
                </div>
            </form>
        </div>
    </div>
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
    $(document).ready(function() {
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        load_data();

        function load_data(from_date = '', to_date = '') {
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
                ajax: {
                    url : "{{ route('qc.lab.output_lab1_gb_index') }}",
                },
                columns: [{
                        data: "id_bid",

                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'kode_po'
                    },
                    {
                        data: 'nama_vendor'
                    },
                    {
                        data: 'waktu_penerimaan'
                    },
                    {
                        data: 'tanggal_po'
                    },
                    {
                        data: 'plat_kendaraan'
                    },
                    {
                        data: 'asal_gabah'
                    },
                    {
                        data: 'lokasi_bongkar'
                    },
                    {
                        data: 'plan_harga'
                    },
                    {
                        data: 'ckelola'
                    },

                    {
                        data: 'kadar_air'
                    },
                    {
                        data: 'ka_kg'
                    },
                    {
                        data: 'berat_sample_awal_ks'
                    },
                    {
                        data: 'berat_sample_awal_kg'
                    },
                    {
                        data: 'berat_sample_akhir_kg'
                    },
                    {
                        data: 'berat_sample_pk'
                    },
                    {
                        data: 'berat_sample_beras'
                    },
                    {
                        data: 'wh'
                    },
                    {
                        data: 'tp'
                    },
                    {
                        data: 'md'
                    },
                    {
                        data: 'broken'
                    },
                    {
                        data: 'hampa'
                    },
                    {
                        data: 'kg_after_adjust_hampa'
                    },
                    {
                        data: 'prosentasi_kg'
                    },
                    {
                        data: 'susut'
                    },
                    {
                        data: 'adjust_susut'
                    },
                    {
                        data: 'prsentase_ks_kg_after_adjust_susut'
                    },
                    {
                        data: 'prsentase_kg_pk'
                    },
                    {
                        data: 'adjust_prosentase_kg_pk'
                    },
                    {
                        data: 'presentase_ks_pk'
                    },
                    {
                        data: 'presentase_putih'
                    },
                    {
                        data: 'adjust_prosentase_kg_ke_putih'
                    },
                    {
                        data: 'plan_rend_dari_ks_beras'
                    },
                    {
                        data: 'katul'
                    },
                    {
                        data: 'refraksi_broken'
                    },
                    {
                        data: 'plan_harga_gabah'
                    },
                    {
                        data: 'plan_harga_beli_gabah'
                    },


                ],
                "order": []
            });
        }
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();

            if (from_date != '' && to_date != '') {
                $('#datatable').DataTable().destroy();
                load_data(from_date, to_date);
                Swal.fire({
                    title: 'Berhasil', 
                    text: 'Sukses filter data', 
                    icon: 'success',
                    timer: 1500
                    })
            } else {
                Swal.fire({
                    title: 'Infoo!!', 
                    text: 'Mohon Isikan data', 
                    icon: 'warning',
                    timer: 1500
                    })
            }

        });

        $('#refresh').click(function() {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#datatable').DataTable().destroy();
            load_data();
        });
    });
</script>
<script type="text/javascript">
    $(function() {
        $(document).on('click', '#to_edit', function() {
            var id = $(this).attr("name");
            var tanggal_po = $(this).data('tanggal_po');
            var url = "{{ route('qc.lab.edit_lab1') }}" + "/" + id;
            var url2 = "{{route('qc.lab.get_plan_hpp') }}" + "/"+ tanggal_po;
            console.log(tanggal_po);
              $('#form_edit').trigger('reset');
            //   $('#modal2').removeData();
            //   location.reload();
               $('#modal_to_edit').on('hidden.bs.modal', function (e) {   
            location.reload();
            $('#modal_to_edit').show();
        })
            $('#modal_to_edit').modal('show');
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);

                    $('#gabahincoming_id_penerimaan_po').val(parsed.gabahincoming_id_penerimaan_po);
                    $('#id_gabahincoming_qc').val(parsed.id_gabahincoming_qc);
                    $('#gabahincoming_kode_po').val(parsed.gabahincoming_kode_po);
                    $('#gabahincoming_plat').val(parsed.gabahincoming_plat);
                    $('#kadar_air').val(parsed.kadar_air1);
                    $('#ka_kg').val(parsed.ka_kg1);
                    $('#berat_sample_awal_ks').val(parsed.berat_sample_awal_ks1);
                    $('#berat_sample_awal_kg').val(parsed.berat_sample_awal_kg1);
                    $('#berat_sample_akhir_kg').val(parsed.berat_sample_akhir_kg1);
                    $('#berat_sample_pk').val(parsed.berat_sample_pk1);
                    $('#randoman').val(parsed.randoman1);
                    $('#wh').val(parsed.wh1);
                    $('#tp').val(parsed.tp1);
                    $('#md').val(parsed.md1);
                    $('#broken').val(parsed.broken1);
                    $('#keterangan_lab1').val(parsed.keterangan_lab1);
                    $('#keterangan_lab_1').val(parsed.output_lab1);
                    console.log(parsed.output_lab1);
                    $('#lokasibongkar').val(parsed.lokasi_bongkar1);
                    $('#date_bid').val(parsed.date_bid);
                    $('#tanggal_po').val(parsed.tanggal_po);
                    $('.lokasi_gt').val(parsed.lokasi_bongkar1);
                    if((parsed.output_lab1)=='Unload'){
                    document.getElementById("ifYes").style.display = "block";
                    } else{
                    document.getElementById("ifYes").style.display = "none";
                        
                    }

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
<script type="text/javascript">
    $(function() {
        $(document).on('click', '#btn_update', function(e) {
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
                    if($('#kadar_air').val()=='' | $('#ka_kg').val()=='' | $('#berat_sample_awal_ks').val()=='' | $('#berat_sample_awal_kg').val()=='' | $('#berat_sample_akhir_kg').val()=='' | $('#berat_sample_pk').val()=='' | $('#randoman').val()=='' | $('#wh').val()=='' | $('#tp').val()=='' | $('#md').val()=='' | $('#keterangan_lab_1').val()=='' | $('#broken').val()=='' ){
                    Swal.fire('Mohon Dicek!', 'Ada data yang belum terisi.', 'error')  
                    } else if($('#plan_harga').val()=='' | $('#plan_harga').val()=='0'){
                    Swal.fire('Mohon Dicek!', 'Top Price, Price GT/04 dan Plan Hpp harap disi sesuai tanggal PO', 'warning')
                    } else{
                    $('#form_edit').submit();
                    Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                    }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '#btn_bongkar', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Konfirmasi',
                icon: 'warning',
                text: "Apakah Kamu Yakin Data Sudah Benar ?",
                showCancelButton: true,
                inputValue: 0,
                confirmButtonText: 'Yes',
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "GET",
                        url: "{{route('qc.lab.approve_lab1') }}/" + id,
                        error: function() {
                            alert('Something is wrong');
                        },
                        success: function(data) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data anda berhasil di Simpan.',
                                icon: 'success', 
                                timer: 1500
                            })
                            $('#datatable').DataTable().ajax.reload();
                        }
                    });

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        $(document).on('click', '.lokasi_bongkar', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.lab.lokasi_bongkar') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#lokasi_bongkar').text(parsed.lokasi_bongkar);
                    $('#nomer_antrian').text(parsed.antrian);
                }
            });
        });
    });
</script>

<script>
    var get_id_penerimaan = document.getElementById('id_penerimaan_po');

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

    var plan_harga = document.getElementById('plan_harga');

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
            var id_penerimaan = gabahincoming_id_penerimaan_po.value;
            kg_after_adjust_hampa.value = berat_sample_akhir_kg.value;
            var perhitungan_prosentasi_kg = parseFloat(kg_after_adjust_hampa.value) / 1.5
            prosentasi_kg.value = round(perhitungan_prosentasi_kg, 2);
            var perhitungan_susut = 100 - prosentasi_kg.value
            susut.value = round(perhitungan_susut, 2);
            var perhitungan_adjust_susut = susut.value * 1.2;
            adjust_susut.value = round(perhitungan_adjust_susut, 2);
            var perhitungan_prsentase_ks_kg_after_adjust_susut = 100 - adjust_susut.value;
            prsentase_ks_kg_after_adjust_susut.value = round(perhitungan_prsentase_ks_kg_after_adjust_susut, 2);
            var perhitungan_prsentase_kg_pk = (berat_sample_pk.value / (kg_after_adjust_hampa.value / 100));
            prsentase_kg_pk.value = round(perhitungan_prsentase_kg_pk, 2);
            var perhitungan_adjust_prosentase_kg_pk = prsentase_kg_pk.value * 0.952;
            adjust_prosentase_kg_pk.value = round(perhitungan_adjust_prosentase_kg_pk, 2);
            var perhitungan_presentase_ks_pk = prsentase_ks_kg_after_adjust_susut.value * (adjust_prosentase_kg_pk
                .value / 100);
            presentase_ks_pk.value = round(prsentase_ks_kg_after_adjust_susut.value * (adjust_prosentase_kg_pk.value / 100), 2);
            var perhitungan_presentase_putih = randoman.value / (kg_after_adjust_hampa.value / 100);
            presentase_putih.value = round(perhitungan_presentase_putih, 2);
            var perhitungan_adjust_prosentase_kg_ke_putih = presentase_putih.value * 0.952;
            adjust_prosentase_kg_ke_putih.value = round(perhitungan_adjust_prosentase_kg_ke_putih, 2);
            var perhitungan_plan_rend_dari_ks_beras = (100 - adjust_susut.value) * (adjust_prosentase_kg_ke_putih
                .value / 100);
            plan_rend_dari_ks_beras.value = round(perhitungan_plan_rend_dari_ks_beras, 2);
            var perhitungan_katul = ((adjust_prosentase_kg_pk.value - adjust_prosentase_kg_ke_putih.value) /
                adjust_prosentase_kg_pk.value) * 100;
            katul.value = round(perhitungan_katul, 2);

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
                    console.log(elems);
                
                var std_hpp_incoming = 0;
                [].forEach.call(elems, function(el) {
                    var plan_hpp = el.value;
                    arr_hpp = plan_hpp.split("#");
                    // console.log(arr_hpp[0]);
                    if (tp.value >= arr_hpp[0] && tp.value < arr_hpp[1]) {
                        std_hpp_incoming = arr_hpp[2];
                    console.log(std_hpp_incoming);
                    }
                
//                     }

                });

            var perhitungan_plan_harga_gabah = ((plan_rend_dari_ks_beras.value / 100) * std_hpp_incoming) - 75;
            plan_harga_gabah.value = round(perhitungan_plan_harga_gabah, 2);

            $.ajax({
                type: "GET",
                url: "{{route('get_price_gt4')}}" + "/" + id_penerimaan,
                async: false,
                success: function(data) {
                    var record = JSON.parse(data);
                    potongan = record.potongan_bongkar_gt_04;
                    console.log(potongan);
                }
            });

            var status_gabah = "GT";
            var tr = 2.00;
            var potong = potongan;

            if (plan_harga_gabah.value == 0 || plan_harga_gabah.value == '') {
                hasil = "0";
            } else {
                if (status_gabah == "G. 04" && tp.value > tr) {
                    var perhitungan_hasil = plan_harga_gabah.value - refraksi_broken.value - potong;
                    hasil = round(perhitungan_hasil, 2);
                } else {
                    var perhitungan_hasil = plan_harga_gabah.value - refraksi_broken.value;
                    hasil = round(perhitungan_hasil);

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
            console.log("hasil akhir = " + hasil)
        }
        plan_harga.value = hasil;

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

    var changeprice = false;

    function newprice() {
        var id_penerimaan = gabahincoming_id_penerimaan_po.value;
        var radio = document.getElementsByName('lokasi_gt');
        var harga = document.getElementById('plan_harga').value;
        var potongan = 0;
        var hargabaru = 0;
        $.ajax({
            type: "GET",
            url: "{{route('get_price_gt4')}}" + "/" + id_penerimaan,
            async: false,
            success: function(data) {
                var record = JSON.parse(data);
                potongan = record.potongan_bongkar_gt_04;
            }
        });

        for (i = 0; i < radio.length; i++) {
            if (radio[i].checked) {
                if (radio[i].value == '04') {
                    hargabaru = harga - potongan;
                    changeprice = true;
                } else {
                    if (changeprice == false) {
                        hargabaru = harga;
                    } else {
                        hargabaru = parseInt(harga) + parseInt(potongan);
                        changeprice = true;
                    }
                }
                // console.log(hargabaru,potongan);
                document.getElementById('plan_harga').value = hargabaru;
            }
        }
    }
</script>
@endsection