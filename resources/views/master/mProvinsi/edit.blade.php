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
    <h1 class="h3 mb-0 text-gray-800">Supplier -> Edit</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Supplier
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('mProvinsi.update',[$mProvinsi->MProvinsiID])}}" method="POST" >
                      @csrf
                      @method('PUT')

                         <div class="form-group">
                           <label for="title">Cid Provinsi</label>
                           <input require type="text" name="cid" class="form-control" 
                           value="{{old('cidprov',$mProvinsi->cidprov)}}">

                           <label for="title">Nama Provinsi</label>
                           <input require type="text" name="name" class="form-control" 
                           value="{{old('cname',$mProvinsi->cname)}}" >
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
