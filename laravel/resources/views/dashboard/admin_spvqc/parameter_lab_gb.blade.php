@extends('dashboard.admin_spvqc.layout.main')
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
                        Parameter Lab
                    </a>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-fast-next"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" onclick="return false" class="kt-subheader__breadcrumbs-link">
                        Gabah Basah
                    </a>
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
                                    <i class="flaticon2-add kt-font-info"></i> Tambah Parameter Gabah Basah
                                </div>
                            </div>
                            <div id="collapseOne4" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample4">
                                <div class="card-body">
                                    <form class="kt-form" id="kt_apps_user_add_user_form" action="{{ route('qc.spv.store_parameter_lab_gb') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                            <div class="kt-section kt-section--first">
                                                <div class="kt-wizard-v4__form">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="kt-section__body">
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Hampa</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="number" class="form-control" required name="hampa">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Broken</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="number" class="form-control" required name="broken">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Randoman</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="number" class="form-control" required name="randoman">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Kadar Air</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="number" class="form-control" required name="kadar_air">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">Tanggal</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input type="date" class="form-control" required name="tanggal">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-form__actions">
                                                    <button type="submit" class="btn btn-success m-btn pull-right" style="">Save</button>
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
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
            <div class="kt-portlet kt-portlet--mobile">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="flaticon2-box-1 kt-font-success"></i>
                        </span>
                        <h3 class="kt-portlet__head-title">
                            Data Parameter Lab Gabah Basah
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <table class="table table-bordered" id="table-parameter-lab">
                        <thead>
                            <tr>
                                <th style="text-align: center;width:2%">No</th>
                                <th style="text-align: center;width:auto">Hampa (TP)</th>
                                <th style="text-align: center;width:auto">Broken</th>
                                <th style="text-align: center;width:auto">Rendemen</th>
                                <th style="text-align: center;width:auto">Kadar Air</th>
                                <th style="text-align: center;width:auto">Tanggal</th>
                                <th style="text-align: center;width:auto">Action</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

            <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form class="m-form m-form--fit m-form--label-align-right" method="post" action="{{ route('qc.spv.update_parameter_lab_gb') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Update Data Parameter</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id_parameter" id="id_parameter" value="">
                                <div class="form-group">
                                    <div class="">
                                        <label>Hampa</label>
                                        <input id="hampa" required name="hampa" placeholder="" type="number" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Broken</label>
                                        <input id="broken" required name="broken" placeholder="" type="number" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Rendemen</label>
                                        <input id="randoman" required name="randoman" placeholder="" type="number" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Kadar Air</label>
                                        <input id="kadar_air" required name="kadar_air" placeholder="" type="number" class="form-control m-input">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="">
                                        <label>Tanggal</label>
                                        <input id="tanggal" required name="tanggal" placeholder="" type="date" class="form-control m-input">
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

    </div>
</div>

<!-- end:: Content -->
</div>
@endsection
@section('js')

<script>
    $(function() {
        var table = $('#table-parameter-lab').DataTable({
            "scrollY": true,
            "scrollX": true,
            processing: true,
            serverSide: true,
            "aLengthMenu": [
                [25, 100, 300, -1],
                [25, 100, 300, "All"]
            ],
            "iDisplayLength": 10,
            ajax: "{{ route('qc.spv.parameter_lab_gb_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'hampa'
                },
                {
                    data: 'broken'
                },
                {
                    data: 'randoman'
                },
                {
                    data: 'kadar_air'
                },
                {
                    data: 'tanggal'
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
        $(document).on('click', '.to_parameter', function() {
            var id = $(this).attr("name");
            var url = "{{ route('qc.spv.show_parameter_gb') }}" + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_parameter').val(parsed.id_parameter);
                    $('#hampa').val(parsed.hampa);
                    $('#broken').val(parsed.broken);
                    $('#randoman').val(parsed.randoman);
                    $('#kadar_air').val(parsed.kadar_air);
                    $('#tanggal').val(parsed.tanggal);
                }
            });
        });
    });
</script>

<script>
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });



    $(document).ready(function() {
        $('body').on('click', '#btnSave', function() {
            $('#btnSave').html('Menyimpan...');
            var hampa = $('#hampa').val();
            var broken = $('#broken').val();
            var randoman = $('#randoman').val();
            var kadar_air = $('#kadar_air').val();
            $.ajax({
                data: {
                    hampa: hampa,
                    broken: broken,
                    randoman: randoman,
                    kadar_air: kadar_air,
                },
                url: "{{ route('qc.spv.simpan_parameter_lab_gb') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {

                    table.draw();
                    $('#btnSave').html('Save');
                    $('#modal-parameter-lab').modal('hide');
                    custom_toas('success', 'Data Berhasil DiSimpan');

                },
                error: function(data) {
                    $('#btnSave').html('Simpan');
                    custom_toas('erorr', 'Data Gagal DiSimpan');

                }
            });

        });
    });

    function custom_toas(type, massage) {
        if (type == 'success') {
            toastr.success(massage, "Sukses", {
                timeOut: 5e3,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                progressBar: !0,
                positionClass: "toast-top-right",
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1
            })
        } else if (type == 'erorr') {
            toastr.error(massage, "Erorr", {
                positionClass: "toast-top-right",
                timeOut: 5e3,
                closeButton: !0,
                debug: !1,
                newestOnTop: !0,
                progressBar: !0,
                preventDuplicates: !0,
                onclick: null,
                showDuration: "300",
                hideDuration: "1000",
                extendedTimeOut: "1000",
                showEasing: "swing",
                hideEasing: "linear",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
                tapToDismiss: !1
            })
        }
    }
</script>
@endsection