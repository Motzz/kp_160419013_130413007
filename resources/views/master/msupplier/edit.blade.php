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
            
                    <form action="{{route('supplier.update',[$supplier])}}" method="POST" >
                      @csrf
                      @method('PUT')

                        <div class="form-group">

                           <label for="title">Nama supplier</label>
                           <input require type="text" name="name" class="form-control" 
                           value="{{old('name',$supplier->name)}}" >

                           <label for="title">Alamat supplier</label>
                           <input require type="text" name="alamat" class="form-control" 
                           value="{{old('alamat',$supplier->alamat)}}">

                           <label for="title">Email supplier</label>
                           <input require type="text" name="email" class="form-control" 
                           value="{{old('email',$supplier->email)}}">

                            <label for="idBank" >Bank</label>
                            <select name="idBank" class="form-control">
                                     <option value="">--Pilih Bank--</option>
                                     @foreach($dataBank as $key => $datas)
                                     @if($datas->id==$supplier->idBank)
                                     <option selected name="idBank" value="{{$datas->id}}"{{$datas->name == $datas->id? 'selected' :'' }}>{{$datas->name}}</option>
                                     @else
                                    <option name="idBank" value="{{$datas->id}}"{{$datas->name == $datas->id? 'selected' :'' }}>{{$datas->name}}</option>
                                     @endif
                                     @endforeach
                            </select>

                           <label for="title">Nomor rekening</label>
                           <input require type="text" name="nomor_rekening" class="form-control" 
                           value="{{old('nomor_rekening',$supplier->nomor_rekening)}}">

                           <label for="title">Nomor telepon</label>
                           <input require type="text" name="nomor_telepon" class="form-control" 
                           value="{{old('nomor_telepon',$supplier->nomor_telepon)}}" >

                            <label for="idInfoSupplier" >Info Supplier</label>
                            <select name="idInfoSupplier" class="form-control">
                                     <option value="">--Pilih InfoSupplier--</option>
                                     @foreach($dataInfoSupplier as $key => $data)
                                     @if($data->id == $supplier->idInfoSupplier )
                                     <option selected name="idInfoSupplier" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>
                                     @else
                                     <option name="idInfoSupplier" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>                             
                                     @endif      
                                     @endforeach   
                           </select>
                        </div>

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
