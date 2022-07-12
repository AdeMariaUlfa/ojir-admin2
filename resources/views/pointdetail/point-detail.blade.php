@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
  <div class="container-fluid ">
              <div class="card-header">
              <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-light active" aria-current="page">Menu</li>
          </ol>
          <h6 class="font-weight-bolder text-light mb-0">Point Member</h6><br>
          </div>
          <div class="container">
         <!--  <a href="/addpointMember" class="btn btn-sm btn-success">TAMBAH +</a><br> -->
        <div class="row g-3 align-items-center ">
          <div class="col-auto">
       <!--      <form action="{{ route('localhero') }}" method="GET">
              <input type="search" name="search" id="inputPassword5" class="form-control" placeholder="cari berdasarkan nama" aria-describedby="passwordHelpBlock">
            </form> -->
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
                      <th>USER</th>
                      <th>PHONE</th>
                      <th>POINT</th>
                      <!-- <th>BERAT</th> -->
                     
                    </tr>
                  </thead>
                  <tbody>
                  @php
                $no = 1;
                @endphp
       
                <th scope="row">{{ $data['id'] }}</th>
                <td>{{ $data['name'] }}</td>
                <td>{{ $data['phone'] }}</td>
                <td>{{ $data['point'] }}</td>
               <!--  <td> kg</td> -->
              
                </tr>
            
                  </tbody>
                </table>
             
              </div>
              <!-- /.card-body -->
             
            </div>
  </div>
</section>
@endsection

