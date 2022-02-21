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
    <h1 class="h3 mb-0 text-gray-800">Lokasi -> Edit</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 
                <div class="card-body">
            
                    <form action="{{route('lokasi.update',[$lokasi])}}" method="POST">
                      @csrf
                      @method('PUT')

                        <div class="form-group">
                           <label for="title">Nama lokasi</label>
                           <input type="text" name="name" class="form-control" value="{{old('name',$lokasi->name)}}">

                         
                       </div>
        
                        <div class="form-group">
                            <label for="body" >Alias</label>
                            <input type="text" name="alias" class="form-control" value="{{old('alias',$lokasi->alias)}}">
                        
                        </div>

                        <div class="form-group">
                            <label for="body" >Keterangan</label>
                            <input type="text" name="keterangan" class="form-control" placeholder="Opsional" value="{{old('keterangan',$lokasi->keterangan)}}">
                        
                        </div>

                         <div class="form-group">
                            <label for="pt" >PT</label>
                            <select name="pt" class="form-control">
                                     <option value="">--Pilih PT--</option>
                                     @foreach($dataPt as $key => $data)
                                     @if($data->id == $lokasi->idPt )
                                     <option selected name="idPt" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>
                                     @else
                                     <option name="idPt" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>                             
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
