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
    <h1 class="h3 mb-0 text-gray-800">Kota -> Edit</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Kota
                </div>
                 
                <div class="card-body">
            
                    <form method="POST" action="{{route('mKota.update',[$mKota->MKotaID])}}" >
                      @csrf
                      @method('PUT')

                         <div class="form-group">
    
                            <label for="title">id Kota</label>
                            <input require type="text" name="cid" class="form-control" 
                            value="{{old('cidkota',$mKota->cidkota)}}" >

                            <label for="title">Kode</label>
                            <input require type="text" name="kode" class="form-control" 
                            value="{{old('ckode',$mKota->ckode)}}" >

                            <label for="title">Nama kota</label>
                            <input require type="text" name="name" class="form-control" 
                            value="{{old('cname',$mKota->cname)}}" >

                            <label for="Satuan" >Provinsi</label>
                            <select name="pulau" class="form-control">
                                     <option value="">--Pilih Pulau--</option>
                                     @foreach($dataMPulau as $key => $data)
                                     @if($data->cidpulau==$mKota->cidpulau)
                                     <option selected value="{{$data->cidpulau}}"{{$data->cname == $data->MPulauID? 'selected' :'' }}>{{$data->cname}}</option>
                                     @else
                                     <option value="{{$data->cidpulau}}"{{$data->cname == $data->MPulauID? 'selected' :'' }}>{{$data->cname}}</option>
                                     @endif
                                     @endforeach
                            </select>

                            <label for="Satuan" >Pulau</label>
                            <select name="prov" class="form-control">
                                     <option value="">--Pilih Provinsi--</option>
                                     @foreach($dataMProvinsi as $key => $data)
                                     @if($data->cidprov==$mKota->cidprov)
                                     <option selected value="{{$data->cidprov}}"{{$data->cname == $data->MProvinsiID? 'selected' :'' }}>{{$data->cname}}</option>
                                     @else
                                     <option value="{{$data->cidprov}}"{{$data->cname == $data->MProvinsiID? 'selected' :'' }}>{{$data->cname}}</option>
                                     @endif


                                     @endforeach
                            </select>

                         
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
