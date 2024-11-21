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
                                    <i class="flaticon-add-circular-button"></i> Tambah Berita
                                </div>
                            </div>
                            <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4">
                                <div class="card-body">
                                    <form class="kt-form" id="kt_apps_user_add_user_form" action="{{ route('sourching.news_store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-wizard-v4__form">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="kt-section__body">
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Kategori
                                                                        Berita</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <select name="kategori" class="custom-select form-control">
                                                                            <option selected="">Kategori</option>
                                                                            <option value="pangan_pertanian">Pangan
                                                                                Pertanian</option>
                                                                            <option value="teknologi_inovasi">Teknologi
                                                                                Inovasi</option>
                                                                            <option value="ekonomi_perdagangan">Ekonomi
                                                                                Perdagangan</option>
                                                                            <option value="international">International
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Judul
                                                                        Berita</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="text" class="form-control" name="judul_berita">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Gambar</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="file" class="form-control" name="gambar">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Waktu</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="date" class="form-control" name="waktu">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Isi
                                                                        Berita</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <textarea class="form-control" name="isi_berita"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Status</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="radio" id="appoved" name="status" value="1">
                                                                        <label for="age2">Active</label>
                                                                        <input type="radio" id="appoved" name="status" value="0">
                                                                        <label for="age2">Not Active</label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-form__actions">
                                                    <button type="submit" class="btn btn-success m-btn pull-right" style="">Submit</button>
                                                </div><br>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
                            Berita
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th style="text-align: center">No</th>
                                <th style="text-align: center;">Berita</th>
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

        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('sourching.vendor_update') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Update Data Berita</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_news" id="id_news" value="">
                            <div class="form-group">
                                <div class="">
                                    <label>Judul Berita</label>
                                    <input id="judul_berita" name="judul_berita" placeholder="" type="text" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Gambar</label>
                                    <input id="" name="gambar" placeholder="" type="file" class="form-control m-input">
                                    <div id="gambar"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Waktu</label>
                                    <input id="waktu" name="waktu" placeholder="" type="date" class="form-control m-input">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <label>Isi Berita</label>
                                    <textarea id="isi_berita" name="isi_berita" placeholder="" type="text" class="form-control m-input"></textarea>
                                </div>
                            </div>    
                            <div class="modal-footer">
                                    <button type="submit" class="btn btn-success m-btn pull-right">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
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
                ajax: "{{ route('sourching.news_index') }}",
                columns: [{
                        data: "id",

                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'judul_berita'
                    },
                    {
                        data: 'gambar'
                    },
                    {
                        data: 'waktu'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'ckelola'
                    },

                ],
                "order": []
            });
        });
</script>
    <script type="text/javascript">
        $(function() {
            $(document).on('click', '.toedit', function() {
                var id = $(this).attr("name");
                var url = "{{ route('sourching.news_show') }}" + "/" + id;

                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        var parsed = $.parseJSON(response);
                        var image = parsed.gambar;
                        $('#id_news').val(parsed.id_news);
                        $('#judul_berita').val(parsed.judul_berita);
                        $('#isi_berita').val(parsed.isi_berita);
                        $('#waktu').val(parsed.waktu);
                        $('#gambar').empty();
                        if (image !== null) {
                            $('#gambar').append(
                                '<div class="col-md-12 col-lg-4"><img src="http://127.0.0.1:8000/img/berita/' +
                                image + '" width="100%" /></div>');
                        }
                    }
                });
            });
        });
    </script>
@endsection