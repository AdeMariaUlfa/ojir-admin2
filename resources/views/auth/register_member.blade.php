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
  <main class="main-content bg-dark mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-light">
                  <h3 class="font-weight-bolder text-info text-gradient">Register - Member</h3>
                  <p class="mb-0">{{ __('Register Member') }}</p>
                </div>
                <div class="card-body bg-light">
                  <form action="{{ route('registerMember') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label>{{ __('Nama Lengkap') }}</label>
                    <div class="mb-3">
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <label for="role" class="form-label">{{ __('Role') }}</label>
                    <div class="mb-3">
                    <select class="form-select" name="role" aria-label="Default select example">
                        <option selected>Pilih jenis member</option>
                          <option value="keuangan">Admin Keuangan</option>
                          <option value="localhero">Local Hero</option>
                          <option value="client">Client</option>
                    </select>
                    </div>
                    <label for="no_ktp" class="form-label">{{ __('No KTP') }}</label>
                    <div class="mb-3">
                      <input id="no_ktp" type="text" min="16" max="16" onkeypress="return isNumber(event)" class="form-control @error('no_ktp') is-invalid @enderror" name="no_ktp" value="{{ old('no_ktp') }}" required autocomplete="no_ktp" autofocus>
                      @error('no_ktp')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <label for="upload_ktp" class="form-label">{{ __('Upload KTP') }}</label>
                    <div class="mb-3">
                    <div class="custom-file">
                      <input id="upload_ktp" type="file" class="custom-file-input" name="upload_ktp">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    </div>
                    <label for="gender" class="form-label">{{ __('Jenis Kelamin') }}</label>
                    <div class="mb-3">
                    <select class="form-select" name="gender" aria-label="Default select example">
                        <option selected>Pilih jenis kelamin</option>
                          <option value="laki">Laki-laki</option>
                          <option value="perempuan">Perempuan</option>
                    </select>
                    </div>
                    <label for="alamat" class="form-label">{{ __('Alamat') }}</label>
                    <div class="mb-3">
                      <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat" autofocus>
                      @error('alamat')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <label for="no_telp" class="form-label">{{ __('Nomor Telepon') }}</label>
                    <div class="mb-3">
                      <input type="tel" onkeypress="return isNumber(event)" id="no_telp" name="no_telp" pattern="[0-9]{11,13}" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}" required autocomplete="no_telp" autofocus>
                      @error('no_telp')
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
                  <small class="d-block text-center mt-3">Sudah terdaftar member?
                    <a href="{{ route('login') }}">Login disini !</a>
                  </small>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url(../template_utama/img/member.jpg)"></div>
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