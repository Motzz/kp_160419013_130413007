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
    <h1 class="h3 mb-0 text-gray-800">item Tag Values-> Tambah</h1>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tambah Tag
                </div>
                 
                <div class="card-body">
            
                    <form action="{{route('ItemTagValues.store')}}" method="POST" >
                      @csrf

                        
                        <div class="form-group">
                             <label for="title">Item</label>
                            <select name="typeItem" class="form-control" data-live-search="true">
                                    <option value="">--Pilih Item--</option>
                                    @foreach($dataItem as $key => $data)
                                    <option  value="{{$data->ItemID}}"{{$data->ItemName == $data->ItemID? 'selected' :'' }}>{{$data->ItemName}}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Tag item</label>
                            <select name="typeItem" class="form-control" data-live-search="true">
                                    <option value="">--Pilih Tag Item--</option>
                                    @foreach($dataTag as $key => $data)
                                    <option  value="{{$data->ItemTagID}}"{{$data->Name == $data->ItemTagID? 'selected' :'' }}>{{$data->Name}}</option>
                                    @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Tags Input</label>
                            <input type="text" id="inputTag"  data-role="tagsinput" class="form-control">
                        </div>
                                        

                    
                       <button class="btn btn-primary">Tambah</button>
                    </form>
                    
                    



<script>

    $(document).ready(function(){
        $('.form-group select').selectpicker();
        //$("input").val()
        //$("input").tagsinput('items')
    });
    $("input").val()
    $("inputTag").tagsinput('items');

</script>
@endsection
