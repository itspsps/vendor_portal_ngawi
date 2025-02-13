@extends('dashboard.admin.layout.main')
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
                    PT. SURYA PANGAN SEMESTA
                </h3>
                <span class="btn-outline btn-sm btn-info mr-3">NGAWI</span>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Plan PO
                    </a>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                       Gabah Kering
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
                                Gabah Kering
                            </h3>
                        </div>
                    </div>
                    <div class="">
                        <div class="kt-portlet__head-label">
                            <div class="m-portlet__body">
    							<ul class="nav nav-pills" role="tablist">
    								<li class="nav-item mt-3">
    									<a class="nav-link" data-toggle="tab" href="#m_tabs_3_1"><i class="la la-database"></i>PO Kemaren  ( <?php echo date('d-m-Y',strtotime("-1 days")); ?> )</a>
    								</li>
    								<li class="nav-item mt-3">
    									<a class="nav-link active" data-toggle="tab" href="#m_tabs_3_2"><i class="la la-database"></i>PO Hari Ini  ( <?php echo date('d-m-Y');?> )</a>
    								</li>
    							</ul>
    							<div class="tab-content">
    								<div class="tab-pane" id="m_tabs_3_1" role="tabpanel">
    								    <div class="kt-portlet__body col-12" >
                                            <table class="table table-bordered" id="po_kemarin" cellspacing="0" width="100%">
                                                <thead width="100%">
                                                    <tr>
                                                        <th style="text-align: center;width:2%">No</th>
                                                        <th style="text-align: center;width:18%">Kode&nbsp;PO</th>
                                                        <th style="text-align: center;width:18%">Tanggal&nbsp;PO </th>
                                                        <th style="text-align: center;width:18%">Mulai&nbsp;Penerimaan </th>
                                                        <th style="text-align: center;width:16%">Batas&nbsp;Penerimaan</th>
                                                        <th style="text-align: center;width:20%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align: center">
                                                </tbody>
                                            </table>
                                        </div>
    								</div>
    							    <div class="tab-pane active" id="m_tabs_3_2" role="tabpanel">
    									<div class="kt-portlet__body col-12">
                                            <table class="table table-bordered" id="datatable_sekarang" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center;width:2%">No</th>
                                                        <th style="text-align: center;width:18%">Kode&nbsp;PO</th>
                                                        <th style="text-align: center;width:18%">Tanggal&nbsp;PO </th>
                                                        <th style="text-align: center;width:18%">Mulai&nbsp;Penerimaan </th>
                                                        <th style="text-align: center;width:16%">Batas&nbsp;Penerimaan</th>
                                                        <th style="text-align: center;width:20%">Action</th>
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
                    </div>
                </div>
            </div>
        </div>

        <!-- end:: Content -->
    </div>
    
            <div class="modal fade" id="modal2" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form id="form_terimadatapo" class="m-form m-form--fit m-form--label-align-right" method="post"
                            action="{{route('security.terima_data_po')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Terima Data PO</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="penerimaan_id_data_po" id="id_data_po_sekarang" value="">
                                <input type="hidden" id="bid_user_sekarang" name="penerimaan_id_bid_user">
                                <div class="form-group">
                                    <div class="">
                                        <label>Penerima PO</label>
                                        <input id="name_bid" readonly value="{{Auth::user()->name}}" type="text" class="form-control m-input">
                                        <input type="hidden" required name="penerima_po" value="{{Auth::user()->id}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Waktu Kedatangan</label>
                                        <input id="harga" required name="waktu_penerimaan" readonly value="{{date('Y-m-d H:i:s')}}" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Kode PO</label>
                                        <input id="kode_po_sekarang" required name="penerimaan_kode_po" type="text" readonly class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Nopol</label>
                                        <input name="plat_kendaraan" required placeholder="A 12345 B" id="plat_kendaraan_sekarang" type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Keterangan</label>
                                        <input id="keterangan_penerimaan_po" name="keterangan_penerimaan_po" placeholder="Asal Gabah" required type="text"  class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label for="">Status</label><br>
                                        <input type="radio" required name="status_penerimaan" checked="checked" value="3">
                                        <label for="age2">Parking</label>
                                        <input type="radio" required disabled name="status_penerimaan" value="5">
                                        <label for="age2">Unparking</label>
                                    </div>
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
    
            <div class="modal fade" id="modal_po_ditolak" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form id="form_potelat" class="m-form m-form--fit m-form--label-align-right" method="post"
                            action="{{route('security.terima_data_po_telat')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Tolak PO</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="penerimaan_id_data_po" id="id_data_po_tolak" value="">
                                <input type="hidden" id="bid_user_tolak" name="penerimaan_id_bid_user">
                                <div class="form-group">
                                    <div class="">
                                        <label>Penerima PO</label>
                                        <input id="name_bid" readonly value="{{Auth::user()->name}}" type="text" class="form-control m-input">
                                        <input type="hidden" name="penerima_po" value="{{Auth::user()->id}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Waktu Kedatangan</label>
                                        <input id="harga" name="waktu_penerimaan" readonly value="{{date('Y-m-d H:i:s')}}" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Kode PO</label>
                                        <input id="kode_po_tolak" name="penerimaan_kode_po" type="text" readonly class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Nopol</label>
                                        <input name="plat_kendaraan" required type="text" maxlength="12" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Keterangan</label>
                                        <input name="keterangan_penerimaan_po" required type="text"  class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label for="">Status</label><br>
                                        <input type="radio" disabled required name="status_penerimaan" value="3">
                                        <label for="age2">Parkir</label>
                                        <input type="radio" required checked="checked" name="status_penerimaan" value="5">
                                        <label for="age2">Tidak Parkir</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Tutup</button>
                                <button id="btn_save1" type="submit" class="btn btn-success m-btn pull-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="modal_po_diterima" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right" method="post"
                            action="{{route('security.terima_data_po')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Terima PO</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="penerimaan_id_data_po" id="id_data_po_kemarin" value="">
                                <input type="hidden" id="bid_user_kemarin" name="penerimaan_id_bid_user">
                                <div class="form-group">
                                    <div class="">
                                        <label>Penerima PO</label>
                                        <input id="name_bid" readonly value="{{Auth::user()->name}}" type="text" class="form-control m-input">
                                        <input type="hidden" name="penerima_po" value="{{Auth::user()->id}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Waktu Kedatangan</label>
                                        <input id="harga" name="waktu_penerimaan" readonly value="{{date('Y-m-d H:i:s')}}" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Kode PO</label>
                                        <input id="kode_po_kemarin" name="penerimaan_kode_po" type="text" readonly class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Nopol</label>
                                        <input name="plat_kendaraan" required type="text" maxlength="12" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Keterangan</label>
                                        <input name="keterangan_penerimaan_po" required type="text"  class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label for="">Status</label><br>
                                        <input type="radio" checked="checked"  required name="status_penerimaan" value="3">
                                        <label for="age2">Parkir</label>
                                        <input type="radio" disabled  name="status_penerimaan" value="5">
                                        <label for="age2">Tidak Parkir</label>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-success m-btn pull-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    $( function () {
            var table = $('#po_kemarin').DataTable({
            responsive:true,
            });
        } );
    $(function() {
        var table = $('#datatable_sekarang').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('security.gabahkering_index_sekarang') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {data: 'kode_po'},
                {data: 'tanggal_po'},
                {data: 'mulai_penerimaan'},
                {data: 'batas_bid'},
                {data: 'ckelola'}

            ],
            "order": []
            });
        });
    $( function () {
            var table = $('#data_po').DataTable({
            responsive:true,
            });
        } );
</script>

    <script type="text/javascript">
        $(function() {
            $(document).on('click', '.toedit', function() {
                var id = $(this).attr("name");
                var url = '{{ route('security.show.penerimaan_po') }}' + "/" + id;
                console.log(url);
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        console.log(response);
                        var parsed = $.parseJSON(response);
                        $('#id_data_po_sekarang').val(parsed.id_data_po);
                        $('#kode_po_sekarang').val(parsed.kode_po);
                        $('#bid_user_sekarang').val(parsed.bid_user_id);
                        $('#plat_kendaraan_sekarang').val(parsed.plat_kendaraan);
                    }
                });
            });
        });
    </script>
    
    <script type="text/javascript">
        $(function() {
          
            $(document).on('click', '#btn_save1', function(e) {
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
                    $('#form_potelat').submit();
                    Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        
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
                    if($('#plat_kendaraan_sekarang').val()=='' | $('#keterangan_penerimaan_po').val()==''){
                    Swal.fire('Gagal!', 'Data Harus Terisi.', 'error')
                        
                    } else{
                    $('#form_terimadatapo').submit();
                    Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')
                }
                } else {
                    Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                }
            });
        });
        
            $(document).on('click', '.toterima', function() {
                var id = $(this).attr("name");
                var url = '{{ route('security.show.penerimaan_po') }}' + "/" + id;
                console.log(url);
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        console.log(response);
                        var parsed = $.parseJSON(response);
                        $('#id_data_po_kemarin').val(parsed.id_data_po);
                        $('#kode_po_kemarin').val(parsed.kode_po);
                        $('#bid_user_kemarin').val(parsed.bid_user_id);
                        $('#plat_kendaraan_kemarin').val(parsed.plat_kendaraan);
                    }
                });
            });
        });
    </script>
    
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '.totolak', function() {
                var id = $(this).attr("name");
                var url = '{{ route('security.show.penerimaan_po') }}' + "/" + id;
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        var parsed = $.parseJSON(response);
                        $('#id_data_po_tolak').val(parsed.id_data_po);
                        $('#kode_po_tolak').val(parsed.kode_po);
                        $('#bid_user_tolak').val(parsed.bid_user_id);
                    }
                });
            });
        });
    </script>
    
@endsection
