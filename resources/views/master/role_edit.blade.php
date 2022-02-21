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
    <h1 class="h3 mb-0 text-gray-800">Barang -> Edit</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 
                <div class="card-body">
            
                    <form action="{{route('role.update',[$role])}}" method="POST">
                      @csrf

                        <div class="form-group">
                           <label for="title">Nama</label>
                           <input type="text" name="name" class="form-control" value="{{old('name',$role->name)}}" >

                      
                       </div>


                        <div class="form-group">
                            <label for="body" >Access</label>
                            
                            <li class="list-group-item rounded-0">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" id="customCheck1" type="checkbox">
                                    <label class="cursor-pointer font-italic d-block custom-control-label" for="customCheck1">Margherita</label>
                                </div>
                            </li>
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
