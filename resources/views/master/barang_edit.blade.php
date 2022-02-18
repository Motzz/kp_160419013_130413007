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
    <h1 class="h3 mb-0 text-gray-800">Barang -> Edit</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 
                <div class="card-body">
            
                    <form action="{{route('barang.update',[$barang])}}" method="POST">
                      @csrf
                      @method('PUT')

                        <div class="form-group">
                           <label for="title">Nama barang</label>
                           <input type="text" name="barang" class="form-control" value="{{old('name',$barang->name)}}">

                         
                       </div>
        
                        <div class="form-group">
                            <label for="body" >Kode</label>
                            <input type="text" name="barang" class="form-control" placeholder="Opsional" value="{{old('code',$barang->code)}}">
                        
                        </div>

                         <div class="form-group">
                            <label for="Satuan" >Satuan</label>
                            <select name="barang" class="form-control">
                                     <option value="">--Pilih satuan--</option>
                                     @foreach($dataSatuan as $key => $data)
                                     @if($data->id == $barang->idSatuan )
                                     <option selected name="idSatuan" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>
                                     @else
                                     <option name="idSatuan" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>                             
                                     @endif      
                                     @endforeach   
                           </select>
                        </div>


                       <button class="btn btn-primary">Save</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection
