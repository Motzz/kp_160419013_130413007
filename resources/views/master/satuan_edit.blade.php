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
    <h1 class="h3 mb-0 text-gray-800">Satuan -> Tambah</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tambah barang
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('satuan.update')}}" method="POST" >
                      @csrf
                      @method('PUT')

                        <div class="form-group">
                           <label for="title">Nama Satuan</label>
                           <input require type="text" name="satuan" class="form-control" 
                           value="{{old('name','$satuan->name')}}" >

                           <!--@error('title')
                           <span class="error"role="alert">
                               <strong>{{$message}}</strong>
                           </span>
                           @enderror-->
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
