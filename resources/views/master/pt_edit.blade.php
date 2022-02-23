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
            
                    <form action="{{route('pt.store')}('pt.update',[$pt]}" method="POST" >
                      @csrf

                        <div class="form-group">
                           <label for="title">Nama PT</label>
                           <input require type="text" name="name" class="form-control" 
                           value="{{old('name','')}}" >
                           <label for="title">Alias PT</label>
                           <input require type="text" name="alias" class="form-control" 
                           value="{{old('alias','')}}" >

                      
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
