@extends('layouts.home_master')
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
                        <form action="{{route('purchaseRequest.update',[$purchaseRequest])}}" method="POST">
                            @csrf

                            
                           <div class="form-group" >
                                <label for="Satuan">Gudang</label>
                                <select require name="gudang" class="form-control">
                                    <option value="">
                                        --Pilih gudang--
                                    </option>
                                    @foreach($dataGudang as $key => $data)
                                    @if($data->id==$purchaseRequest->idGudang)
                                     <option selected name="idGudang" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>
                                    @else
                                     <option  name="idGudang" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>
                                    @endif
                                     @endforeach
                                </select>
                                <br />
                                
                               
                            </div>
                            <div class="form-group"  id='tmbhBarang'>
                                
                                <select require name="barang[]" class="form-control" id="barang">
                                    <option value="">--Pilih barang--</option>
                                    @foreach($dataBarang as $key => $data)
                                    @if($data->id==$purchaseRequest->idBarang && $data->id==$purchaseRequest->idSatuan)
                                    <option selected name="idBarang" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}} ({{$data->satuanName}}) </option>
                                    @else
                                    <option name="idBarang" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}} ({{$data->satuanName}}) </option>
                                    @endif
                                    @endforeach
                                </select>
                                <input min=1 require name="jumlah[]" type="number" class="form-control" placeholder="Jumlah barang" aria-label="Recipient's username" aria-describedby="basic-addon2"id="angka" /> <br>
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


<script type="text/javascript">
    var tambahCombo = "";
    var totalTambah = 0;
    $("body").on("click", "#tambah", function () {
        totalTambah++;
        //tambahCombo="<select name='barang[]' class='form-control'id='barang"+totalTambah+"'><option value=''> --Pilih Barang--</option></select><br>";
        tambahCombo += '<select require name="barang[]" class="form-control" id="barang'+totalTambah+'">\n';
        tambahCombo += '<option value="">--Pilih barang--</option>\n';
        tambahCombo += '@foreach($dataBarang as $key => $data)\n';
        tambahCombo += '<option name="idBarang" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}} ({{$data->satuanName}}) </option>\n';
        tambahCombo += '@endforeach\n';
        tambahCombo += '</select>\n';
        tambahCombo += '<input min=1 require name="jumlah[]" id="jml'+totalTambah+'" type="number" class="form-control" placeholder="Jumlah barang" aria-label="Recipient'+"'"+'s username" aria-describedby="basic-addon2"id="angka" />\n';
        tambahCombo += '<br id="br'+totalTambah+'">\n';
        
        $('#tmbhBarang').append(tambahCombo);
        tambahCombo = "";
    });
    $("body").on("click", "#kurang", function () {
        $('#barang'+ totalTambah).remove();//i
        $('#jml'+ totalTambah).remove();//i
        $('#br'+ totalTambah).remove();//i
        if(totalTambah > 0){
            totalTambah--;
        }
        
    });
</script>  
@endsection    

 