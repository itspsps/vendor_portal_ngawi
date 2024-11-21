@extends('dashboard.admin_master.layout.main')
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
                    VENDOR
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

            <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="flaticon-user"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                Detail Data Vendor
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="m-portlet m-portlet--tab">
                            <div class="m-portlet__body">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" data-toggle="tab" href="#m_tabs_1_1">
                                            <i class="la la-credit-card"></i> NPWP
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#m_tabs_1_2">
                                            <i class="la la-cc-discover"></i> KTP
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#m_tabs_1_3">
                                            <i class="la la-money"></i> PEMBAYARAN
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#m_tabs_1_4">
                                            <i class="la la-user"></i> PROFIL
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="m_tabs_1_1" role="tabpanel">
                                        <form id="form_update_npwp" action="{{route('master.vendor_update_npwp')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="m-portlet__body">
                                                <div class="form-group m-form__group row">
                                                    <input type="hidden" value="{{$data->id}}" id="npwp_id_vendor" name="npwp_id_vendor">
                                                    <label for="example-text-input" class="col-2 col-form-label">Nama NPWP</label>
                                                    <div class="col-10">
                                                        <input class="form-control m-input" type="text" id="nama_npwp" name="nama_npwp" value="{{$data->nama_npwp}}" id="example-text-input">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="example-search-input" class="col-2 col-form-label">Nomer NPWP</label>
                                                    <div class="col-10">
                                                        <input class="form-control m-input" type="text" id="npwp" name="npwp" value="{{$data->npwp}}" id="example-search-input">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="example-email-input" class="col-2 col-form-label">Provinsi</label>
                                                    <div class="col-10">
                                                        <select class="form-control m-input" name="id_provinsinpwp" required="required" id="provinsi_npwp">
                                                            <option value="">Pilih Provinsi...</option>
                                                            <?php
                                                            $prov = App\Models\Province::all();
                                                            ?>
                                                            @foreach ($prov as $provinsi)
                                                            <option value="{{$provinsi->id}}" {{($provinsi->id == $data->id_provinsinpwp) ? 'selected' : ''}}>{{$provinsi->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="example-url-input" class="col-2 col-form-label">Kabupaten</label>
                                                    <div class="col-10">
                                                        <?php
                                                        $kab = App\Models\Regency::Where('province_id', $data->id_provinsinpwp)->get();
                                                        // echo $kab;
                                                        ?>
                                                        <select class="form-control m-input" required="required" name="id_kabupatennpwp" id="kabupaten_npwp">
                                                            <option>Pilih Kabupaten...</option>
                                                            @foreach ($kab as $kabupaten)
                                                            <option value="{{$kabupaten->id}}" {{($kabupaten->id == $data->id_kabupatennpwp) ? 'selected' : ''}}>{{$kabupaten->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="example-tel-input" class="col-2 col-form-label">Kecamatan</label>
                                                    <div class="col-10">
                                                        <?php
                                                        $kec = App\Models\District::Where('regency_id', $data->id_kabupatennpwp)->get();
                                                        // echo $kec;
                                                        ?>
                                                        <select class="form-control m-input " required="required" name="id_kecamatannpwp" id="kecamatan_npwp">
                                                            <option>Pilih Kecamatan...</option>
                                                            @foreach ($kec as $kecamatan)
                                                            <option value="{{$kecamatan->id}}" {{($kecamatan->id == $data->id_kecamatannpwp) ? 'selected' : ''}}>{{$kecamatan->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="example-tel-input" class="col-2 col-form-label">Desa/Kelurahan</label>
                                                    <div class="col-10">
                                                        <?php
                                                        $desa = App\Models\Village::Where('district_id', $data->id_kecamatannpwp)->get();
                                                        // echo $kec;
                                                        ?>
                                                        <select class="form-control m-input " required="required" name="id_desanpwp" id="desa_npwp">
                                                            <option>Pilih Desa...</option>
                                                            @foreach ($desa as $desa)
                                                            <option value="{{$desa->id}}" {{($desa->id == $data->id_desanpwp) ? 'selected' : ''}}>{{$desa->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-2 col-form-label">RT/RW</label>
                                                    <div class="col-5">
                                                        <label for="rt_npwp" class="col-2 col-form-label">RT</label>
                                                        <input class="form-control m-input" type="text" name="rt_npwp" value="{{$data->rt_npwp}}" id="rt_npwp">
                                                    </div>
                                                    <div class="col-5">
                                                        <label for="rw_npwp" class="col-2 col-form-label">RW</label>
                                                        <input class="form-control m-input" type="text" name="rw_npwp" value="{{$data->rw_npwp}}" id="rw_npwp">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="example-password-input" class="col-2 col-form-label">Foto NPWP</label>
                                                    <div class="col-10">
                                                        <input type="file" accept="image/*" class="form-control m-input" name="file_npwp" id="file_npwp"><br>
                                                        <img id="file_gambar_npwp" src="{{asset('img/npwp/profile_user/'.$data->gambar_npwp)}}" width="75%" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <button id="btn_updatenpwp" class="btn btn-info btn-sm pull-right">UPDATE NPWP</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="m_tabs_1_2" role="tabpanel">
                                        <div class="m-portlet__body">
                                            <form id="form_update_ktp" action="{{route('master.vendor_update_ktp')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group m-form__group row">
                                                    <input type="hidden" name="ktp_id_vendor" id="ktp_id_vendor" value="{{$data->id}}">
                                                    <label for="example-text-input" class="col-2 col-form-label">Nama KTP</label>
                                                    <div class="col-10">
                                                        <input class="form-control m-input" type="text" name="nama_ktp" id="nama_ktp" value="{{$data->nama_ktp}}" id="example-text-input">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="example-search-input" class="col-2 col-form-label">Nomer KTP</label>
                                                    <div class="col-10">
                                                        <input class="form-control m-input" type="text" name="ktp" value="{{$data->ktp}}" id="ktp">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="example-email-input" class="col-2 col-form-label">Provinsi</label>
                                                    <div class="col-10">
                                                        <select class="form-control m-input" name="id_provinsiktp" required="required" id="provinsi_ktp">
                                                            <option value="">Pilih Provinsi...</option>
                                                            <?php
                                                            $prov = App\Models\Province::all();
                                                            ?>
                                                            @foreach ($prov as $provinsi)
                                                            <option value="{{$provinsi->id}}" {{($provinsi->id == $data->id_provinsiktp) ? 'selected' : ''}}>{{$provinsi->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="example-url-input" class="col-2 col-form-label">Kabupaten</label>
                                                    <div class="col-10">
                                                        <?php
                                                        $kab = App\Models\Regency::Where('province_id', $data->id_provinsiktp)->get();
                                                        // echo $kab;
                                                        ?>
                                                        <select class="form-control m-input" required="required" name="id_kabupatenktp" id="kabupaten_ktp">
                                                            <option>Pilih Kabupaten...</option>
                                                            @foreach ($kab as $kabupaten)
                                                            <option value="{{$kabupaten->id}}" {{($kabupaten->id == $data->id_kabupatenktp) ? 'selected' : ''}}>{{$kabupaten->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="example-tel-input" class="col-2 col-form-label">Kecamatan</label>
                                                    <div class="col-10">
                                                        <?php
                                                        $kec = App\Models\District::Where('regency_id', $data->id_kabupatenktp)->get();
                                                        // echo $kec;
                                                        ?>
                                                        <select class="form-control m-input " required="required" name="id_kecamatanktp" id="kecamatan_ktp">
                                                            <option>Pilih Kecamatan...</option>
                                                            @foreach ($kec as $kecamatan)
                                                            <option value="{{$kecamatan->id}}" {{($kecamatan->id == $data->id_kecamatanktp) ? 'selected' : ''}}>{{$kecamatan->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="example-tel-input" class="col-2 col-form-label">Desa/Kelurahan</label>
                                                    <div class="col-10">
                                                        <?php
                                                        $desa = App\Models\Village::Where('district_id', $data->id_kecamatanktp)->get();
                                                        // echo $kec;
                                                        ?>
                                                        <select class="form-control m-input " required="required" name="id_desaktp" id="desa_ktp">
                                                            <option>Pilih Desa...</option>
                                                            @foreach ($desa as $desa)
                                                            <option value="{{$desa->id}}" {{($desa->id == $data->id_desaktp) ? 'selected' : ''}}>{{$desa->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label class="col-2 col-form-label">RT/RW</label>
                                                    <div class="col-5">
                                                        <label for="rt_ktp" class="col-2 col-form-label">RT</label>
                                                        <input class="form-control m-input" type="text" name="rt_ktp" value="{{$data->rt_ktp}}" id="rt_ktp">
                                                    </div>
                                                    <div class="col-5">
                                                        <label for="rw_ktp" class="col-2 col-form-label">RW</label>
                                                        <input class="form-control m-input" type="text" name="rw_ktp" value="{{$data->rw_ktp}}" id="rw_ktp">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="example-password-input" class="col-2 col-form-label">Image KTP</label>
                                                    <div class="col-10">
                                                        <input type="file" accept="image/*" class="form-control m-input" name="file_ktp" id="file_ktp"><br>
                                                        <img id="file_gambar_ktp" src="{{asset('img/ktp/profile_user/'.$data->gambar_ktp)}}" width="75%" alt="">
                                                    </div>
                                                </div>
                                                <button id="btn_updatektp" class="btn btn-info btn-sm pull-right">UPDATE KTP</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="m_tabs_1_3" role="tabpanel">
                                        <form id="form_update_pembayaran" action="{{route('master.vendor_update_pembayaran')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="m-portlet__body">
                                                <div class="form-group m-form__group row">
                                                    <input type="hidden" name="pembayaran_id_vendor" id="pembayaran_id_vendor" value="{{$data->id}}">
                                                    <label for="nama_bank" class="col-2 col-form-label">Nama Bank</label>
                                                    <div class="col-10">
                                                        <select class="form-control" onchange="bankCheck(this);" name="nama_bank" id="nama_bank" required="required">
                                                            <option disabled>~Pilih BANK~</option>
                                                            <option value="BBRI" @if(old('nama_bank', $data->nama_bank) === 'BBRI') selected @endif >BANK BRI</option>
                                                            <option value="BMRI" @if(old('nama_bank', $data->nama_bank) === 'BMRI') selected @endif >BANK MANDIRI</option>
                                                            <option value="BBCA" @if(old('nama_bank', $data->nama_bank) === 'BBCA') selected @endif >BANK BCA</option>
                                                        </select>
                                                        <!-- <input class="form-control m-input" type="text" name="nama_bank" value="{{$data->nama_bank}}" id="nama_bank"> -->
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="nomer_rekening" class="col-2 col-form-label">Nomer Rekening</label>
                                                    <div class="col-10">
                                                        <input class="form-control m-input" type="text" name="nomer_rekening" value="{{$data->nomer_rekening}}" id="nomer_rekening">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="nama_penerima_bank" class="col-2 col-form-label">Nama Penerima</label>
                                                    <div class="col-10">
                                                        <input class="form-control m-input" type="text" name="nama_penerima_bank" value="{{$data->nama_penerima_bank}}" id="nama_penerima_bank">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="cabang_bank" class="col-2 col-form-label">Cabang</label>
                                                    <div class="col-10">
                                                        <input class="form-control m-input" type="text" name="cabang_bank" value="{{$data->cabang_bank}}" id="cabang_bank">
                                                    </div>
                                                </div>
                                            </div>
                                            <button id="btn_updatepembeyaran" class="btn btn-info btn-sm pull-right">UPDATE PEMBAYARAN</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="m_tabs_1_4" role="tabpanel">
                                        <form id="form_update_profil" action="{{route('master.vendor_update_profil')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="m-portlet__body">
                                                <div class="form-group m-form__group row">
                                                    <label for="nama_vendor" class="col-2 col-form-label">Nama Vendor</label>
                                                    <div class="col-10">
                                                        <input type="hidden" name="profil_id_vendor" id="profil_id_vendor" value="{{$data->id}}">
                                                        <input class="form-control m-input" type="text" name="nama_vendor" value="{{$data->nama_vendor}}" id="nama_vendor">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="nomer_hp" class="col-2 col-form-label">No. Telp</label>
                                                    <div class="col-10">
                                                        <input class="form-control m-input" type="text" name="nomer_hp" value="{{$data->nomer_hp}}" id="nomer_hp">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="username" class="col-2 col-form-label">Username</label>
                                                    <div class="col-10">
                                                        <input class="form-control m-input" type="text" onkeyup="nospaces(this)" name="username" value="{{$data->username}}" id="username">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="email" class="col-2 col-form-label">Email Vendor</label>
                                                    <div class="col-10">
                                                        <input class="form-control m-input" type="email" onkeyup="nospacesemail(this)" name="email" value="{{$data->email}}" id="email">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="password_show" class="col-2 col-form-label">Password</label>
                                                    <div class="col-10">
                                                        <input class="form-control m-input" type="text" name="password_show" value="{{$data->password_show}}" id="password_show">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="example-password-input" class="col-2 col-form-label">Document Pakta Integritas</label>
                                                    <div class="col-10">
                                                        <input type="file" accept="image/*" class="form-control m-input" name="file_pakta" id="file_pakta"><br>
                                                        <img id="file_gambar_pakta" src="{{asset('img/pakta_integritas/profile_user/'.$data->pakta_integritas)}}" width="75%" alt="">
                                                    </div>
                                                </div>
                                                <div class="form-group m-form__group row">
                                                    <label for="example-password-input" class="col-2 col-form-label">Document FIS</label>
                                                    <div class="col-10">
                                                        <input type="file" accept="image/*" class="form-control m-input" name="file_fis" id="file_fis"><br>
                                                        <img id="file_gambar_fis" src="{{asset('img/fis/profile_user/'.$data->fis)}}" width="75%" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <button id="btn_updateprofil" class="btn btn-info btn-sm pull-right">UPDATE PROFIL</button>
                                        </form>
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
    @endsection
    @section('js')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
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
                ajax: "{{ route('master.vendor_index') }}",
                columns: [{
                        data: "id",

                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'detail'
                    },
                    {
                        data: 'status_user'
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
        function nospaces(t) {

            if (t.value.match(/\s/g)) {

                Swal.fire({
                    title: 'Maaf',
                    text: 'Username harus tanpa spasi',
                    icon: 'warning',
                    position: 'top',
                    showConfirmButton: false,
                    timer: 1500
                });

                t.value = t.value.replace(/\s/g, '');

            }

        }

        function nospacesemail(e) {

            if (e.value.match(/\s/g)) {

                Swal.fire({
                    title: 'Maaf',
                    text: 'Email harus tanpa spasi',
                    icon: 'warning',
                    position: 'top',
                    showConfirmButton: false,
                    timer: 1500
                });

                e.value = e.value.replace(/\s/g, '');

            }

        }
        $('#nomer_hp').keyup(delay(function(phone) {
            var tlpNode = $(this).val();
            if (tlpNode == "") {
                Swal.fire({
                    position: 'top',
                    icon: 'warning',
                    title: 'No HP Harus Terisi',
                    showConfirmButton: false,
                    timer: 1500
                });
                //   Swal.fire('Info','No HP Harus Terisi','warning');
            } else if (validasi(tlpNode)) {
                Swal.fire({
                    position: 'top',
                    icon: 'warning',
                    title: 'No HP harus Berisi angka',
                    showConfirmButton: true
                });
            } else if (tlpNode.length > 12) {
                $(this).val($(this).val().substr(0, 12));
                Swal.fire({
                    position: 'top',
                    icon: 'warning',
                    title: 'Anda memasukan ' + tlpNode.length + ' digit, Maksimal 12 digit',
                    showConfirmButton: false,
                    timer: 1500
                });
            }

            function validasi(tlp) {
                var tool = new RegExp(/[^0-9-+]/g)
                return tool.test(tlp)
            }
        }, 1000));
        $('#file_ktp').change(function() {

            let reader = new FileReader();
            console.log(reader);
            reader.onload = (e) => {

                $('#file_gambar_ktp').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });
        $('#file_npwp').change(function() {

            let reader = new FileReader();
            console.log(reader);
            reader.onload = (e) => {

                $('#file_gambar_npwp').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });
        $('#file_pakta').change(function() {

            let reader = new FileReader();
            console.log(reader);
            reader.onload = (e) => {

                $('#file_gambar_pakta').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });
        $('#file_fis').change(function() {

            let reader = new FileReader();
            console.log(reader);
            reader.onload = (e) => {

                $('#file_gambar_fis').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);

        });

        function bankCheck(that) {
            if (that.value == "BBRI") {
                Swal.fire({
                    position: 'top',
                    icon: 'warning',
                    title: 'Apakah Benar BRI?',
                    showConfirmButton: true
                });
                bankdigit = 15;
                // document.getElementById("ifBRI").style.display = "block";
                // document.getElementById("ifBCA").style.display = "none";
                // document.getElementById("ifMANDIRI").style.display = "none";
            } else if (that.value == "BMRI") {
                Swal.fire({
                    position: 'top',
                    icon: 'warning',
                    title: 'Apakah Benar MANDIRI?',
                    showConfirmButton: true
                });
                bankdigit = 13;
                // document.getElementById("ifMANDIRI").style.display = "block";
                // document.getElementById("ifBCA").style.display = "none";
                // document.getElementById("ifBRI").style.display = "none";
            } else if (that.value == "BBCA") {
                Swal.fire({
                    position: 'top',
                    icon: 'warning',
                    title: 'Apakah Benar BCA?',
                    showConfirmButton: true
                });
                bankdigit = 10;
                // document.getElementById("ifBCA").style.display = "block";
                // document.getElementById("ifMANDIRI").style.display = "none";
                // document.getElementById("ifBRI").style.display = "none";
            }
        }
        $('#nomer_rekening').keyup(function(e) {
            if ($(this).val().length >= bankdigit) {
                $(this).val($(this).val().substr(0, bankdigit));
                document.getElementById("nomer_rekening").focus();
                Swal.fire({
                    position: 'top',
                    icon: 'warning',
                    title: 'Nomor Rekening harus ' + bankdigit + ' karakter. Mohon cek kembali!',
                    showConfirmButton: false,
                    timer: 1500
                });
                // if (length !== bankdigit) {
                //     document.getElementById('nomor_rekening').value;
                //     alert('Nomor Rekening harus ' + bankdigit + ' karakter. Mohon cek kembali!');
                //     document.getElementById('nomor_rekening').focus();
            }
        });

        function delay(callback, ms) {
            var timer = 0;
            return function() {
                var context = this,
                    args = arguments;
                clearTimeout(timer);
                timer = setTimeout(function() {
                    callback.apply(context, args);
                }, ms || 0);
            };
        }
        $(function() {
            var max_chars = 15;
            var min_chars = 15;
            $('#npwp').keyup(delay(function(e) {
                if ($(this).val().length >= max_chars) {
                    $(this).val($(this).val().substr(0, max_chars));
                    document.getElementById("npwp").focus();
                    Swal.fire({
                        position: 'top',
                        icon: 'warning',
                        title: 'Panjang NPWP adalah 15 karakter',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    // Swal.fire('Info!','Panjang NPWP adalah 15 karakter','warning');
                } else if ($(this).val().length <= min_chars) {
                    $(this).val($(this).val().substr(0, min_chars));
                    document.getElementById("npwp").focus();
                    Swal.fire({
                        position: 'top',
                        icon: 'warning',
                        title: 'Panjang NPWP adalah 15 karakter',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            }, 1000));
            var max_ktp = 16;
            var min_ktp = 16;
            $('#ktp').keyup(delay(function(e) {
                if ($(this).val().length >= max_ktp) {
                    $(this).val($(this).val().substr(0, max_ktp));
                    document.getElementById("ktp").focus();
                    Swal.fire({
                        position: 'top',
                        icon: 'warning',
                        title: 'Panjang KTP adalah 16 karakter',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    // Swal.fire('Info!','Panjang KTP adalah 16 karakter','warning');
                }
            }, 1000));
            $(document).on('click', '.toedit', function() {
                var id = $(this).attr("name");
                var url = "{{ route('master.vendor_show') }}" + "/" + id;

                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        var parsed = $.parseJSON(response);
                        var image = parsed.image_news;
                        $('#id').val(parsed.id);
                        $('#name').val(parsed.name);
                        $('#email').val(parsed.email);
                        $('#password').val(parsed.password_show);

                    }
                });
            });
            $(document).on('click', '#btn_updatenpwp', function(e) {
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
                        if ($('#nama_npwp').val() == '' || $('npwp').val() == '' || $('#provinsi_npwp').val() == '' || $('#kabupaten_npwp').val() == '' || $('#kecamatan_npwp').val() == '' || $('#desa_npwp').val() == '' || $('#rt_npwp').val() == '' || $('#rw_npwp').val() == '') {
                            Swal.fire({
                                title: 'Info !!',
                                text: 'Data Harus Terisi Semua',
                                icon: 'warning',
                                timer: 1500
                            })
                            $('#btn_updatenpwp').html('Simpan');
                        } else {
                            Swal.fire({
                                title: 'Harap Tuggu Sebentar!',
                                html: 'Data Uploading...', // add html attribute if you want or remove
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                            $('#form_update_npwp').submit();

                            // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                        }
                    } else {
                        Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                    }
                });
            });
            $(document).on('click', '#btn_updatektp', function(e) {
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
                        if ($('#nama_ktp').val() == '' || $('ktp').val() == '' || $('#provinsi_ktp').val() == '' || $('#kabupaten_ktp').val() == '' || $('#kecamatan_ktp').val() == '' || $('#desa_ktp').val() == '' || $('#rt_ktp').val() == '' || $('#rw_ktp').val() == '') {
                            Swal.fire({
                                title: 'Info !!',
                                text: 'Data Harus Terisi Semua',
                                icon: 'warning',
                                timer: 1500
                            })
                            $('#btn_updatektp').html('Simpan');
                        } else {
                            Swal.fire({
                                title: 'Harap Tuggu Sebentar!',
                                html: 'Data Uploading...', // add html attribute if you want or remove
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                            $('#form_update_ktp').submit();

                            // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                        }
                    } else {
                        Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')

                    }
                });
            });
            $(document).on('click', '#btn_updatepembeyaran', function(e) {
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
                        if ($('#nama_bank').val() == '' || $('nomer_rekening').val() == '' || $('#nama_penerima_bank').val() == '' || $('#cabang_bank').val() == '') {
                            Swal.fire({
                                title: 'Info !!',
                                text: 'Data Harus Terisi Semua',
                                icon: 'warning',
                                timer: 1500
                            })
                            $('#btn_updatepembeyaran').html('Simpan');
                        } else {
                            Swal.fire({
                                title: 'Harap Tuggu Sebentar!',
                                html: 'Data Uploading...', // add html attribute if you want or remove
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                            $('#form_update_pembayaran').submit();

                            // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                        }
                    } else {
                        Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')
                        $('#btn_updatepembeyaran').html('Simpan');

                    }
                });
            });
            $(document).on('click', '#btn_updateprofil', function(e) {
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
                        if ($('#nama_vendor').val() == '' || $('email').val() == '' || $('#password_show').val() == '' || $('#nomer_hp').val() == '' || $('#username').val() == '') {
                            Swal.fire({
                                title: 'Info !!',
                                text: 'Data Harus Terisi Semua',
                                icon: 'warning',
                                timer: 1500
                            })
                            $('#btn_updateprofil').html('Simpan');
                        } else {
                            Swal.fire({
                                title: 'Harap Tuggu Sebentar!',
                                html: 'Data Uploading...', // add html attribute if you want or remove
                                allowOutsideClick: false,
                                onBeforeOpen: () => {
                                    Swal.showLoading()
                                },
                            });
                            $('#form_update_profil').submit();

                            // Swal.fire('Sukses!', 'Data anda berhasil di Simpan.', 'success')

                        }
                    } else {
                        Swal.fire('Gagal!', 'Data anda Tidak di Simpan.', 'error')
                        $('#btn_updateprofil').html('Simpan');

                    }
                });
            });
            $('#provinsi_npwp').on('change', function() {
                let id_provinsi = $('#provinsi_npwp').val();

                $.ajax({
                    type: 'GET',
                    url: "{{route('user.getkabupaten')}}",
                    data: {
                        id_provinsi: id_provinsi
                    },
                    cache: false,

                    success: function(msg) {
                        $('#kabupaten_npwp').html(msg);
                    },
                    error: function(data) {
                        console.log('error:', data)
                    },

                })
            })
            $('#kabupaten_npwp').on('change', function() {
                let id_kabupaten = $('#kabupaten_npwp').val();

                $.ajax({
                    type: 'GET',
                    url: "{{route('user.getkecamatan')}}",
                    data: {
                        id_kabupaten: id_kabupaten
                    },
                    cache: false,

                    success: function(msg) {
                        $('#kecamatan_npwp').html(msg);
                    },
                    error: function(data) {
                        console.log('error:', data)
                    },

                })
            })
            $('#kecamatan_npwp').on('change', function() {
                let id_kecamatan = $('#kecamatan_npwp').val();

                $.ajax({
                    type: 'GET',
                    url: "{{route('user.getdesa')}}",
                    data: {
                        id_kecamatan: id_kecamatan
                    },
                    cache: false,

                    success: function(msg) {
                        $('#desa_npwp').html(msg);
                    },
                    error: function(data) {
                        console.log('error:', data)
                    },

                })
            })
            $('#provinsi_ktp').on('change', function() {
                let id_provinsi = $('#provinsi_ktp').val();

                $.ajax({
                    type: 'GET',
                    url: "{{route('user.getkabupaten')}}",
                    data: {
                        id_provinsi: id_provinsi
                    },
                    cache: false,

                    success: function(msg) {
                        $('#kabupaten_ktp').html(msg);
                    },
                    error: function(data) {
                        console.log('error:', data)
                    },

                })
            })
            $('#kabupaten_ktp').on('change', function() {
                let id_kabupaten = $('#kabupaten_ktp').val();

                $.ajax({
                    type: 'GET',
                    url: "{{route('user.getkecamatan')}}",
                    data: {
                        id_kabupaten: id_kabupaten
                    },
                    cache: false,

                    success: function(msg) {
                        $('#kecamatan_ktp').html(msg);
                    },
                    error: function(data) {
                        console.log('error:', data)
                    },

                })
            })
            $('#kecamatan_ktp').on('change', function() {
                let id_kecamatan = $('#kecamatan_ktp').val();

                $.ajax({
                    type: 'GET',
                    url: "{{route('user.getdesa')}}",
                    data: {
                        id_kecamatan: id_kecamatan
                    },
                    cache: false,

                    success: function(msg) {
                        $('#desa_ktp').html(msg);
                    },
                    error: function(data) {
                        console.log('error:', data)
                    },

                })
            })
        });
    </script>
    @endsection