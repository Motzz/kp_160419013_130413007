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
    <h1 class="h3 mb-0 text-gray-800">COA -> Tambah</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tambah COA
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('coa.store')}}" method="POST" >
                      @csrf

                        <div class="form-group">
                           <label for="title">Nomor COA</label>
                           <input require type="text" name="Nomor" class="form-control" 
                           value="{{old('Nomor','')}}" >

                           <label for="title">Nama COA</label>
                           <input require type="text" name="Nama" class="form-control" 
                           value="{{old('Nama','')}}" >

                           <label for="title">Chead</label>
                           <input require type="number" name="Chead" class="form-control" 
                           value="{{old('Chead','')}}" >

                           <label for="title">Cdet</label>
                           <input require type="number" name="Cdet" class="form-control" 
                           value="{{old('Cdet','')}}" >

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
