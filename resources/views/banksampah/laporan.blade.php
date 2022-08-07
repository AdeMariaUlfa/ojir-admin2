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
        <div class="row g-3 align-items-center ">
          <div class="col-auto">
            <form action="{{ url('laporan') }}" method="GET">
              <input type="search" name="search" id="inputPassword5" class="form-control" placeholder="cari berdasarkan nama" aria-describedby="passwordHelpBlock">
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
                      <th>USER</th>
                      <th>PHONE</th>
                      <th>ROLE</th>
                      <th>POINT</th>
                    </tr>
                    
                  </thead>
                  <tbody>
                  @php
                $no = 1;
                $total = 0;
                @endphp
                @foreach ($data as $index => $row)
                @if($row != 'none')
                <th scope="row">{{ $row['id'] }}</th>
                <td>{{ $row['name'] }}</td>
                <td>{{ $row['phone'] }}</td>
                <td>{{ $row['role'] }}</td>
                <td>{{ $row['point'] }}</td>
                @php
                  $total += $row['point'];
                @endphp
                @endif
                @endforeach
                <tr>
                        <th colspan="4">TOTAL</th>
                        <th>{{$total}}</th>
                        
                    </tr>
                  </tbody>
                </table>
             
              </div>
              <!-- /.card-body -->
             
            </div>
  </div>
</section>
@endsection

