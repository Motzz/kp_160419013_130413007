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
    <h1 class="h3 mb-0 text-gray-800">Kota -> Tambah</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tambah Kota
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('mKota.store')}}" method="POST" >
                      @csrf

                        <div class="form-group">


                            <label for="title">id Kota</label>
                            <input require type="text" name="cid" class="form-control" 
                            value="{{old('cidkota','')}}" >

                            <label for="title">Kode</label>
                            <input require type="text" name="kode" class="form-control" 
                            value="{{old('ckode','')}}" >

                            <label for="title">Nama kota</label>
                            <input require type="text" name="name" class="form-control" 
                            value="{{old('cname','')}}" >

                            <label  >Provinsi</label>
                            <select name="pulau" class="form-control">
                                     <option value="">--Pilih Pulau --</option>
                                     @foreach($dataMPulau as $key => $data)
                                     <option value="{{$data->cidpulau}}"{{$data->cname == $data->cidpulau? 'selected' :'' }}>{{$data->cname}}</option>
                                     @endforeach
                            </select>

                            <label >Pulau</label>
                            <select name="prov" class="form-control">
                                     <option value="">--Pilih Provinsi--</option>
                                     @foreach($dataMProvinsi as $key => $data)
                                     <option value="{{$data->cidprov}}"{{$data->cname == $data->cidprov? 'selected' :'' }}>{{$data->cname}}</option>
                                     @endforeach
                            </select>
                            
                           
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
