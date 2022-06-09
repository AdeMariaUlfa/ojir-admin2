@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
  <div class="container-fluid ">
              <div class="card-header">
              <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-light active" aria-current="page">Menu</li>
          </ol>
          <h6 class="font-weight-bolder text-light mb-0">Bank Sampah</h6><br>
</div>
          <div class="container">
          <!-- <a href="" class="btn btn-sm btn-success">TAMBAH +</a><br> -->
        <div class="row g-3 align-items-center ">
          <div class="col-auto">
            <form action="{{ route('banksampah') }}" method="GET">
              <input type="search" name="search" id="inputPassword5" class="form-control" placeholder="cari nama pemilik" aria-describedby="passwordHelpBlock">
            </form>
          </div>
        </div>
          @if($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
          {{ $message}}
        </div>
        @endif
              </div>
        </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th>NAMA</th>
                      <th>EMAIL</th>
                      <th>PEMILIK</th>
                      <th>ALAMAT</th>
                      <th>TGL BERDIRI</th>
                      <th>KOTA/KABUPATEN</th>
                      <th>STATUS VERIFIKASI</th>
                      <th>AKSI</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php
                $no = 1;
                @endphp
                @foreach ($data as $index => $row)
                <th scope="row">{{ $row->id }}</th>
                <td class="text-uppercase">{{ $row->user->name }}</td>
                <td class="text-lowercase">{{ $row->user->email }}</td>
                <td class="text-capitalize">{{ $row->pemilik }}</td>
                <td class="text-capitalize">{{ $row->alamat_banksampah }}</td>
                <td>{{ $row->tanggal_berdiri }}</td>
                <td class="text-capitalize">{{ $row->kota_kab }}</td>
                <td class="text-lowercase">{{ $row->user->status }}</td>
                <td>
                  <a href="/updatebanksampah/{{ $row->user_id }}" style="width:100px; margin: 3px;" class="btn btn-success btn-sm">VERIFIKASI</a>
                  <a href="/rejectbanksampah/{{ $row->user_id }}" style="width:100px; margin: 3px;" class="btn btn-danger btn-sm">REJECT</a>
                </td>
                </tr>
                @endforeach
                  </tbody>
                </table>
                {{ $data->links() }}
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
              </div>
            </div>
  </div>
</section>
@endsection

