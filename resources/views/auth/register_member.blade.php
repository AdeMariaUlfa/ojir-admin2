<!DOCTYPE html>
<html lang="en">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<style>
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  margin: auto;
  font-family: Raleway;
  padding-top: 20px;
  padding-right: 20px;
  padding-bottom: 20px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>
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
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column ">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-light">
                  <h3 class="font-weight-bolder text-info text-gradient">Register - Member</h3>
                  <p class="mb-0">{{ __('Register Sebagai Member') }}</p>
                </div>
                <div class="card-body bg-light">
                <form id="regForm" action="{{ route('registerMember') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                <!-- One "tab" for each step in the form: -->
                <div class="tab">
                <label>{{ __('Pilih Bank Sampah') }}</label>
                  <div class="mb-1">
                      <select class="form-select" name="banksampah" id="banksampah" aria-label="Default select example"> 
                          <option selected>Pilih Bank Sampah</option>
                          @foreach ($data as $index => $row)
                            <option value="{{ $row->bank_sampah->id }}">{{ $row->name }}</option>
                          @endforeach
                      </select> 
                  </div>
                  <label>{{ __('Alamat Bank Sampah') }}</label>
                  <div class="mb-1">
                      <textarea id="alamat" type="text" oninput="this.className = ''" class="form-control"  readonly></textarea>
                  </div>
                  <label>{{ __('Kota / Kabupaten') }}</label>
                  <div class="mb-1">
                      <input id="kota_kab" type="text" oninput="this.className = ''" class="form-control"  readonly>
                  </div>
                  <label>{{ __('Pemilik') }}</label>
                  <div class="mb-1">
                      <input id="pemilik" type="text" oninput="this.className = ''" class="form-control"  readonly>
                  </div>
                </div>
                <div class="tab">
                  <label>{{ __('Pilih Role Member') }}</label>
                  <div class="mb-1">
                    <select class="form-select" name="role" aria-label="Default select example">
                        <option selected>Pilih jenis member</option>
                          <option value="keuangan">Admin Keuangan</option>
                          <option value="localhero">Local Hero</option>
                          <option value="client">Client</option>
                    </select>
                    </div>
                  <label>{{ __('Nama Lengkap') }}</label>
                  <div class="mb-1">
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  <label>{{ __('No KTP') }}</label>
                  <div class="mb-1">
                      <input id="no_ktp" type="text" min="16" max="16" onkeypress="return isNumber(event)" class="form-control @error('no_ktp') is-invalid @enderror" name="no_ktp" value="{{ old('no_ktp') }}" required autocomplete="no_ktp" autofocus>
                      @error('no_ktp')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  <label>{{ __('Upload KTP') }}</label>
                  <div class="mb-1">
                    <div class="custom-file">
                      <input id="upload_ktp" type="file" class="custom-file-input" name="upload_ktp">
                      <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    </div>
                  <label>{{ __('Jenis Kelamin') }}</label>
                  <div class="mb-1">
                    <select class="form-select" name="gender" aria-label="Default select example">
                        <option selected>Pilih jenis kelamin</option>
                          <option value="laki">Laki-laki</option>
                          <option value="perempuan">Perempuan</option>
                    </select>
                  </div>
                  <label>{{ __('Alamat') }}</label>
                  <div class="mb-1">
                      <textarea id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" required autocomplete="alamat" autofocus></textarea>
                      @error('alamat')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  <label>{{ __('No Telp') }}</label>
                  <div class="mb-1">
                      <input type="tel" onkeypress="return isNumber(event)" id="no_telp" name="no_telp" pattern="[0-9]{11,13}" class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}" required autocomplete="no_telp" autofocus>
                      @error('no_telp')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  <label>{{ __('Email') }}</label>
                  <div class="mb-1">
                      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                  <label for="password" class="form-label">{{ __('Password') }}</label>
                    <div class="mb-1">
                      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                      @error('password')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                    <div class="mb-1">
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div><br>
                <div style="overflow:auto;">
                  <div style="float:right;">
                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                  </div>
                </div>
                <!-- Circles which indicates the steps of the form: -->
                <div style="text-align:center;margin-top:40px;">
                  <span class="step"></span>
                  <span class="step"></span>
                </div>
                </form>

                  <small class="d-block text-center mt-3">Sudah terdaftar member?
                    <a href="{{ route('login') }}">Login disini !</a>
                  </small>
                  </div>
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
<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>

<!-- ajax data bank sampah -->
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    $(function () {
        $("#banksampah").change(function () {
            let value = $(this).val();
            $.ajax({
                type: 'GET',
                url: '{{ route("showBankSampah") }}',
                data: {'filter': value},
                success: function (data) {
                    document.getElementById('alamat').value = data.alamat_banksampah;
                    document.getElementById('kota_kab').value = data.kota_kab;
                    document.getElementById('pemilik').value = data.pemilik;
                }
            });
        });
    });
</script>

</html>