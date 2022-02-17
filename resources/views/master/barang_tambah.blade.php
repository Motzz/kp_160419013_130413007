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
    <h1 class="h3 mb-0 text-gray-800">Barang -> Tambah</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Permintaan barang
                </div>
                 
                <div class="card-body">
            
                    <form action="" >
                      @csrf

                        <div class="form-group">
                           <label for="title">Nama barang</label>
                           <input type="text" name="barang" class="form-control" >

                           <!--@error('title')
                           <span class="error"role="alert">
                               <strong>{{$message}}</strong>
                           </span>
                           @enderror-->
                       </div>
        
                        <div class="form-group">
                            <label for="body" >Kode</label>
                            <input type="text" name="title" class="form-control" placeholder="Opsional">
                            <!--<figcaption class="blockquote-footer">
                                Opsional <cite title="Source Title"></cite>
                            </figcaption> -->
                           

                          <!-- @error('body')
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
