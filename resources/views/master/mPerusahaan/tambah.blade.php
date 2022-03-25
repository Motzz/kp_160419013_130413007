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
    <h1 class="h3 mb-0 text-gray-800">Perusahaan -> Tambah</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tambah Perusahaan
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('mPerusahaan.store')}}" method="POST" >
                      @csrf

                        <div class="form-group">


                            <label for="title">Nama Perusahaan</label>
                            <input require type="text" name="name" class="form-control" 
                            value="{{old('cname','')}}" >

                            <label for="title">Label</label>
                            <input require type="text" name="names" class="form-control" 
                            value="{{old('cnames','')}}" >

                            <label for="Satuan" >Manager</label>
                            <select name="manager" class="form-control">
                                     <option value="">--Pilih Manager--</option>
                                     @foreach($users as $key => $data)
                                     <option value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>
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
