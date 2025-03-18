<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SURYA PANGAN SEMESTA</title>
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
    <link href="{{asset('logo-login-sps.png')}}" rel="icon">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>
<body>
    @if($data)
<script type="text/javascript">
    $(document).ready(function () {
        window.print();
        setTimeout("closePrintView()", 5000);
    });
    function closePrintView() {
        document.location.href = 'https://ngawi.suryapangansemesta.store/security/beras_pk';
    }
</script>
    </script>
    @endif
    <div class="container">
        <div class="row" >
            <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3" style="margin-top: 1%">
                <div class="row">
                    <div class="receipt-header" style="margin-top: -6%">
                        <div class="col-xs-2 col-sm-2 col-md-2">
                            <div class="receipt-left">
                                <img class="img-responsive" alt="iamgurdeeposahan" src="{{asset('logo-login-sps.png')}}" style="width: 75px; ">
                            </div>
                        </div>
                        <div class="col-xs-10 col-sm-10 col-md-10 text-left">
                            <div class="receipt-left">
                                <h4 style="font-weight: bold">PT. SURYA PANGAN SEMESTA</h4>
                                <p style="font-size: 10px">Jl. Raya Madiun-Ngawi KM No.13, Tambakromo III, Tambakromo, Kec. Ngawi, Kabupaten Ngawi, Jawa Timur 63271<i class="fa fa-envelope-o"></i></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="receipt-header" >
                        <div class="col-xs-6 col-sm-6 col-md-6 text-left">
                            <div class="receipt-right">
                                <hr style="border: 1px solid black;margin-top:1%" height="100%" size="20px" width="90%" align="left">
                                <h5 style="margin-top: -5%;font-weight:bold">Kepada</h5>
                                <hr style="border-top: 1px solid black;margin-top:1%" height="100%" size="20px" width="90%" align="left">
                                <div style="background-color: #dfe1e6;width:90%">
                                    <p style="margin-top: -9%">{{$data->nama_vendor}}</p>
                                    <p>RT.{{$data->rt_ktp}} RW.{{$data->rw_ktp}} , 
                                    {{ $get_desa->name??'' }},
                                    {{ $get_kecamatan->name??'' }},
                                    {{ $get_kabupaten->name??'' }},
                                    {{ $get_provinsi->name??'' }}</p>
                                    <p>{{$data->keterangan_alamat_ktp}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="receipt-left">
                                <hr style="border: 1px solid black;margin-top:1%" height="100%" size="20px" width="90%" align="left">
                                <h5 style="margin-top: -5%;font-weight:bold">Pesanan Pembelian</h5>
                                <hr style="border-top: 1px solid black;margin-top:1%" height="100%" size="20px" width="90%" align="left">
                                <div style="background-color: #dfe1e6;width:90%">
                                    <p style="margin-top: -9%">Nomor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{$data->kode_po}}</p>
                                    <p style="margin-top: -7%">Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{$data->tanggal_po}}</p>
                                    <p style="margin-top: -7%">Batas Waktu &nbsp;&nbsp;&nbsp; : {{$data->batas_penerimaan_po}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div>
                    <table class="table table-bordered" style="margin-top: -2%">
                        <thead style="background: #123b61">
                            <tr>
                                <th width="auto" style="font-size:10px;text-align:left">Kode Barang</th>
                                <th width="auto" style="font-size:10px;text-align:left">Nama Barang</th>
                                <th width="auto" style="font-size:10px;text-align:left">Kts.</th>
                                <th width="auto" style="font-size:10px;text-align:left">@Harga</th>
                                <th width="auto" style="font-size:10px;text-align:left">Diskon</th>
                                <th width="auto" style="font-size:10px;text-align:left">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-size: 9px;text-align:left">{{$get_item->kode_item}}</td>
                                <td style="font-size: 9px;text-align:left">{{$data->name_bid}}</td>
                                <td style="font-size: 9px;text-align:left">1Truk</td>
                                <td style="font-size: 9px;text-align:left">0</td>
                                <td style="font-size: 9px;text-align:left">0</td>
                                <td style="font-size: 9px;text-align:left">0</td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-left" style="font-size: 9px;background-color:#dfe1e6">
                                    <p>
                                        <strong>Sub Total: </strong>
                                    </p>
                                    <p>
                                        <strong>Diskon: </strong>
                                    </p>
                                    <p>
                                        <strong>PPN (0%): </strong>
                                    </p>
                                    <p>
                                        <strong>Biaya Lain-lain: </strong>
                                    </p>
                                </td>
                                <td colspan="2" class="text-right" style="font-size: 9px;background-color:#dfe1e6">
                                    <p>
                                        <strong><i class="fa fa-inr"></i> 0</strong>
                                    </p>
                                    <p>
                                        <strong><i class="fa fa-inr"></i>0</strong>
                                    </p>
                                    <p>
                                        <strong><i class="fa fa-inr"></i>0</strong>
                                    </p>
                                    <p>
                                        <strong><i class="fa fa-inr"></i>0</strong>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td class="text-left" style="font-size: 9px;background-color:#123b61;color:#fff">Total:</td>
                                <td colspan="2" class="text-right" class="text-left" style="font-size: 9px;background-color:#123b61;color:#fff">0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="receipt-header receipt-header-mid receipt-footer" style="margin-top: -2%">
                        <div class="col-xs-4 col-sm-4 col-md-4 text-center">
                            <div class="receipt-right">
                                <p style="font-size: 9px">Dibuat Oleh,</p>
                                <br><br>
                                <p style="font-size: 9px">Admin</p>
                                <hr width="50%" style="margin-top: -1%">
                                <p style="font-size: 9px;margin-top: -7%">Tgl. {{$data->tanggal_po}}</p>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 text-center">
                            <div class="receipt-right">
                                <div class="visible-print text-center">
                                    {!! QrCode::size(100)->generate($data->kode_po); !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 text-center">
                            <div class="receipt-right">
                                <p style="font-size: 9px">Disetujui oleh,</p>
                                <br><br>
                                <p style="font-size: 9px">Admin</p>
                                <hr width="50%" style="margin-top: -1%">
                                <p style="font-size: 9px;margin-top: -7%">Tgl. {{$data->tanggal_po}}</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
