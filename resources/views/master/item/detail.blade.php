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
            
                    <form action="{{route('item.show',[$item->ItemID])}}" method="POST" >
                      @csrf

                        <div class="form-group">
                            <label for="title">Tipe item</label>
                            <select name="typeItem" class="form-control" disable>
                                    <option value="">--Pilih Tipe Item--</option>
                                    @foreach($dataType as $key => $data)
                                    @if($data->ItemTypeID == $item->ItemTypeID)
                                    <option selected value="{{$data->ItemTypeID}}"{{$data->Name == $data->ItemTypeID? 'selected' :'' }}>{{$data->Name}}</option>
                                    @else
                                    <option  value="{{$data->ItemTypeID}}"{{$data->Name == $data->ItemTypeID? 'selected' :'' }}>{{$data->Name}}</option>
                                    @endif
                                    @endforeach
                            </select>
                        </div>
                     
                        <div class="form-group">
                            <label for="title">Nama Item</label>
                           <input require type="text" name="nameItem" class="form-control" 
                           value="{{old('nameItem',$item->ItemName)}}" >
                        </div>

                        <div class="form-group">
                           <label for="title">Unit item</label>
                            <select name="itemUnit" class="form-control">
                                    <option value="">--Pilih Unit Item--</option>
                                    @foreach($dataUnit as $key => $data)
                                    @if($data->UnitID == $item->UnitID)
                                    <option selected value="{{$data->UnitID}}"{{$data->Name == $data->UnitID? 'selected' :'' }}>{{$data->Name}}</option>
                                    @else
                                    <option  value="{{$data->UnitID}}"{{$data->Name == $data->UnitID? 'selected' :'' }}>{{$data->Name}}</option>
                                    @endif
                                    @endforeach
                            </select>

                        </div>
                        
                        <div class="form-group">
                            <label for="title">Kategori Item</label>
                            <select name="itemCategory" class="form-control">
                                    <option value="">--Pilih Kategori Item--</option>
                                    @foreach($dataCategory as $key => $data)
                                    @if($data->ItemCategoryID == $item->ItemCategoryID)
                                    <option selected value="{{$data->ItemCategoryID}}"{{$data->Name == $data->ItemCategoryID? 'selected' :'' }}>{{$data->Name}}</option>
                                    @else
                                    <option value="{{$data->ItemCategoryID}}"{{$data->Name == $data->ItemCategoryID? 'selected' :'' }}>{{$data->Name}}</option>
                                    @endif
                                    @endforeach
                            </select>
                        </div>

                       <div class="form-group">
                            <label for="title">Keterangan</label>
                            <input require type="text" name="note" class="form-control" 
                           value="{{old('note',$item->Notes)}}" >
                        </div>

                         <div class="form-group">
                             <div class="form-check">
                                <label for="active"class="form-check-input">Bisa dibeli</label>
                                <br>
                                <input type="checkbox" class="form-check-input" name= "CanBePurchased" value="1"{{'1' == old('CanBePurchased',$item->CanBePurchased)? 'checked' :'' }}>
                                <br>
                                <label for="active"class="form-check-input">Bisa dijual</label>
                                <br>
                                <input type="checkbox" class="form-check-input" name= "CanBeSell" value="0"{{'0'== old('CanBeSell',$item->CanBePurchased)? 'checked' :'' }}>
                                <br>
                            </div>
                         </div>

                         <div class="form-group">
                            <label for="title">Item Tracing</label>
                            <select name="itemTracing" class="form-control">
                                    <option value="">--Pilih Tracing Item--</option>
                                    @foreach($dataTracing as $key => $data)
                                    @if($data->ItemTracingID == $item->ItemTracingID)
                                    <option selected value="{{$data->ItemTracingID}}"{{$data->Name == $data->ItemTracingID? 'selected' :'' }}>{{$data->Name}}</option>
                                    @else
                                    <option  value="{{$data->ItemTracingID}}"{{$data->Name == $data->ItemTracingID? 'selected' :'' }}>{{$data->Name}}</option>
                                    @endif
                                    @endforeach
                            </select>
                        </div>

                      
                         <div class="form-group">
                            <label for="active">Memiliki tanggal kadaluarsa</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="expiredDate" value="1"{{'1' == old('HaveExpiredDate',$item->HaveExpiredDate)? 'checked' :'' }}>
                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="expiredDate" value="0"{{'0'== old('HaveExpiredDate',$item->HaveExpiredDate)? 'checked' :'' }}>
                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                            </div><br>
                        </div>
                       
        
                        <div class="form-group" disabled>
                            <label for="active">Untuk Diproduksi</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RoutesToManufactured" value="1"{{'1' == old('RoutesToManufactured',$item->RoutesToManufactured)? 'checked' :'' }}>
                                <label class="form-check-label" for="inlineRadio1">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="RoutesToManufactured" value="0"{{'0'== old('RoutesToManufactured',$item->RoutesToManufactured)? 'checked' :'' }}>
                                <label class="form-check-label" for="inlineRadio2">Tidak</label>
                            </div><br>
                        </div>
        
   
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection
