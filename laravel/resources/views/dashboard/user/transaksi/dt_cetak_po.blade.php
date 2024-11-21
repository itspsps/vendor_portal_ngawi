<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SURYA PANGAN SEMESTA</title>
    <link href="{{asset('logo-login-sps.png')}}" rel="icon">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>

<body style="font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif; margin-top: -8%;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table1 mt--3" align="left">
                            <tr>
                                <td width="4"><img class="img-responsive" alt="iamgurdeeposahan" src="{{asset('logo-login-sps.png')}}" style="width: 120px; ">
                                </td>
                                <td align="left" style="vertical-align:top;">
                                    <h2><b>&emsp; PT. SURYA PANGAN SEMESTA</h2>
                                    <p style="font-size: 12px; margin-top: -3px;">JL. RAYA NGAWI MADIUN KM 13 TAMBAKROMO KECAMATAN GENENG<br>KAB. NGAWI JAWA TIMUR 63271 <br>INDONESIA</p>
                                </td>
                                <td width="4"></td>
                                <hr>
                            </tr>
                        </table>
                    </div>
                </div>
                @foreach($data as $data)
                <div class="row">
                    <div class="col-lg-12">
                        <table width="100%">
                            <tr>
                                <td width="40%" style="vertical-align:top;">

                                    <h5 style="font-weight:bold; margin-top: -8px; vertical-align:top">
                                        <hr style="border: 1px solid black;" height="100%">Kepada
                                        <hr style="border: 1px solid black;" height="100%">
                                    </h5>

                                    <p style="background-color: #dfe1e6; font-size: 13px; margin-top: -15px">{{$data->nama_vendor}}<br><br>{{$data->SPS_AlamatNPWP_c}}</p>
                                </td>
                                <td width="10%"></td>
                                <td width="40%" style="text-align: left; vertical-align:top;">
                                    <h4 style="font-weight:bold; margin-top: -10px; ">
                                        <hr style="border: 1px solid black;" height="100%">Pesanan Pembelian
                                        <hr style="border: 1px solid black;" height="100%">
                                    </h4>
                                    <div style="background-color: #dfe1e6;width:100%; font-size: 13px; height:11%;">
                                        <p style="margin-top: -5%">No. &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{$data->PONum}} - {{$data->kode_po}}</p>
                                        <p style="margin-top: -3%">Tanggal &nbsp;&nbsp; : {{\Carbon\Carbon::parse($data->tanggal_po)->isoFormat('DD MMMM Y')}}</p>
                                        <p style="margin-top: -3%">Pengirim &nbsp;&nbsp;: TRANSPORTASI DARAT</p>
                                        <p style="margin-top: -3%">Nopol &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; : {{$data->nopol}}</p>
                                        <p style="margin-top: -3%">Termin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : NET 1</p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <table width="100%" style="font-size: 13px; border: none;">
                        <thead style="height: 80%;">
                            <th height="4px" style="background-color: #113b61; color: white;">Kode Barang</th>
                            <th height="4px" style=" background-color: #113b61; color: white;">Keterangan</th>
                            <th height="4px" style=" background-color: #113b61; color: white;">Kts.</th>
                            <th height="4px" style="background-color: #113b61; color: white;">@Harga</th>
                            <th height="4px" style="background-color: #113b61; color: white;">Diskon</th>
                            <th height="4px" style="background-color: #113b61; color: white;">Total</th>
                            <th height="4px" style="background-color: #113b61; color: white;">No. Pr</th>
                            <th height="4px" style="background-color: #113b61; color: white;">No. PPB</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$get_item->kode_item}}</td>
                                <td>{{$data->name_bid}}</td>
                                <td>1 Truk</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr style="border: 1px solid black;" height="100%">
                    <table width="100%" style=" border:none;">
                        <tr>
                            <td width="40%" style="text-align: left; vertical-align:top">
                                <p style=" margin-top: -6px">Keterangan
                                </p>
                            </td>
                            <td width="40%" style="text-align: center; vertical-align:top">
                                <div class="text-center">
                                    <img style="text-align: center;" src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(100)->generate($data->kode_po)) }} ">
                                    <p style="text-align: center; font-size: 11px;">{{$data->kode_po}}</p>
                                </div>
                            </td>
                            <td width="30%" style="text-align: left; vertical-align:top; border-color:#dfe1e6;">

                                <div style="background-color: #dfe1e6; width:100%; margin-top: -3%; font-size: 13px; text-align: right;">
                                    <p style="margin-top: -2%">Sub Total &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0,00</p>
                                    <p style="margin-top: -2%">Diskon &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0,00</p>
                                    <p style="margin-top: -2%">PPN (%) &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0,00</p>
                                    <p style="margin-top: -2%">PPh (%) &nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0,00</p>
                                    <p style="margin-top: -2%">Biaya Lain-lain &nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0,00</p>
                                </div>
                                <div style="background-color: #113b61;color:white; width:100%; margin-top: -3%; font-size: 13px; text-align: right;">
                                    <p style="margin-top: -2%">Total &nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0,00</p>

                                </div>
                            </td>
                        </tr>
                    </table>
                    <table width="100%">
                        <tr>
                            <td width="40%" style=" vertical-align:top; font-size: 13px;">
                                <p style="text-align: center; margin-top: 5px">Dibuat Oleh, </p>
                                <br>
                                <br>
                                <p style="text-align: center;">Admin Sourching Ngawi
                                </p>
                                <hr style="margin-top: -10px;">
                                <p style=" margin-top: -10px; font-size: small;">Tgl.
                                </p>
                            </td>
                            <td width="20%">

                            </td>
                            <td width="40%" style="vertical-align:top; font-size: 13px;">
                                <p style="text-align:center; margin-top: 5px"> Disetujui Oleh, </p>
                                <br>
                                <br>
                                <p style="text-align: center;">Manager Sourching Ngawi
                                </p>
                                <hr style="margin-top: -10px;">
                                <p style=" margin-top: -10px; font-size: small;">Tgl.
                                </p>
                            </td>
                        </tr>
                    </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>

</html>