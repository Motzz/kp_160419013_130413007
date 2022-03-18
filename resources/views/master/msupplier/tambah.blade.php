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
    <h1 class="h3 mb-0 text-gray-800">PT -> Tambah</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tambah PT
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('msupplier.store')}}" method="POST" >
                      @csrf

                        <div class="form-group">
                           <label for="title">Nama supplier</label>
                           <input require type="text" name="name" class="form-control" 
                           value="{{old('name','')}}" >

                           <label for="title">Alamat supplier</label>
                           <input require type="text" name="alamat" class="form-control" 
                           value="{{old('alamat','')}}">

                           <label for="title">Email supplier</label>
                           <input require type="text" name="email" class="form-control" 
                           value="{{old('email','')}}">
 
                           <label for="title">Nomor rekening</label>
                           <input require type="text" name="nomor_rekening" class="form-control" 
                           value="{{old('nomor_rekening','')}}">

                           <label for="title">Nomor telepon</label>
                           <input require type="text" name="nomor_telepon" class="form-control" 
                           value="{{old('nomor_telepon','')}}" >

                    


                      
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
