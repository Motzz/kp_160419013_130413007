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
                    Tambah COA
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('item.store')}}" method="POST" >
                      @csrf

                        <div class="form-group">
                           <label for="title">Tipe Item</label>
                           <input require type="text" name="typeItem" class="form-control" 
                           value="{{old('typeItem','')}}" >
                        </div>

                       

                         <div class="form-group">
                             <div class="form-check">
                                <label for="active"class="form-check-input">Bisa dibeli</label>
                                <br>
                                <input type="checkbox" class="form-check-input" name= "canBePurchased" value="1"{{'1' == old('canBePurchased','')? 'checked' :'' }}>
                                <br>
                                <label for="active"class="form-check-input">Bisa dijual</label>
                                <br>
                                <input type="checkbox" class="form-check-input" name= "canBeSell" value="0"{{'0'== old('canBeSell','')? 'checked' :'' }}>
                                <br>
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
