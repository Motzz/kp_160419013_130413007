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
    <h1 class="h3 mb-0 text-gray-800">Item Tracing -> Tambah</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tambah Tracing
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('itemTracing.store')}}" method="POST" >
                      @csrf

                        <div class="form-group">
                           <label for="title">Nama Item Tracing</label>
                           <input require type="text" name="Name" class="form-control" 
                           value="{{old('Name','')}}" >
                        </div>

                        <div class="form-group">
                            <label for="title">Notes</label>
                           <input require type="text" name="Notes" class="form-control" 
                           value="{{old('Notes','')}}" >
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
