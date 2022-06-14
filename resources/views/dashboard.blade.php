@extends('layouts.admin')
@section('content')

<section class="content-wrapper">
<div class="container-fluid py-4">
<div class="card-header">{{ __('Dashboard') }}</div>

<div class="card-body">
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    {{ __('You are logged in!') }}

    @if(Auth::user()->role == 'admin')
        <dl class="row">
            <dt class="col-sm-3">Nama</dt>
            <dd class="col-sm-9">{{ Auth::user()->name }}</dd>

            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ Auth::user()->email }}</dd>

            <dt class="col-sm-3">Role</dt>
            <dd class="col-sm-9">{{ Auth::user()->role }}</dd>
        </dl>
    @elseif (Auth::user()->role == 'banksampah')
        <dl class="row">
            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ Auth::user()->email }}</dd>

            <dt class="col-sm-3">Role</dt>
            <dd class="col-sm-9">{{ Auth::user()->role }}</dd>

            <dt class="col-sm-3">Pemilik</dt>
            <dd class="col-sm-9">{{ Auth::user()->bank_sampah->pemilik }}</dd>
        </dl>
    @elseif (Auth::user()->role == 'client')
        <dl class="row">
            <dt class="col-sm-3">Nama</dt>
            <dd class="col-sm-9">{{ Auth::user()->name }}</dd>

            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ Auth::user()->email }}</dd>

            <dt class="col-sm-3">Role</dt>
            <dd class="col-sm-9">{{ Auth::user()->role }}</dd>
        </dl>
    @elseif (Auth::user()->role == 'keuangan')
        <dl class="row">
            <dt class="col-sm-3">Nama</dt>
            <dd class="col-sm-9">{{ Auth::user()->name }}</dd>

            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ Auth::user()->email }}</dd>

            <dt class="col-sm-3">Role</dt>
            <dd class="col-sm-9">{{ Auth::user()->role }}</dd>
        </dl>
    @endif
    
</div>
</div>
</section>
    @endsection

    