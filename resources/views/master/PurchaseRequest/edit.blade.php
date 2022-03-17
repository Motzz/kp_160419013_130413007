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
                        <form action="{{route('purchaseRequest.update',[$purchaseRequest->id])}}" method="POST" id="myForm">
                            @csrf
                            @method('PUT')
                    
                            <div class="form-group" id="gudang">
                                        <label for="Satuan">Gudang</label>
                                        <select require name="MGudangID" class="form-control">
                                            <option value="">
                                                --Pilih gudang--
                                            </option>
                                            @foreach($dataGudang as $key => $data)
                                            @if($data->MGudangID==$purchaseRequest->MGudangID)
                                            <option selected name="idGudang" value="{{$data->MGudangID}}"{{$data->cname == $data->MGudangID? 'selected' :'' }} >{{$data->cname}} </option>
                                            @else
                                            <option name="idGudang" value="{{$data->MGudangID}}"{{$data->cname == $data->MGudangID? 'selected' :'' }}>{{$data->cname}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    
                                    
                                </div>
                                <div id='totalRequest' name='totalRequest[]'>
                                @foreach($dataDetail as $key => $data)
                                    <div class="form-group p-3 mb-2 bg-light text-dark border"  id='tmbhBarangJasa{{"$loop->index"}}' >
                                        <input type="hidden" name="totalRequest[]" class="totalRequest">
                                        <div class="form-group"  id='tmbhBarang'>
                                            <label for="title">Barang</label>
                                            <select require name="barang[]" class="form-control" id="barang">
                                                <option value="">--Pilih barang--</option>
                                                @foreach($dataBarang as $key => $barang)
                                                @if($barang->ItemID == $data->ItemID)
                                                <option selected name="idBarang" value="{{$data->ItemID}}"{{$barang->ItemName == $barang->ItemID? 'selected' :'' }}>{{$barang->ItemName}}<nbsp>{{$barang->unitName}}  </option>
                                                @endif
                                                <option name="idBarang" value="{{$data->ItemID}}"{{$barang->ItemName == $barang->ItemID? 'selected' :'' }}>{{$barang->ItemName}}<nbsp>{{$barang->unitName}}  </option>
                                                @endforeach
                                            </select>
                                            <input min=1 require name="jumlah[]" type="number" class="form-control" placeholder="Jumlah barang" aria-label="Recipient's username" aria-describedby="basic-addon2"id="angka" value="{{old('jumlah',$data->jumlah)}}" />
                                        </div>

                                        <!--<div class="form-group" id="total">
                                            <label for="title">Total</label>
                                            <input require type="number" name="total[]" class="form-control" value="{{old('totalHarga','')}}" >
                                        </div>-->

                                        <div class="form-group" id="harga">
                                            <label for="title">Harga</label>
                                            <input require type="number" name="harga[]" class="form-control" value="{{old('harga',$data->harga)}}" >
                                        </div>

                                         <div class="form-group" id="ket">
                                                <label for="title">Keterangan</label>
                                                <input require type="text" name="Keterangan[]" class="form-control" value="{{old('keterangan',$data->keterangan_jasa)}}" >
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                                
                                    
                                <div class="form-group" id ="buttonBarang" >

                                    <button class="btn btn-primary" type="button"id="tambah">+</button>

                                    <button class="btn btn-primary" type="button" id="kurang">-</button><br><br>
                            
                                    
                                </div>
                                    <button class="btn btn-primary">Selesai</button>
                           
                        </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>     

<script type="text/javascript">
    var tambahCombo = "";
    var totalTambah = 0 + $('.totalRequest').length - 1;
    $("body").on("click", "#tambah", function () {  
        totalTambah++;
        tambahCombo +='<div class="form-group p-3 mb-2 bg-light text-dark border" id="tmbhBarangJasa'+totalTambah+'">\n';
        tambahCombo +='<input type="hidden" name="totalRequest[]">\n';
        tambahCombo += '<div class="form-group" id="tmbhBarang">\n';
        tambahCombo += '<label for="title">Barang</label>\n';
        tambahCombo += '<select require name="barang[]" class="form-control" id="barang'+totalTambah+'">\n';
        tambahCombo += '<option value="">--Pilih barang--</option>\n';
        tambahCombo += '@foreach($dataBarang as $key => $data)\n';
        tambahCombo += '<option name="idBarang" value="{{$data->ItemID}}"{{$data->ItemName == $data->ItemID? 'selected' :'' }}>{{$data->ItemName}}<nbsp>{{$data->unitName}} </option>\n';
        tambahCombo += '@endforeach\n';
        tambahCombo += '</select>\n';
        tambahCombo += '<input min=1 require name="jumlah[]" id="jml" type="number" class="form-control" placeholder="Jumlah barang" aria-label="Recipient'+"'"+'s username" aria-describedby="basic-addon2"id="angka" />\n';
        tambahCombo += '<br id="br">\n';
        tambahCombo +='</div>\n';
        //tambahCombo +='<div class="form-group" id="total'+totalTambah+'">\n';
        //tambahCombo +='<label for="title">Total</label>\n';
        //tambahCombo +='<input require type="number" name="total[]" class="form-control">\n';
        //tambahCombo +='</div>\n';
        tambahCombo +='<div class="form-group" id="harga'+totalTambah+'">\n';
        tambahCombo +='<label for="title">Harga</label>\n';
        tambahCombo +='<input require type="number" name="harga[]" class="form-control">\n';
        tambahCombo +='</div>\n';
        tambahCombo +='<div class="form-group" id="ket'+totalTambah+'">\n';
        tambahCombo +='<label for="title">Keterangan</label>\n';
        tambahCombo +='<input require type="text" name="Keterangan[]" class="form-control" >\n';
        tambahCombo +='</div>\n';
        tambahCombo +='</div>';
        
        $('#totalRequest').append(tambahCombo);
        tambahCombo = "";
    });
    $("body").on("click", "#kurang", function () {
        //$('#barang'+ totalTambah).remove();//i
        //$('#jml'+ totalTambah).remove();//i
        //$('#br'+ totalTambah).remove();//i
        $('#tmbhBarangJasa'+ totalTambah).remove();//i
        if(totalTambah > 0){
            totalTambah--;
        }  
    });

    /*$('body').on("click", "#barang", function (){
        $("#tmbhBarang").show();
        $("#total").show();
        $("#ket"+totalTambah).hide();
        //$("#buttonBarang").show();
    });
    $('body').on("click", "#jasa", function (){
        $("#ket"+totalTambah).show();
        $("#tmbhBarang").hide();
        //$("#buttonBarang").hide();
    });*/

    /*$(document).ready(function(){
        $('input[name=jenis0]').click(function(){

            if($("#barang").is(':checked'))
            {
              $("#tmbhBarang").show();
              $("#total").show();
              $("#ket").hide();
               //$("#buttonBarang").show();
            }
            else
            {
              $("#ket").show();
              $("#tmbhBarang").hide();
              //$("#buttonBarang").hide();
            }
        });
    });*/
    
    /*$('#myForm input').on('change', function() {
           $("input[name=jenis]").change(function(){

            if($("#barang").is(':checked'))
            {
              $("#tmbhBarang").show();
              $("#total").show();
               $("#ket").hide();
               //$("#buttonBarang").show();
            }
            else
            {
              $("#ket").show();
              $("#tmbhBarang").hide();
              //$("#buttonBarang").hide();
            }
        });
      //alert($('input[name=jenis]:checked', '#myForm').val()); 
    });*/

</script>  
@endsection    

 