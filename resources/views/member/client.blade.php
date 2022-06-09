@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
  <div class="container-fluid ">
              <div class="card-header">
              <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-light active" aria-current="page">Menu</li>
          </ol>
          <h6 class="font-weight-bolder text-light mb-0">Client</h6><br>
</div>
          <div class="container">
          <!-- <a href="" class="btn btn-sm btn-success">TAMBAH +</a><br> -->
        <div class="row g-3 align-items-center ">
          <div class="col-auto">
            <form action="{{ route('client') }}" method="GET">
              <input type="search" name="search" id="inputPassword5" class="form-control" placeholder="cari berdasarkan gender" aria-describedby="passwordHelpBlock">
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
                      <th>JENIS KELAMIN</th>
                      <th>KTP</th>
                      <th>ALAMAT</th>
                      <th>NO TELP</th>
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
                <td class="text-uppercase">{{ $row->name }}</td>
                <td class="text-lowercase">{{ $row->email }}</td>
                <td class="text-capitalize">{{ $row->gender }}</td>
                <td>
                  <img src="{{ asset($row->member->upload_ktp) }}" alt="" style="width:150px; height: 100px;">
                </td>
                <td class="text-capitalize">{{ $row->alamat }}</td>
                <td class="text-capitalize">0{{ $row->no_telp }}</td>
                <td class="text-lowercase">{{ $row->status }}</td>
                <td>
                  <a href="/updateclient/{{ $row->id }}" style="width:100px; margin: 3px;" class="btn btn-success btn-sm">VERIFIKASI</a>
                  <a href="/rejectclient/{{ $row->id }}" style="width:100px; margin: 3px;" class="btn btn-danger btn-sm">REJECT</a>
                </td>
                </tr>
                @endforeach
                  </tbody>
                </table>
             
              </div>
              <!-- /.card-body -->
             
            </div>
  </div>
</section>
@endsection

