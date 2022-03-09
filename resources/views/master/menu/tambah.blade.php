@extends('layouts.home_master')
<style>
            p {
                font-family: 'Nunito', sans-serif;
            }
 </style>
 <?php 
$currentUrl = Route::current()->getName();  //buat dapetno nama directory nya / route yang diapakek
//echo($currentUrl);
?>
@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Menu -> Tambah</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tambah menu
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('menu.store')}}" method="POST" >
                      @csrf

                        <div class="form-group">
                           <label for="title">Nama menu</label>
                           <input require type="text" name="Name" class="form-control" 
                           value="{{old('Name','')}}" >
                        </div>

                        <div class="form-group">
                            <label for="title">Url</label>
                           <input require type="text" name="Url" class="form-control" 
                           value="{{old('Url','')}}" >
                        </div>

                        <div class="form-group">
                            <label for="title">Deskripsi</label>
                           <input  type="text" name="Deskripsi" class="form-control" 
                           value="{{old('Deskripsi','')}}" >
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
