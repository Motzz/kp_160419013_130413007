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
    <h1 class="h3 mb-0 text-gray-800">Bank -> Edit</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Bank
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('bank.update',[$bank])}}" method="POST" >
                      @csrf
                       @method('PUT')

                         <div class="form-group">
                           <label for="title">Nama Bank</label>
                           <input require type="text" name="name" class="form-control" 
                           value="{{old('name',$bank->name)}}" >

                           <label for="title">Alias Bank</label>
                           <input require type="text" name="alias" class="form-control" 
                           value="{{old('alias',$bank->alias)}}" >

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
