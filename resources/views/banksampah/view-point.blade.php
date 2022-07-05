@extends('layouts.admin')
@section('content')
<section class="content-wrapper">
  <div class="container-fluid ">
              <div class="card-header">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-light active" aria-current="page">Menu</li>
                </ol>
                <h6 class="font-weight-bolder text-light mb-0">Point</h6><br>
                <h5 class="font-weight-bolder text-light mb-0">Edit Data Point</h5>
              </div>
<div class="row">
  <div class="col-12">
    <div class="card mb-4">
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                    <div class="card-body">
                        <form action="/updatepoint/{{ $data['id'] }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Jenis Sampah</label>
                                <select class="form-select" name="jenis_sampah" aria-label="Default select example">
                                    <option >Pilih jenis sampah</option>
                                    <option value="kering" {{$data['jenis_sampah'] == 'kering'?'selected':''}}>Kering</option>
                                    <option value="basah" {{$data['jenis_sampah'] == 'basah'?'selected':''}}>Basah</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Point</label>
                                <input type="number" name="harga" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" value="{{ $data['harga'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Berat</label>
                                <input type="number" name="berat" pattern="[0-9]+([,\.][0-9]+)?" step="0.1" placeholder="2.4" class="form-control" id="exampleInputEmail1" 
                                aria-describedby="emailHelp" value="{{ $data['berat'] }}">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


@endsection
  

