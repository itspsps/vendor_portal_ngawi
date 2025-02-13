  <!-- Navbar & Hero Start -->
  <div class="container-xxl position-relative p-0" id="home">

      <div class="container-xxl bg-primary hero-header" style="height:fit-content;">
          <div class="container" style="margin-top: -20%;">
              <a data-bs-toggle="offcanvas" href="#offcanvas_logout" role="button" aria-controls="offcanvas_logout" class="btn btn-lg"><i class="bi bi-box-arrow-right text-white"></i></a>
              <div class="row">
                  <div class="col-8 text-lg-start">
                      <h2 class="text-white animated slideInDown">{{Auth::user()->nama_vendor}}</h2>
                      <!--<p class="text-white pb-3 animated slideInDown">Tempor rebum no at dolore lorem clita rebum rebum ipsum rebum stet dolor sed justo kasd. Ut dolor sed magna dolor sea diam. Sit diam sit justo amet ipsum vero ipsum clita lorem</p>
                <a href="" class="btn btn-primary-gradient py-sm-3 px-4 px-sm-5 rounded-pill me-3 animated slideInLeft">Read More</a>
                <a href="" class="btn btn-secondary-gradient py-sm-3 px-4 px-sm-5 rounded-pill animated slideInRight">Contact Us</a> -->
                  </div>
                  <div class="col-4 text-lg-end" style="text-align: right;">
                      <a href="{{route('user.new_account')}}" id="btn_klik">
                          <img src="{{asset('avatar7.png')}}" alt="user_supplier" class="rounded-circle" width="50px">
                      </a>
                  </div>
              </div>
          </div>
          @yield('back')
      </div>
  </div>
  <!-- Navbar & Hero End -->
  <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvas_logout" aria-labelledby="offcanvasExampleLabel" style="height:auto !important; border-radius: 10px 10px 0px 0px; box-shadow: 16px 16px 16px 13px #000; margin: 0; position: fixed;">
      <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasExampleLabel">KONFIRMASI LOGOUT</h5>
          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
          <div>
              Apakah Kamu ingin Keluar Dari Applikasi Ini ?
          </div>
          <div class="dropdown mt-3 text-center">
              <form action="{{route('user.new_logout')}}" method="POST">
                  @csrf
                  <button id="btn_klik" class="btn btn-sm btn-primary-gradient" type="submit">
                      Ya
                  </button>
                  <button class="btn btn-sm btn-light" data-bs-dismiss="offcanvas" aria-label="Close" type="button">
                      Tidak
                  </button>
              </form>

          </div>
      </div>
  </div>