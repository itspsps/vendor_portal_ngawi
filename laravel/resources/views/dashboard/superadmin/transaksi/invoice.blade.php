<div class="container mb-5 mt-3">
    <div class="row d-flex align-items-baseline">
        <div class="col-xl-9">
            <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID:{{$data->kode_transaksi}}</strong></p>
        </div>
        <div class="col-xl-3 float-end">
            <a href="" @click.prevent="printme" target="_blank" class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                    class="fas fa-print text-primary"></i> Print</a>
            <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
                    class="far fa-file-pdf text-danger"></i> Export</a>
        </div>
        <hr>
    </div>

    <div class="container">
        <div class="col-md-12">
            <div class="text-center">
                <i class="fab fa-mdb fa-4x ms-0" style="color:#5d9fc5 ;"></i>
            </div>

        </div>


        <div class="row">
            <div class="col-xl-8">
                <ul class="list-unstyled">
                    <li class="text-muted">Vendor: <span
                            style="color:#5d9fc5 ;">{{ $data->nama_vendor }}</span></li>
                    <?php
                    $prov = \App\Models\Province::where('id', $data->id_provinsinpwp)->first();
                    ?>
                    <?php
                    $kab = \App\Models\Regency::where('id', $data->id_kabupatennpwp)->first();
                    ?>
                    <?php
                    $kec = \App\Models\District::where('id', $data->id_kecamatannpwp)->first();
                    ?>
                    <?php
                    $des = \App\Models\Village::where('id', $data->id_desanpwp)->first();
                    ?>
                    <li class="text-muted">{{ $prov->name }}, {{ $kab->name }}</li>
                    <li class="text-muted">{{ $kec->name }}, {{ $des->name }}</li>
                    <li class="text-muted"><i class="fas fa-phone"></i> {{ $data->nomer_hp }}
                    </li>
                </ul>
            </div>
            <div class="col-xl-4">
                <p class="text-muted">Invoice</p>
                <ul class="list-unstyled">
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i>
                        <span class="fw-bold">ID:</span>{{$data->kode_transaksi}}</li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i>
                        <span class="fw-bold">Creation Date: </span>{{ $data->date_biduser }}
                    </li>
                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i>
                        <span class="me-1 fw-bold">Status:</span>
                        @if ($data->status_transaksi == 1)
                            <span class="badge bg-success text-black fw-bold">Sudah Terbayar</span>
                        @else
                            <span class="badge bg-danger text-black fw-bold">Belum Terbayar</span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>

        <div class="row my-2 mx-1 justify-content-center">
            <table class="table table-striped table-borderless">
                <thead style="background-color:#84B0CA ;" class="text-white">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Description</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Netto</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>{{ $data->name_bid }}</td>
                        <td>{{ $data->jumlah_kirim }} /Kg</td>
                        <td>{{ $data->final_jumlahgabah }} /Kg</td>
                        <td><?php echo 'Rp ' . number_format($data->final_hargagabah, 2, ',', '.'); ?> /Kg</td>
                        <td><?php echo 'Rp ' . number_format($data->final_hargagabah * $data->final_jumlahgabah, 2, ',', '.'); ?></td>
                    </tr>
                </tbody>

            </table>
        </div>
        <div class="row">
            <div class="col-xl-9">
                <p class="ms-3">

                </p>
            </div>
            <div class="col-xl-3">
                <ul class="list-unstyled">
                    <li class="text-muted ms-3"><span class="text-black me-4"
                            style="font-weight: bold">Potongan Bongkar</span>
                        <?php echo 'Rp ' . number_format($data->final_jumlahgabah * 13, 2, ',', '.'); ?></li>
                    <li class="text-muted ms-3 mt-2"><span class="text-black me-4"
                            style="font-weight: bold">PPH(0,25%)</span> <?php echo 'Rp ' . number_format(($data->final_hargagabah * $data->final_jumlahgabah - $data->final_jumlahgabah * 13) * (0.25 / 100), 2, ',', '.'); ?></li>
                    <li class="text-muted ms-3 mt-2"><span class="text-black me-4"
                            style="font-weight: bold">Total Pembayaran</span>
                        <?php echo 'Rp ' . number_format($data->final_hargagabah * $data->final_jumlahgabah - $data->final_jumlahgabah * 13 - ($data->final_hargagabah * $data->final_jumlahgabah - $data->final_jumlahgabah * 13) * (0.25 / 100), 2, ',', '.'); ?></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xl-10">
                <p>Thank you for your purchase</p>
            </div>
            <div class="col-xl-2">
                <button type="button" class="btn btn-primary text-capitalize"
                    style="background-color:#60bdf3 ;">Pay Now</button>
            </div>
        </div>

    </div>
</div>
