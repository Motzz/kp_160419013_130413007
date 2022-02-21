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
    <h1 class="h3 mb-0 text-gray-800">Gudang -> Edit</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 
                <div class="card-body">
            
                    <form action="{{route('gudang.update',[$gudang])}}" method="POST">
                      @csrf
                      @method('PUT')

                        <div class="form-group">
                           <label for="title">Nama gudang</label>
                           <input type="text" name="name" class="form-control" value="{{old('name',$gudang->name)}}">

                         
                       </div>
        
                        <div class="form-group">
                            <label for="body" >Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="{{old('alamat',$gudang->alamat)}}">
                        
                        </div>

                        <div class="form-group">
                            <label for="body" >Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" placeholder="Opsional" value="{{old('keterangan',$gudang->keterangan)}}">
                        
                        </div>

                         <div class="form-group">
                            <label for="lokasi" >Lokasi</label>
                            <select name="lokasi" class="form-control">
                                     <option value="">--Pilih Lokasi--</option>
                                     @foreach($dataLokasi as $key => $data)
                                     @if($data->id == $gudang->idLokasi )
                                     <option selected name="idLokasi" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>
                                     @else
                                     <option name="idLokasi" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>                             
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
