@extends('layouts.home_master')
<style>
            p {
                font-family: 'Nunito', sans-serif;
            }
 </style>
@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Provinsi -> Tambah</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tambah Provinsi
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('mProvinsi.store')}}" method="POST" >
                      @csrf

                        <div class="form-group">
                           <label for="title">Cid Provinsi</label>
                           <input require type="number" name="cid" class="form-control" 
                           value="{{old('cidprov','')}}">

                           <label for="title">Nama Provinsi</label>
                           <input require type="text" name="name" class="form-control" 
                           value="{{old('cname','')}}" >
                       </div>

                       <button class="btn btn-primary">Tambah</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection
