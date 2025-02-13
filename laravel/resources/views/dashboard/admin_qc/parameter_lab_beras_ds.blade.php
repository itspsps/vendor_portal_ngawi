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
        <div class="row">
            <div class="col-lg-12">
                <div class="kt-portlet kt-callout kt-callout--brand kt-callout--diagonal-bg">
                    <div class="kt-portlet__body">
                        <div class="kt-callout__body">
                            <div class="kt-callout__content">
                                <h3 class="kt-callout__title">Tidak ada parameter</h3>
                                <p class="kt-callout__desc">
                                    Beras DS
                                </p>
                            </div>
                            <div class="kt-callout__action">
                                <a href="#" data-toggle="modal" data-target="#kt_chat_modal" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-brand">SPS</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="col-lg-6">-->
            <!--	<div class="kt-portlet kt-callout kt-callout--success kt-callout--diagonal-bg">-->
            <!--		<div class="kt-portlet__body">-->
            <!--    		<div class="kt-callout__body">-->
            <!--				<div class="kt-callout__content">-->
            <!--					<h3 class="kt-callout__title">Phone Call</h3>-->
            <!--						<p class="kt-callout__desc">-->
            <!--							Windows 10 automatically installs updates to make for sure-->
            <!--						</p>-->
            <!--				</div>-->
            <!--				<div class="kt-callout__action">-->
            <!--					<a href="#" data-toggle="modal" data-target="#kt_chat_modal" class="btn btn-custom btn-bold btn-upper btn-font-sm  btn-success">Make Call</a>-->
            <!--				</div>-->
            <!--			</div>-->
            <!--		</div>-->
            <!--	</div>-->
            <!--</div>-->
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
            ajax: "{{ route('qc.lab.parameter_lab_pk_reward_tr_index') }}",
            columns: [{
                    data: "id_bid",

                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'value_parameter_lab_pk_reward_tr'
                },
                {
                    data: 'reward_parameter_lab_pk_reward_tr'
                },
                {
                    data: 'formula_parameter_lab_pk_reward_tr'
                },
                {
                    data: 'tanggal_parameter_lab_pk_reward_tr'
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
            var url = '{{ route('
            qc.lab.parameter_lab_pk_reward_tr_show ') }}' + "/" + id;
            console.log(url);
            $.ajax({
                type: "GET",
                url: url,
                success: function(response) {
                    console.log(response);
                    var parsed = $.parseJSON(response);
                    $('#id_parameter_lab_pk_reward_tr').val(parsed.id_parameter_lab_pk_reward_tr);
                    $('#value_parameter_lab_pk_reward_tr').val(parsed.value_parameter_lab_pk_reward_tr);
                    $('#reward_parameter_lab_pk_reward_tr').val(parsed.reward_parameter_lab_pk_reward_tr);
                    $('#formula_parameter_lab_pk_reward_tr').val(parsed.formula_parameter_lab_pk_reward_tr);
                    $('#tanggal_parameter_lab_pk_reward_tr').val(parsed.tanggal_parameter_lab_pk_reward_tr);
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
            var value_parameter_lab_pk_reward_tr = $('#value_parameter_lab_pk_reward_tr').val();
            var reward_parameter_lab_pk_reward_tr = $('#reward_parameter_lab_pk_reward_tr').val();
            var formula_parameter_lab_pk_reward_tr = $('#formula_parameter_lab_pk_reward_tr').val();
            var tanggal_parameter_lab_pk_reward_tr = $('#tanggal_parameter_lab_pk_reward_tr').val();
            $.ajax({
                data: {
                    value_parameter_lab_pk_reward_tr: value_parameter_lab_pk_reward_tr,
                    reward_parameter_lab_pk_reward_tr: reward_parameter_lab_pk_reward_tr,
                    formula_parameter_lab_pk_reward_tr: formula_parameter_lab_pk_reward_tr,
                    tanggal_parameter_lab_pk_reward_tr: tanggal_parameter_lab_pk_reward_tr,
                },
                url: "{{ route('qc.lab.parameter_lab_pk_reward_tr_store') }}",
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