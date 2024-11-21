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
                        TRANSAKSI
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
            <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <span class="kt-portlet__head-icon">
                                <i class="flaticon-user"></i>
                            </span>
                            <h3 class="kt-portlet__head-title">
                                Data Transaksi
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <table class="table table-bordered" id="datatable" style="display: block;
                        overflow-x: auto;
                        white-space: nowrap;">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">Kode Transaksi</th>
                                    <th style="text-align: center">Vendor</th>
                                    <th style="text-align: center">Waktu</th>
                                    <th style="text-align: center">Jenis</th>
                                    <th style="text-align: center">Jumlah Pengajuan</th>
                                    <th style="text-align: center">Jumlah Permintaan</th>
                                    <th style="text-align: center">Netto</th>
                                    <th style="text-align: center">Harga Pabrik</th>
                                    <th style="text-align: center">Jumlah Uang</th>
                                    <th style="text-align: center">Potongan Bongkar</th>
                                    <th style="text-align: center">Harga Setelah Potongan</th>

                                    <th style="text-align: center">Jumlah Uang Setelah PPH</th>

                                    <th style="text-align: center">Detail</th>
                                    <th style="text-align: center">Action</th>
                                    <th style="text-align: center">Status</th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center">
                                <?php $no = 1; ?>
                                @foreach ($data as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->kode_transaksi}}</td>
                                        <td>{{ $data->nama_vendor }}</td>
                                        <td>{{ $data->date_biduser }}</td>
                                        <td>{{ $data->name_bid }}</td>
                                        <td>{{ $data->jumlah_kirim}} Truk</td>
                                        <td>{{ $data->permintaan_kirim}} Truk ({{ $data->permintaan_kirim * 8000 .' Kg'}})</td>
                                        <td>0</td>
                                        {{-- Harga Pabrik  --}}
                                        <td><?php echo "Rp " . number_format($data->final_hargagabah,2,',','.'); ?> /Kg {{ $data->name_bid }}</td>
                                        {{-- Jumlah Uang --}}
                                        <td><?php echo "Rp " . number_format(($data->final_hargagabah * $data->final_jumlahgabah),2,',','.'); ?> </td> {{-- jumlah Uang --}}
                                        {{-- Potongan Bongkar	 --}}
                                        <td><?php echo "Rp " . number_format(($data->final_jumlahgabah*13),2,',','.'); ?></td> {{-- Potongan bongkar --}}
                                        {{-- Harga Setelah Potongan	 --}}
                                        <td><?php echo "Rp " . number_format(($data->final_hargagabah * $data->final_jumlahgabah)-($data->final_jumlahgabah*13),2,',','.'); ?></td> {{-- Harga Setelah Potongan --}}
                                        {{-- Jumlah Uang Setelah PPH	 --}}
                                        <td><?php echo "Rp " . number_format((((($data->final_hargagabah * $data->final_jumlahgabah)-($data->final_jumlahgabah*13))-(($data->final_hargagabah * $data->final_jumlahgabah)-($data->final_jumlahgabah*13)) * (0.25/100))),2,',','.'); ?></td> {{-- jumlah uang setelah pph--}}
                                        <td><a href="{{url('sourching/detail_transaksi/'.$data->id_transaksi)}}" class="btn btn-success btn-hover-danger btn-sm" style="color: #9f187c">Detail</a></td>
                                        <td>
                                            <a style="" name="{{ $data->id_biduser }}" data-toggle="modal"
                                                data-target="#modal2" title="Update Harga dan Jumlah"
                                                class="toupdate btn btn-outline-info m-btn m-btn--icon btn-sm m-btn--icon-only">
                                                <i class="fa fa-spinner" style="color:#00c5dc;"> </i> Update
                                        </td>
                                        <td>
                                            @if ($data->status_transaksi == 1)
                                                <span class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fa fa-eye">Sudah Terbayar</i></span>
                                            @else
                                                <span class="toyakin btn btn-outline-danger m-btn m-btn--icon btn-sm m-btn--icon-only"><i class="fa fa-eye">Belum Terbayar</i></span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>




        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form class="m-form m-form--fit m-form--label-align-right" method="post"
                        action="{{ route('sourching.transaksi_update') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Data Transaksi Vendor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id_biduser" id="id_biduser">
                            <input type="hidden" name="user_idbid" id="user_id">
                            <input type="hidden" name="bid_id" id="bid_id">
                            <input type="hidden" name="kode_transaksi" id="kode_transaksi">
                            <div class="form-group">
                                <div class="form-group m-form__group">
                                    <label>Status Pembayaran</label><br>
                                    <input class=" m-input" type="radio" id="appoved" name="status_transaksi" value="1">
                                    <label for="age2">Lunas</label>
                                    <input class=" m-input" type="radio" id="appoved" name="status_transaksi" value="2">
                                    <label for="age2">Belum Terbayar</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group m-form__group">
                                    <label>Harga Akhir (Aktual)</label>
                                    <input type="number" class="form-control m-input" name="final_hargagabah" required
                                        placeholder="Rp *****">
                                </div>
                                <div class="form-group m-form__group">
                                    <label>Jumlah Akhir (Netto)</label>
                                    <input type="number" class="form-control m-input" name="final_jumlahgabah" required
                                        placeholder="*****/Kg">
                                </div>
                                <div class="form-group m-form__group">
                                    <label>Waktu</label>
                                    <input type="date" class="form-control m-input" name="waktu_transaksi" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success m-btn pull-right">Send</button>
                        </div>
                    </form>
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

    <script type="text/javascript">
        $(function() {
            $(document).on('click', '.toupdate', function() {
                var id = $(this).attr("name");
                var url = '{{ route('sourching.transaksi_show') }}' + "/" + id;

                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        console.log(response);
                        var parsed = $.parseJSON(response);
                        $('#id_biduser').val(parsed.id_biduser);
                        $('#user_id').val(parsed.user_id);
                        $('#bid_id').val(parsed.bid_id);
                        $('#kode_transaksi').val(parsed.id_desanpwp);

                    }
                });
            });
        });
    </script>
@endsection
