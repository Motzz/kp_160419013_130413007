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
    <h1 class="h3 mb-0 text-gray-800">Proses Transaksi -> Edit</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Proses Transaksi
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('transaksi.update',[$transaksi])}}" method="POST" >
                      @csrf
                      @method('PUT')

                        <div class="form-group">
                           <label for="title">Nama transaksi</label>
                           <input require type="text" name="transaksi" class="form-control" 
                           value="{{old('name',$transaksi->name)}}" >

                           <!--@error('title')
                           <span class="error"role="alert">
                               <strong>{{$message}}</strong>
                           </span>
                           @enderror-->
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
