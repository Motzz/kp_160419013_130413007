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
    <h1 class="h3 mb-0 text-gray-800">Pulau -> Tambah</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tambah Pulau
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('mPulau.store')}}" method="POST" >
                      @csrf

                        <div class="form-group">
                           <label for="title">Cid pulau</label>
                           <input require type="text" name="cid" class="form-control" 
                           value="{{old('cidpulau','')}}">

                           <label for="title">Nama Pulau</label>
                           <input require type="text" name="name" class="form-control" 
                           value="{{old('cname','')}}" >
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
