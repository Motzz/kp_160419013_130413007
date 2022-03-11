@extends('layouts.home_master')
<?php 
$currentUrl = Route::current()->getName();  //buat dapetno nama directory nya / route yang diapakek

?>
<style>
            p {
                font-family: 'Nunito', sans-serif;
            }
 </style>
@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Item Tag -> Edit</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Item Tag
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('ItemTag.update',[$ItemTag->ItemTagID])}}" method="POST" >
                      @csrf
                      @method('PUT')

                        <div class="form-group">
                           <label for="title">Nama Item Tag</label>
                           <input require type="text" name="Name" class="form-control" 
                           value="{{old('Name',$ItemTag->Name)}}" >
                        </div>

                        <div class="form-group">
                            <label for="title">Deskripsi</label>
                           <input require type="text" name="Desc" class="form-control" 
                           value="{{old('Desc',$ItemTag->Desc)}}" >
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
