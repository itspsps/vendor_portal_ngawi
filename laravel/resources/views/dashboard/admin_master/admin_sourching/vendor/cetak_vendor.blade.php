<!DOCTYPE html>
<html>

<head>
    <title>DATA VENDOR</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
    table.td {
        font-family: 'arial';
        font-size: 11px;
    }
</style>

<body>
    <div class="text-center">
        <h4>LAPORAN DATA VENDOR</h4>
    </div>

    <table class="table table-bordered" style="table-layout: fixed">
        <tr>
            <th width="2%" style="font-size: 10px;">#</th>
            <th style="font-size: 10px;">Nama&nbsp;Vendor</th>
            <th style="font-size: 10px;">Nomer&nbsp;NPWP</th>
            <th style="font-size: 10px;">Nomer&nbsp;KTP</th>
            <th style="font-size: 10px;">Nama&nbsp;Bank</th>
            <th style="font-size: 10px;">Nomer&nbsp;Rekening</th>
            <th style="font-size: 10px;">Nama&nbsp;Penerima</th>
            <th style="font-size: 10px;">Cabang&nbsp;Bank</th>
            <th style="font-size: 10px;">Nomer&nbsp;HP</th>
            <th style="font-size: 10px;">Email</th>
            <th style="font-size: 10px;">Created At</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td style="font-size: 9px;">{{$user->id}}</td>
            <td style="font-size: 9px;">{{$user->nama_vendor}}</td>
            <td style="font-size: 9px;">{{$user->npwp}}</td>
            <td style="font-size: 9px;">{{$user->ktp}}</td>
            <td style="font-size: 9px;">{{$user->nama_bank}}</td>
            <td style="font-size: 9px;">{{$user->nomer_rekening}}</td>
            <td style="font-size: 9px;">{{$user->nama_penerima_bank}}</td>
            <td style="font-size: 9px;">{{$user->cabang_bank}}</td>
            <td style="font-size: 9px;">{{$user->nomer_hp}}</td>
            <td style="font-size: 9px;">{{$user->email}}</td>
            <td style="font-size: 9px;">{{$user->created_at}}</td>
        </tr>
        @endforeach
    </table>

</body>

</html>