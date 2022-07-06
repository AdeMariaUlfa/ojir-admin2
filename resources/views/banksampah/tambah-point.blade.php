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
                    <h5 class="font-weight-bolder text-light mb-0">Tambah Data Point</h5>
                </div>
                        <table class="table align-items-center mb-0">
                        <div class="card-body">
                            <form action="/postpoint" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Jenis Sampah</label>
                                    <select class="form-select" name="jenis_sampah" aria-label="Default select example">
                                        <option selected>Pilih jenis sampah</option>
                                        <option value="kering">Kering</option>
                                        <option value="basah">Basah</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Harga</label>
                                    <input type="number" name="harga" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Berat</label>
                                    <input type="number" name="berat" pattern="[0-9]+([,\.][0-9]+)?" step="0.1" class="form-control" placeholder="2.4" aria-describedby="emailHelp">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                        </table>
                    </div>
                </div>
    </section>


    @endsection
        
