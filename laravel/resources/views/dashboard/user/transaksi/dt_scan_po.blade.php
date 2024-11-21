<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BARCODE PO</title>
    <link href="{{asset('logo-login-sps.png')}}" rel="icon">
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Asap+Condensed:500"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="col-12" style="border: 1pxx;">
            <div class="row">
                <div class="col-4">
                </div>
                <div class="col-4">
                    <br><br><br><br><br>
                    <div class="visible-print text-center" style="text-align: center;">
                        {!! QrCode::size(300)->generate($data->kode_po); !!}
                        <h1 style="text-align: center">{{$data->kode_po}}</h1>
                    </div>
                </div>
                <div class="col-4">
                </div>
            </div>
        </div>
    </div>

</body>

</html>