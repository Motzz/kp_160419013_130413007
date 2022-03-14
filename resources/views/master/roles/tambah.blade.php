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
    <h1 class="h3 mb-0 text-gray-800">Role -> Tambah</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                 
                <div class="card-body">
            
                    <form action="{{route('role.store')}}" method="POST">
                      @csrf

                        <div class="form-group">
                           <label for="title">Nama</label>
                           <input type="text" name="name" class="form-control" value="{{old('name','')}}" >
                        </div>

                        <div class="form-group">
                           <label for="title">deskripsi</label>
                           <input type="text" name="deskripsi" class="form-control" value="{{old('deskripsi','')}}" >
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
