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
                        <table class="table1 mt--1" align="left">
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
                        <table class="table1 mt--1" width="100%" align="left">
                            <tr>
                                <td width="40%">

                                    <h5 style="font-weight:bold; margin-top: -10px; vertical-align:top">
                                        <hr style="border: 1px solid black;" height="100%">Kepada
                                        <hr style="border: 1px solid black;" height="100%">
                                    </h5>

                                    <p style="background-color: #dfe1e6; margin-top: -15px">{{$data->nama_vendor}}<br><br>{{$data->SPS_AlamatNPWP_c}}</p>
                                </td>
                                <td width="10%"></td>
                                <td width="40%" style="text-align: left; vertical-align:top;">
                                    <h4 style="font-weight:bold; margin-top: -16px; ">
                                        <hr style="border: 1px solid black;" height="100%">Penerimaan Barang
                                        <hr style="border: 1px solid black;" height="100%">
                                    </h4>
                                    <div style="background-color: #dfe1e6;width:100%; height:11%;">
                                        <p style="margin-top: -5%">No. Form # &nbsp; &nbsp; &nbsp;: {{$data->form_tonase_akhir}}</p>
                                        <p style="margin-top: -5%">No. Faktur # &nbsp;&nbsp; : {{$data->no_dtm}}</p>
                                        <p style="margin-top: -5%">Tanggal &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : {{\Carbon\Carbon::parse($data->tanggal_po)->isoFormat('DD MMMM Y')}}</p>
                                        <p style="margin-top: -5%">Gudang &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; : Drying Unit Area</p>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <table border="0" width="100%">
                        <thead style="height: 80%;">
                            <th height="4px" style="background-color: #113b61; color: white;">Kode Barang</th>
                            <th height="4px" style=" background-color: #113b61; color: white;">Nama Barang</th>
                            <th height="4px" style=" background-color: #113b61; color: white;">Kts.</th>
                            <th height="4px" style="background-color: #113b61; color: white;">Satuan</th>
                        </thead>
                        <tbody style="border-bottom: 1;">
                            <tr>
                                <td>{{$get_item->kode_item}}</td>
                                <td>{{$data->name_bid}}</td>
                                <td>{{tonase($data->hasil_akhir_tonase)}}</td>
                                <td>Kg</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr style="border: 1px solid black;" height="100%">
                    <table width="100%">
                        <tr>
                            <td width="40%" style="text-align: left; vertical-align:top">
                                <h4 style=" margin-top: -6px">
                                    <hr style="border: 1px solid black;" height="100%">Keterangan
                                    <hr style="border: 1px solid black;" height="100%">
                                </h4>
                                <p style="margin-top: -5%">{{$data->lokasi_bongkar_gb}}</p>
                                <br>
                                <br>
                                <div style="border-bottom:3px dotted  #000000;"></div>
                            </td>
                            <td width="5%">
                            </td>
                            <td width="30%" style=" vertical-align:top">
                                <p style="text-align: center; margin-top: 5px">Diterima Oleh, </p>
                                <br>
                                <br>
                                <p style="text-align: center;">{{Auth::guard('timbangan')->user()->name_admin_timbangan}}
                                </p>
                                <hr style="margin-top: -10px;">
                                <p style=" margin-top: -10px; font-size: small;">Tgl.
                                </p>
                            </td>
                            <td width="30%" style="vertical-align:top">
                                <p style="text-align:center; margin-top: 5px"> Disetujui Oleh, </p>
                                <br>
                                <br>
                                <p>&nbsp;
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