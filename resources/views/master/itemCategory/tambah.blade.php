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
    <h1 class="h3 mb-0 text-gray-800">Item Type -> Tambah</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tambah Type
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('itemCategory.store')}}" method="POST" >
                      @csrf

                        <div class="form-group">
                           <label for="title">Nama Item Kategori</label>
                           <input require type="text" name="Name" class="form-control" 
                           value="{{old('Name','')}}" >
                        </div>

                         <div class="form-group">
                           <label for="title">Remarks</label>
                           <input require type="text" name="remarks" class="form-control" 
                           value="{{old('Remarks','')}}" >
                        </div>

                        <div class="form-group">
                           <label for="title">NTB Debet COA</label>
                           <input require type="number" name="NTBDebetCOA" class="form-control" 
                           value="{{old('NTBDebetCOA','')}}" >
                        </div>

                        <div class="form-group">
                           <label for="title">NTB Kredit COA</label>
                           <input require type="number" name="NTBKreditCOA" class="form-control" 
                           value="{{old('NTBKreditCOA','')}}" >
                        </div>

                        <div class="form-group">
                           <label for="title">Bill VDebet COA</label>
                           <input require type="number" name="BillVDebetCOA" class="form-control" 
                           value="{{old('BillVDebetCOA','')}}" >
                        </div>

                        <div class="form-group">
                           <label for="title">Bill VKredit COA</label>
                           <input require type="number" name="BillVKreditCOA" class="form-control" 
                           value="{{old('BillVKreditCOA','')}}" >
                        </div>

                         <div class="form-group">
                           <label for="title">Penjualan COA</label>
                           <input require type="number" name="PenjualanCOA" class="form-control" 
                           value="{{old('PenjualanCOA','')}}" >
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
