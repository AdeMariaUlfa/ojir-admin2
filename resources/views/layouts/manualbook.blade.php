@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
  <div class="container-fluid ">
              <div class="card-header">
              <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-light active" aria-current="page">Menu</li>
          </ol>
          <h4 class="font-weight-bolder text-light mb-0">Manual Book Sampah</h4><br>
            </div>
            <div class="container">
            <div class="row">
        <div class="col-12 mx-auto">
          <div class="card mb-4">
          <div class="row py-lg-4 py-10 p-5">
            <div class="col-lg-3 col-md-5 position-relative my-auto">
              <img class="img border-radius-lg max-width-200 w-100 position-relative z-index-2" src="{{ asset('template/dist/img/dry.jpg') }}" alt="bruce">
            </div>
            <div class="col-lg-7 col-md-7 z-index-2 position-relative px-md-2 px-sm-3 mt-sm-0 mt-4">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="mb-0">Sampah Kering</h4>
                <!-- <div class="d-block">
                  <button type="button" class="btn btn-sm btn-outline-info text-nowrap mb-0">Follow</button>
                </div> -->
              </div>
              <div class="row mb-4 ">
                <div class="col-auto">
                  <span class="h6">0,66</span>
                  <span>Ton/Hari</span>
                </div>
                <!-- <div class="col-auto">
                  <span class="h6">3.5k</span>
                  <span>Followers</span>
                </div>
                <div class="col-auto">
                  <span class="h6">260</span>
                  <span>Following</span>
                </div> -->
              </div>
              <p class="text-lg mb-0">
              Sampah organik kering adalah sampah organik yang sedikit mengandung air. Contoh sampah organik misalnya kayu, ranting pohon, kayu dan daun – daun kering. Kebanyakan sampah organik sulit diolah kembali jadi lebih sering dibakar untuk memusnahkannya.
              <!-- <br><a href="javascript:;" class="text-info icon-move-right">More about me
                  <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                </a> -->
              </p><br>
              <p>Sumber : DKP Kota Malang Tahun 2013</p>
            </div>
          </div>
        </div>
        </div>
        <div class="col-12 mx-auto">
        <div class="card mb-4">
          <div class="row py-lg-5 py-10 p-5">
            <div class="col-lg-3 col-md-5 position-relative my-auto">
              <img class="img border-radius-lg max-width-200 w-100 position-relative z-index-2" src="{{ asset('template/dist/img/wet.jpg') }}" alt="bruce">
            </div>
            <div class="col-lg-7 col-md-7 z-index-2 position-relative px-md-2 px-sm-3 mt-sm-0 mt-4">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <h4 class="mb-0">Sampah Basah</h4>
                <!-- <div class="d-block">
                  <button type="button" class="btn btn-sm btn-outline-info text-nowrap mb-0">Follow</button>
                </div> -->
              </div>
              <div class="row mb-4">
                <div class="col-auto">
                  <span class="h6">405,41</span>
                  <span>Ton/Hari</span>
                </div>
                <!-- <div class="col-auto">
                  <span class="h6">3.5k</span>
                  <span>Followers</span>
                </div>
                <div class="col-auto">
                  <span class="h6">260</span>
                  <span>Following</span>
                </div> -->
              </div>
              <p class="text-lg mb-0">
              Sampah organik basah adalah sampah organik yang banyak mengadung air. Sampah organik basah contohnya adalah sisa sayur, kulit pisang, buah yang busuk, kulit bawang dan sejenisnya.
              Inilah yang saya katakan bahwa sampah organik dapat menimbulkan bau tidak sedap sebab kandungan air tinggi yang menyebabkan sampah jenis ini cepat membusuk.
              <!-- <br><a href="javascript:;" class="text-info icon-move-right">More about me
                  <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                </a> -->
              </p><br>
              <p>Sumber : DKP Kota Malang Tahun 2013</p>
            </div>
          </div>
</div>
              </div>
                    </div>
                </div>
</section>


@endsection