<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DOKUMEN</title>
    <style>
        .text-danger strong {
    		color: #9f181c;
		}
		.receipt-main {
			background: #ffffff none repeat scroll 0 0;
			border-bottom: 12px solid #333333;
			border-top: 12px solid #9f181c;
			margin-top: 50px;
			margin-bottom: 50px;
			padding: 40px 30px !important;
			position: relative;
			box-shadow: 0 1px 21px #acacac;
			color: #333333;
			font-family: open sans;
		}
		.receipt-main p {
			color: #333333;
			font-family: open sans;
			line-height: 1.42857;
		}
		.receipt-footer h1 {
			font-size: 15px;
			font-weight: 400 !important;
			margin: 0 !important;
		}
		.receipt-main::after {
			background: #414143 none repeat scroll 0 0;
			content: "";
			height: 5px;
			left: 0;
			position: absolute;
			right: 0;
			top: -13px;
		}
		.receipt-main thead {
			background: #414143 none repeat scroll 0 0;
		}
		.receipt-main thead th {
			color:#fff;
		}
		.receipt-right h5 {
			font-size: 16px;
			font-weight: bold;
			margin: 0 0 7px 0;
		}
		.receipt-right p {
			font-size: 12px;
			margin: 0px;
		}
		.receipt-right p i {
			text-align: center;
			width: 18px;
		}
		.receipt-main td {
			padding: 9px 20px !important;
		}
		.receipt-main th {
			padding: 13px 20px !important;
		}
		.receipt-main td {
			font-size: 13px;
			font-weight: initial !important;
		}
		.receipt-main td p:last-child {
			margin: 0;
			padding: 0;
		}
		.receipt-main td h2 {
			font-size: 20px;
			font-weight: 900;
			margin: 0;
			text-transform: uppercase;
		}
		.receipt-header-mid .receipt-left h1 {
			font-weight: 100;
			margin: 34px 0 0;
			text-align: right;
			text-transform: uppercase;
		}
		.receipt-header-mid {
			margin: 24px 0;
			overflow: hidden;
		}

		#container {
			background-color: #dcdcdc;
		}
    </style>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>
<body>
    @if($data)
    <script>
    (function() {
    window.print()
    })();
    </script>
    @endif
    <div class="container">
        <div class="row" >
            <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3" style="margin-top: 1%">
                <div class="row">
                    <div class="receipt-header" style="margin-top: -6%">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="receipt-left">
                                <img class="img-responsive" alt="iamgurdeeposahan" src="{{asset('logo.png')}}" style="width: 71px; border-radius: 43px;">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                            <div class="receipt-right">
                                <h5>CV. SUMBER PANGAN</h5>
                                <p>+62858-55555-712 <i class="fa fa-phone"></i></p>
                                <p>info@sumberpangan.com <i class="fa fa-envelope-o"></i></p>
                                <p>Pagu - Kediri <i class="fa fa-location-arrow"></i></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="receipt-header receipt-header-mid" >
                        <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                            <div class="receipt-right">
                                <h5>{{ $data->nama_vendor }}<small>  |   Kode : </span>{{$data->kode_transaksi}}</small></h5>
                                <p><b>Mobile :</b> {{number_format($data->nomer_hp,0,',','-');}}</p>
                                <p><b>Email :</b> {{$data->email}}</p>
                                <?php
                                    $prov = \App\Models\Province::where('id', $data->id_provinsinpwp)->first();
                                    $kab = \App\Models\Regency::where('id', $data->id_kabupatennpwp)->first();
                                    $kec = \App\Models\District::where('id', $data->id_kecamatannpwp)->first();
                                    $des = \App\Models\Village::where('id', $data->id_desanpwp)->first();
                                ?>
                                <p ><b>Address :</b> {{ $prov->name }}, {{ $kab->name }},{{ $kec->name }}, {{ $des->name }}</p>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="receipt-left">
                                <h1>Receipt</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <table class="table table-bordered" style="margin-top: -2%">
                        <thead>
                            <tr>
                                <th style="width: auto">Keterangan</th>
                                <th style="width: auto">Qty</th>
                                <th style="width: auto">Netto</th>
                                <th style="width: auto">Unit Price</th>
                                <th style="width: auto">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-size: 12px;text-align:center" class="col-md-9">{{ $data->name_bid }}</td>
                                <td style="font-size: 12px;text-align:center" class="col-md-3"><i class="fa fa-inr"></i> {{ $data->jumlah_kirim }}/Kg</td>
                                <td style="font-size: 12px;text-align:center" class="">{{ $data->final_jumlahgabah }}/Kg</td>
                                <td style="font-size: 12px;text-align:center"><?php echo 'Rp' . number_format($data->final_hargagabah, 2, ',', '.'); ?>/Kg</td>
                                <td style="font-size: 12px;text-align:center"><?php echo 'Rp' . number_format($data->final_hargagabah * $data->final_jumlahgabah, 2, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-right">
                                    <p>
                                        <strong>Bongkar: </strong>
                                    </p>
                                    <p>
                                        <strong>PPH(0,25): </strong>
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        <strong><i class="fa fa-inr"></i> <?php echo 'Rp' . number_format($data->final_jumlahgabah * 13, 2, ',', '.'); ?></strong>
                                    </p>
                                    <p>
                                        <strong><i class="fa fa-inr"></i> <?php echo 'Rp' . number_format(($data->final_hargagabah * $data->final_jumlahgabah - $data->final_jumlahgabah * 13) * (0.25 / 100), 2, ',', '.'); ?></strong>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-right"><h6><strong>Total: </strong></h6></td>
                                <td class="text-left text-danger"><h6><strong><i class="fa fa-inr"></i> <?php echo 'Rp' . number_format($data->final_hargagabah * $data->final_jumlahgabah - $data->final_jumlahgabah * 13 - ($data->final_hargagabah * $data->final_jumlahgabah - $data->final_jumlahgabah * 13) * (0.25 / 100), 2, ',', '.'); ?></strong></h6></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="receipt-header receipt-header-mid receipt-footer" style="margin-top: -2%">
                        <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                            <div class="receipt-right">
                                <p><b>Date :</b> {{$data->waktu_transaksi}}</p>
                                <h5 style="color: rgb(140, 140, 140);">Thank you for your business!</h5>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="receipt-left">
                                <h1>CV. Sumber Pangan</h1>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
