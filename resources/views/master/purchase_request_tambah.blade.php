@extends('layouts.home_master')
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<style>
    p {
        font-family: "Nunito", sans-serif;
    }
</style>
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"></h1>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('barang.store')}}" method="POST">
                            @csrf

                            
                           <div class="form-group" >
                                <label for="Satuan">Gudang</label>
                                <select name="gudang" class="form-control">
                                    <option value="">
                                        --Pilih gudang--
                                    </option>
                                    @foreach($dataGudang as $key => $data)
                                     <option name="idGudang" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>
                                     @endforeach
                                </select>
                                <br />
                                
                               
                            </div>
                            <div class="form-group"  id='tmbhBarang'>
                                
                                <select name="barang[]" class="form-control" id="barang">
                                    <option value="">--Pilih barang--</option>
                                    @foreach($dataBarang as $key => $data)
                                    <option name="idBarang" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>
                                    @endforeach
                                </select>
                                <input type="number" class="form-control" placeholder="Jumlah barang" aria-label="Recipient's username" aria-describedby="basic-addon2"id="angka" /> <br>
                            </div>
                            
                        
                 
                            
                            <div class="form-group" >

                                <button class="btn btn-primary" type="button"id="tambah">+</button>

                                <button class="btn btn-primary" type="button" id="kurang">-</button><br><br>
                        
                                <button class="btn btn-primary">Selesai</button>
                            </div>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    var tambahCombo = $("#tmbhBarang").html();
    var totalTambah = 0;
    $("body").on("click", "#tambah", function () {
        totalTambah++;
        //tambahCombo="<select name='barang[]' class='form-control'id='barang"+totalTambah+"'><option value=''> --Pilih Barang--</option></select><br>";
        
 
        $('#tmbhBarang').append(tambahCombo);
    });
    $("body").on("click", "#kurang", function () {
        $('#barang'+ totalTambah).remove();//i
        totalTambah--;
    });
</script>
@endsection       