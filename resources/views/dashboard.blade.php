@extends('layouts.admin')
@section('content')

<section class="content-wrapper">
<div class="container-fluid py-4">
<div class="card-header"><h5>{{ __('Welcome !') }}
    @if(Auth::user()->role == 'admin')
            <!-- <dt class="col-sm-3">Nama</dt>
            <dd class="col-sm-9">{{ Auth::user()->name }}</dd>
            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ Auth::user()->email }}</dd> -->
            {{ Auth::user()->role }} !
            
    @elseif (Auth::user()->role == 'banksampah')
        <!-- <dl class="row"> -->
            <!-- <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ Auth::user()->email }}</dd> -->
            {{ Auth::user()->role }}

            <!-- <dt class="col-sm-3">Pemilik</dt>
            <dd class="col-sm-9">{{ Auth::user()->bank_sampah->pemilik }}</dd> -->
        <!-- </dl> -->

    @elseif (Auth::user()->role == 'client')
            <!-- <dt class="col-sm-3">Nama</dt>
            <dd class="col-sm-9">{{ Auth::user()->name }}</dd>
            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ Auth::user()->email }}</dd> -->
            {{ Auth::user()->role }}
    
    @elseif (Auth::user()->role == 'keuangan')
            <!-- <dt class="col-sm-3">Nama</dt>
            <dd class="col-sm-9">{{ Auth::user()->name }}</dd>

            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ Auth::user()->email }}</dd> -->
            {{ Auth::user()->role }}
</h5>
    @endif
    <dd>Bagaimana kabar anda hari ini? Semoga hari anda menyenangkan!</dd>
</div>

<div class="container-fluid">
    <!-- @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif -->    
    <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Bank Sampah</span>
                <span class="info-box-number">
                  {{ $banksampah }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-motorcycle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Local Hero</span>
                <span class="info-box-number"> {{ $localhero }} <small>driver</small></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="far fa-address-card"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Client</span>
                <span class="info-box-number">{{ $client }} <small>member</small></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="	fas fa-donate"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Jumlah Point</span>
                <span class="info-box-number">2,000</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
</div>
</div>

</section>
    @endsection

    