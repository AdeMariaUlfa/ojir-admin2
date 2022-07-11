<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('template_utama/img/logo.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('template_utama/img/logo.png') }}">
  <title>
    Admin Ojir
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('template_utama/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('template_utama/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('template_utama/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('template_utama/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
</head>

<body class="">

  <!-- isi menu diatas -->
  <main class="main-content mt-0">
    <section>
      <div class="page-header bg-dark min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8 bg-light">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Register - Bank Sampah (Only)</h3>
                  <p class="mb-0">{{ __('Register') }}</p>
                </div>
                <div class="card-body bg-light">
                  <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label>{{ __('Nama Bank Sampah') }}</label>
                    <div class="mb-3">
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <label for="pemilik" class="form-label">{{ __('Pemilik') }}</label>
                    <div class="mb-3">
                      <input id="pemilik" type="text" class="form-control @error('pemilik') is-invalid @enderror" name="pemilik" value="{{ old('pemilik') }}" required autocomplete="pemilik" autofocus>
                      @error('pemilik')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <label for="tanggal_berdiri" class="form-label">{{ __('Tanggal Berdiri') }}</label>
                    <div class="mb-3">
                      <input id="tanggal_berdiri" type="date" class="form-control @error('tanggal_berdiri') is-invalid @enderror" name="tanggal_berdiri" value="{{ old('tanggal_berdiri') }}" required autocomplete="tanggal_berdiri" autofocus>
                      @error('tanggal_berdiri')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <label for="alamat_banksampah" class="form-label">{{ __('Alamat Bank Sampah') }}</label>
                    <div class="mb-3">
                      <input id="alamat_banksampah" type="text" class="form-control @error('alamat_banksampah') is-invalid @enderror" name="alamat_banksampah" value="{{ old('alamat_banksampah') }}" required autocomplete="alamat_banksampah" autofocus>
                      @error('alamat_banksampah')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <label for="kota_kab" class="form-label">{{ __('Kota / Kabupaten') }}</label>
                    <div class="mb-3">
                      <input id="kota_kab" type="text" class="form-control @error('kota_kab') is-invalid @enderror" name="kota_kab" value="{{ old('kota_kab') }}"  autocomplete="kota_kab" autofocus>
                      @error('kota_kab')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <label for="phone" class="form-label">{{ __('Nomor Telepon') }}</label>
                    <div class="mb-3">
                      <input type="tel" onkeypress="return isNumber(event)" id="phone" name="phone" pattern="[0-9]{11,13}" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                      @error('phone')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <label for="email" class="form-label">{{ __('E-Mail') }}</label>
                    <div class="mb-3">
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <div class="mb-3">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <div class="mb-3">
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0"> {{ __('Register') }} </button>
                    </div>
                  </form>
                  <small class="d-block text-center mt-3">Bank sampah sudah terdaftar?
                    <a href="{{ route('login') }}">Login disini !</a>
                  </small>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url(../template_utama/img/bs.jpg)"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!--   Core JS Files   -->
  <script src="{{ asset('template_utama/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('template_utama/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('template_utama/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('template_utama/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('template_utama/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

<script type="text/javascript">
  function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>

</html>