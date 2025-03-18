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
                        <!--begin::Accordion-->
                        <div class="accordion  accordion-toggle-arrow" id="accordionExample4">
                            <div class="card">
                                <div class="card-header" id="headingOne4">
                                    <div class="card-title" data-toggle="collapse" data-target="#collapseOne4"
                                        aria-expanded="false" aria-controls="collapseOne4">
                                        <i class="flaticon-add-circular-button"></i> Tambah Populer
                                    </div>
                                </div>
                                <div id="collapseOne4" class="collapse" aria-labelledby="headingOne"
                                    data-parent="#accordionExample4">
                                    <div class="card-body">
                                        <form class="kt-form" id="kt_apps_user_add_user_form" action="{{ route('sourching.populer_store') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content"
                                                data-ktwizard-state="current">
                                                <div class="kt-section kt-section--first">
                                                    <div class="kt-wizard-v4__form">
                                                        <div class="row">
                                                            <div class="col-xl-12">
                                                                <div class="kt-section__body">
                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">Judul Populer</label>
                                                                        <div class="col-lg-9 col-xl-9">
                                                                            <input type="text" class="form-control" name="judul_populer">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">Gambar Populer</label>
                                                                        <div class="col-lg-9 col-xl-9">
                                                                            <input type="file" class="form-control" name="gambar_populer">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">Waktu Populer</label>
                                                                        <div class="col-lg-9 col-xl-9">
                                                                            <input type="date" class="form-control" name="waktu_populer">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">Keterangan Populer</label>
                                                                        <div class="col-lg-9 col-xl-9">
                                                                            <textarea class="form-control" name="keterangan_populer"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-xl-3 col-lg-3 col-form-label">Status Populer</label>
                                                                        <div class="col-lg-9 col-xl-9">
                                                                            <input type="radio" id="appoved" name="status_populer" value="1">
                                                                            <label for="age2">Aktif</label>
                                                                            <input type="radio" id="appoved" name="status_populer" value="0">
                                                                            <label for="age2">Tidak Aktif</label>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="kt-form__actions">
                                                        <button type="submit" class="btn btn-success m-btn pull-right"
                                                            style="">Submit</button>
                                                    </div><br>
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

            <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="flaticon-user"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                Populer
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center;">Judul</th>
                                    <th style="text-align: center;">Gambar</th>
                                    <th style="text-align: center">Waktu</th>
                                    <th style="text-align: center">Status</th>
                                    <th style="text-align: center">Action</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('sourching.populer_update') }}"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Data Populer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id_populer" id="id_populer" value="">
                                <input type="hidden" name="status_populer" id="status_populer">
                                <div class="form-group">
                                    <div class="">
                                        <label>Judul Populer</label>
                                        <input id="judul_populer" name="judul_populer" placeholder=""
                                            type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Gambar</label>
                                        <input id="" name="gambar_populer" placeholder=""
                                            type="file" class="form-control m-input">
                                            <div id="gambar_populer"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Isi Berita</label>
                                        <input id="keterangan_populer" name="keterangan_populer" placeholder=""
                                        type="text" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Waktu</label>
                                        <input id="waktu_populer" name="waktu_populer" placeholder=""
                                        type="date" class="form-control m-input">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(function () {
         var table = $('#datatable').DataTable({
             "scrollY": true,
             "scrollX": true,
             processing: true,
             serverSide: true,
             "aLengthMenu": [[25, 100, 300, -1], [25, 100, 300, "All"]],
             "iDisplayLength": 10,
             ajax: "{{ route('sourching.populer_index') }}",
             columns: [
                     {
                     data: "id",

                     render: function (data, type, row, meta) {
                         return meta.row + meta.settings._iDisplayStart + 1;
                     }
                 },
                     {data: 'judul_populer'},
                     {data: 'gambar_populer'},
                     {data: 'waktu_populer'},
                     {data: 'status_populer'},
                     {data: 'ckelola'},

             ],
             "order": []
         });
     });
 </script>

<script type="text/javascript">
    $(function(){
        $(document).on('click','.toedit',function(){
            var id= $(this).attr("name");
            var url= '{{ route('sourching.populer_show') }}'+"/"+id;
            console.log(url);

            $.ajax({
                type: "GET",
                url: url,
                success: function(response){
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    var image = parsed.gambar_populer;
                    $('#id_populer').val(parsed.id_populer);
                    $('#status_populer').val(parsed.status_populer);
                    $('#judul_populer').val(parsed.judul_populer);
                    $('#keterangan_populer').val(parsed.keterangan_populer);
                    $('#waktu_populer').val(parsed.waktu_populer);
                    $('#gambar_populer').empty();
					if(image !== null){
							$('#gambar_populer').append('<div class="col-md-12 col-lg-4"><img src="http://127.0.0.1:8000/img/populer/'+image+'" width="100%" /></div>');
					}
                }
            });
        });
    });
</script>
@endsection
