@extends('dashboard.user.layout.main')
@section('title')
   SUMBER PANGAN
@endsection
<br>
@section('content')

    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="col-xl-12 col-lg-12 col-md-12 order-lg-1 order-xl-1">
                <div class="kt-portlet kt-portlet--mobile">
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <div class="m-section">
                                <p class="kt-portlet__head-title">
                                    Layanan Pelanggan
                                </p>
                                <span class="m-section__sub" style="font-size: 8px">
                                    Jl. Dusun Bringin No.300, Bringin, Wonosari, Kec. Pagu, Kabupaten Kediri, Jawa Timur 64183
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__head kt-portlet__head--lg">
                        <div class="kt-portlet__head-label">
                            <div class="m-section">
                                <p class="kt-portlet__head-title">
                                    Layanan Jam Kerja
                                </p>
                                <span class="m-section__sub" style="font-size: 8px">
                                    Senin - Jumat : 08.00-17.00 <br>
                                    Sabtu : 08.00-14.00
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <!--begin::Portlet-->
                        <div class="m-demo__preview m-demo__preview--btn">
                            <table>
                                <tr>
                                    <a href="" class="btn m-btn m-btn--icon m-btn--outline-2x">
                                    <td><i class="fa flaticon-support" style="color: #9f187c;font-size: 30px"></i></td>
                                    <td> <span style="font-size: 10px"> &nbsp; Pusat Panggilan</span> <br>
                                        <span style="font-size: 10px;font-weight:bold">&nbsp; +62858-55555-712</span></td>
                                    </a>
                                </tr>
                            </table>

                            <hr>
                            <table>
                                <tr>
                                    <a href="" class="btn m-btn m-btn--icon m-btn--outline-2x">
                                    <td> <i class="fa flaticon-speech-bubble" style="color: #9f187c;font-size: 30px"></i></td>
                                    <td> <span style="font-size: 10px"> &nbsp; Chat Via Whatsapp</span> <br>
                                        <span style="font-size: 10px;font-weight:bold">&nbsp; +62858-55555-712</span></td>
                                    </a>
                                </tr>
                            </table>
                            <hr>
                            <table>
                                <tr>
                                    <a href="" class="btn m-btn m-btn--icon m-btn--outline-2x">
                                    <td> <i class="fa flaticon-email" style="color: #9f187c;font-size: 30px"></i></td>
                                    <td> <span style="font-size: 10px"> &nbsp; Email</span> <br>
                                        <span style="font-size: 10px;font-weight:bold">&nbsp; info@bid.sp.com</span></td>
                                    </a>
                                </tr>
                            </table>
                        </div>

                    </div>
                    {{-- <form method="post" action="{{ url('user/account_update/'.$data->id) }}"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                        <div class="kt-portlet__body">
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">* Name:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="name_admin" class="form-control m-input" value="{{$data->name}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">* Email:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="email_admin" class="form-control m-input" value="{{$data->email}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">* Password:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="password" class="form-control m-input" value="{{$data->password_show}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">* Create:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="created_at" class="form-control m-input" readonly value="{{$data->created_at}}">
                                </div>
                            </div>
                            <div class="form-group m-form__group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">* Update:</label>
                                <div class="col-xl-9 col-lg-9">
                                    <input type="text" name="updated_at" class="form-control m-input" readonly  value="{{$data->updated_at}}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger m-btn" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success m-btn pull-right">Update</button>
                            </div>
                        </div>
                    </form> --}}
                </div>
            </div>
        </div>

        <!-- end:: Content -->

    </div>

@endsection
@section('js')
@endsection
