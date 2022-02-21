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
    <h1 class="h3 mb-0 text-gray-800">Gudang -> Tambah</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 
                <div class="card-body">
            
                    <form action="{{route('gudang.store')}}" method="POST">
                      @csrf

                        <div class="form-group">
                           <label for="title">Nama Gudang</label>
                           <input type="text" name="name" class="form-control" value="{{old('name','')}}" >

                      
                       </div>
        
                        <div class="form-group">
                            <label for="body" >Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{old('alamat','')}}">
                            

                        </div>

                        <div class="form-group">
                            <label for="body" >Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" placeholder="Opsional" value="{{old('keterangan','')}}">
                            

                        </div>

                        <div class="form-group">
                            <label for="lokasi" >Lokasi</label>
                            <select name="lokasi" class="form-control">
                                     <option value="">--Pilih Lokasi--</option>
                                     @foreach($dataLokasi as $key => $data)
                                     <option name="idLokasi" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>
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
