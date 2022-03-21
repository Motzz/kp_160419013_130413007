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
    <h1 class="h3 mb-0 text-gray-800">item -> Tambah</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tambah item
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('item.store')}}" method="POST" >
                      @csrf

                        <div class="form-group">
                             <label for="title">Tipe item</label>
                            <select name="typeItem" class="form-control">
                                    <option value="">--Pilih Tipe Item--</option>
                                    @foreach($dataType as $key => $data)
                                    <option  value="{{$data->ItemTypeID}}"{{$data->Name == $data->ItemTypeID? 'selected' :'' }}>{{$data->Name}}</option>
                                    @endforeach
                            </select>
                        </div>
                     

                        <div class="form-group">
                            <label for="title">Nama Item</label>
                           <input require type="text" name="nameItem" class="form-control" 
                           value="{{old('nameItem','')}}" >
                        </div>

                        <div class="form-group">
                           <label for="title">Unit item</label>
                            <select name="itemUnit" class="form-control">
                                    <option value="">--Pilih Unit Item--</option>
                                    @foreach($dataUnit as $key => $data)
                                    <option value="{{$data->UnitID}}"{{$data->Name == $data->UnitID? 'selected' :'' }}>{{$data->Name}}</option>
                                    @endforeach
                            </select>

                        </div>
                        
                        <div class="form-group">
                            <label for="title">Kategori Item</label>
                            <select name="itemCategory" class="form-control">
                                    <option value="">--Pilih Kategori Item--</option>
                                    @foreach($dataCategory as $key => $data)
                                    <option value="{{$data->ItemCategoryID}}"{{$data->Name == $data->ItemCategoryID? 'selected' :'' }}>{{$data->Name}}</option>
                                    @endforeach
                            </select>
                        </div>

                       <div class="form-group">
                            <label for="title">Keterangan</label>
                            <input require type="text" name="note" class="form-control" 
                           value="{{old('note','')}}" >
                        </div>

                         <div class="form-group">
                             <div class="form-check">
                                <label for="active"class="form-check-input">Bisa dibeli</label>
                                <br>
                                <input type="checkbox" class="form-check-input" name= "CanBePurchased" value="1"{{'1' == old('CanBePurchased','')? 'checked' :'' }}>
                                <br>
                                <label for="active"class="form-check-input">Bisa dijual</label>
                                <br>
                                <input type="checkbox" class="form-check-input" name= "CanBeSell" value="0"{{'0'== old('CanBeSell','')? 'checked' :'' }}>
                                <br>
                            </div>
                         </div>

                         <div class="form-group">
                            <label for="title">Item Tracing</label>
                            <select name="itemTracing" class="form-control">
                                    <option value="">--Pilih Tracing Item--</option>
                                    @foreach($dataTracing as $key => $data)
                                    <option value="{{$data->ItemTracingID}}"{{$data->Name == $data->ItemTracingID? 'selected' :'' }}>{{$data->Name}}</option>
                                    @endforeach
                            </select>
                        </div>

                      
                         <div class="form-group">
                            <label for="active">Memiliki tanggal kadaluarsa</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="expiredDate" value="1"{{'1' == old('HaveExpiredDate','')? 'checked' :'' }}>
                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="expiredDate" value="0"{{'0'== old('HaveExpiredDate','')? 'checked' :'' }}>
                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                            </div><br>
                        </div>
                       
        
                        <div class="form-group">
                            <label for="active">Untuk Diproduksi</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RoutesToManufactured" value="1"{{'1' == old('RoutesToManufactured','')? 'checked' :'' }}>
                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RoutesToManufactured" value="0"{{'0'== old('RoutesToManufactured','')? 'checked' :'' }}>
                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                            </div><br>
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
