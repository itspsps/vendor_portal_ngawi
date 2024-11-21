<!DOCTYPE html>
<html>

<head>
    <title>DATA FORM VENDOR</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
    .page-break {
        page-break-after: always;
    }
</style>

<body>
    <div class="text-center">
        <h3>DATA FORM VENDOR</h3>
    </div>
    @foreach($users as $users)
    <table>
        <tbody>
            <th style="font-size: 14px;">
                <li>Identitas&nbsp;NPWP</li>
            </th>
            <tr>
                <td style="font-size: 11px;">Nama&nbsp;NPWP</td>
                <td style="font-size: 11px;"></td>
                <td style="font-size: 11px;">:</td>
                <td style="font-size: 11px;">{{$users->nama_npwp}}</td>
            </tr>
            <tr>
                <td style="font-size: 11px;">Nomer&nbsp;NPWP</td>
                <td style="font-size: 11px;"></td>
                <td style="font-size: 11px;">:</td>
                <td style="font-size: 11px;">{{$users->npwp}}</td>
            </tr>
            <tr>
                <td style="font-size: 11px;">Alamat&nbsp;NPWP</td>
                <td style="font-size: 11px;"></td>
                <td style="font-size: 11px;">:</td>
                <td style="font-size: 11px;">{{$users->keterangan_alamat_npwp}} RT. {{$users->rt_npwp}} RW. {{$users->rw_npwp}} {{$users->SPS_AlamatNPWP_c}}</td>
            </tr>

            <th style="font-size: 14px;">
                <li>Identitas&nbsp;KTP</li>
            </th>
            <tr>
                <td style="font-size: 11px;">&emsp;Nama&nbsp;KTP</td>
                <td style="font-size: 11px;"></td>
                <td>:</td>
                <td style="font-size: 11px;">{{$users->nama_ktp}}</td>
            </tr>
            <tr>
                <td style="font-size: 11px;">Nomer&nbsp;KTP</td>
                <td style="font-size: 11px;"></td>
                <td style="font-size: 11px;">:</td>
                <td style="font-size: 11px;">{{$users->ktp}}</td>
            </tr>
            <tr>
                <td style="font-size: 11px;">Alamat&nbsp;KTP</td>
                <td style="font-size: 11px;"></td>
                <td style="font-size: 11px;">:</td>
                <td style="font-size: 11px;">{{$users->keterangan_alamat_ktp}} RT. {{$users->rt_ktp}} RW. {{$users->rw_ktp}} {{$users->address1}} {{$users->address2}}, {{$users->address3}}</td>
            </tr>
            <th style="font-size: 14px;">
                <li>Identitas&nbsp;Pembayaran</li>
            </th>
            <tr>
                <td style="font-size: 11px;">&emsp;Nama&nbsp;Bank</td>
                <td style="font-size: 11px;"></td>
                <td>:</td>
                <td style="font-size: 11px;">{{$users->nama_bank}}</td>
            </tr>
            <tr>
                <td style="font-size: 11px;">Nomer&nbsp;Rekening</td>
                <td style="font-size: 11px;"></td>
                <td style="font-size: 11px;">:</td>
                <td style="font-size: 11px;">{{$users->nomer_rekening}}</td>
            </tr>
            <tr>
                <td style="font-size: 11px;">Nama&nbsp;Penerima</td>
                <td style="font-size: 11px;"></td>
                <td style="font-size: 11px;">:</td>
                <td style="font-size: 11px;">{{$users->nama_penerima_bank}}</td>
            </tr>
            <tr>
                <td style="font-size: 11px;">Cabang&nbsp;Bank</td>
                <td style="font-size: 11px;"></td>
                <td style="font-size: 11px;">:</td>
                <<td style="font-size: 11px;">{{$users->cabang_bank}}</td>
            </tr>
            <th style="font-size: 14px;">
                <li>Identitas&nbsp;Akun</li>
            </th>
            <tr>
                <td style="font-size: 11px;">&emsp;Nama&nbsp;Vendor</td>
                <td style="font-size: 11px;"></td>
                <td style="font-size: 11px;">:</td>
                <td style="font-size: 11px;">{{$users->nama_vendor}}</td>
            </tr>
            <tr>
                <td style="font-size: 11px;">Nomer&nbsp;Telepon</td>
                <td style="font-size: 11px;"></td>
                <td style="font-size: 11px;">:</td>
                <td style="font-size: 11px;">{{$users->nomer_hp}}</td>
            </tr>
            <tr>
                <td style="font-size: 11px;">Email</td>
                <td style="font-size: 11px;"></td>
                <td style="font-size: 11px;">:</td>
                <td style="font-size: 11px;">{{$users->email}}</td>
            </tr>
            <tr>
                <td style="font-size: 11px;">Badan&nbsp;Usaha</td>
                <td style="font-size: 11px;"></td>
                <td style="font-size: 11px;">:</td>
                <td style="font-size: 11px;">{{$users->sps_alias_c}}</td>
            </tr>
            <tr>
                <td style="font-size: 11px;">Username</td>
                <td style="font-size: 11px;"></td>
                <td style="font-size: 11px;">:</td>
                <td style="font-size: 11px;">{{$users->username}}</td>
            </tr>
            <tr>
                <td style="font-size: 11px;">Tanggal&nbsp;Pembuatan</td>
                <td style="font-size: 11px;"></td>
                <td style="font-size: 11px;">:</td>
                <td style="font-size: 11px;">{{$users->created_at}}</td>
            </tr>
        </tbody>

    </table>

    <div class="page-break"></div>
    <table style="margin-top: 3px;">
        <tbody>
            <th style="font-size: 14px;">
                <li>Foto&nbsp;Kelengkapan&nbsp;Data</li>
            </th>
            <tr>
                <th style="font-size: 11px;">Foto&nbsp;NPWP</th>
            </tr>
            <tr>
                <td style="font-size: 11px;"><img src="{{asset('img/npwp/profile_user/'.$users->gambar_npwp)}}" width="500px" alt=""></td>
            </tr>
        </tbody>
    </table>
    <div class="page-break"></div>
    <table>
        <tbody>
            <tr>
                <th style="font-size: 11px;">Foto&nbsp;KTP</th>
            </tr>
            <tr>
                <td style="font-size: 11px;"><img src="{{asset('img/npwp/profile_user/'.$users->gambar_ktp)}}" width="500px" alt=""></td>
            </tr>
        </tbody>
    </table>
    <div class="page-break"></div>
    <table>
        <tbody>
            <tr>
                <th style="font-size: 11px;">Foto&nbsp;Pakta&nbsp;Integritas</th>
            </tr>
            <tr>
                <td style="font-size: 11px;"><img src="{{asset('img/pakta_integritas/profile_user/'.$users->pakta_integritas)}}" width="600px" alt=""></td>
            </tr>
        </tbody>
    </table>
    <div class="page-break"></div>
    <table>
        <tbody>
            <tr>
                <th style="font-size: 11px;">Foto&nbsp;FIS</th>
            </tr>
            <tr>
                <td style="font-size: 11px;"><img src="{{asset('img/fis/profile_user/'.$users->fis)}}" width="600px" alt=""></td>
            </tr>

        </tbody>
    </table>
    @endforeach
</body>

</html>