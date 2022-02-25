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
    <h1 class="h3 mb-0 text-gray-800">info Supplier -> Edit</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit info Supplier
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('infoSupplier.update',[$infoSupplier])}}" method="POST" >
                      @csrf
                      @method('PUT')

                        <div class="form-group">
                           <label for="title">Nama info supplier</label>
                           <input require type="text" name="name" class="form-control" 
                           value="{{old('name',$infoSupplier->name)}}" >

                           <label for="title">Keterangan info supplier</label>
                           <input require type="text" name="keterangan" class="form-control" 
                           value="{{old('keterangan',$infoSupplier->keterangan)}}">
    
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
