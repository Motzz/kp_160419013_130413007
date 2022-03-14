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
                        <form action="{{route('purchaseRequest.store')}}" method="POST" id="myForm">
                            @csrf
                    
                            <div class="form-group" id="gudang">
                                        <label for="Satuan">Gudang</label>
                                        <select require name="gudang" class="form-control">
                                            <option value="">
                                                --Pilih gudang--
                                            </option>
                                            @foreach($dataGudang as $key => $data)
                                            <option name="idGudang" value="{{$data->MGudangID}}"{{$data->cname == $data->MGudangID? 'selected' :'' }}>{{$data->cname}}</option>
                                            @endforeach
                                        </select>
                                    
                                    
                                </div>
                                <div id='totalRequest' name='totalRequest[]'>
                                    <div class="form-group"  id='tmbhBarangJasa' >
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis" id="barang">
                                            <label class="form-check-label" for="barang" >Barang</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenis" id="jasa" >
                                            <label class="form-check-label" for="jasa">Jasa</label>
                                        </div>
                                
                                        <div class="form-group" id="ket">
                                                <label for="title">Keterangan</label>
                                                <input require type="text" name="Keterangan[]" class="form-control" 
                                            value="" >
                                        </div>
                                        <div class="form-group"  id='tmbhBarang'>
                                            <label for="title">Barang</label>
                                            <select require name="barang[]" class="form-control" id="barang">
                                                <option value="">--Pilih barang--</option>
                                                @foreach($dataBarang as $key => $data)
                                                <option name="idBarang" value="{{$data->ItemID}}"{{$data->ItemName == $data->ItemID? 'selected' :'' }}>{{$data->ItemName}}  </option>
                                                @endforeach
                                            </select>
                                            <input min=1 require name="jumlah[]" type="number" class="form-control" placeholder="Jumlah barang" aria-label="Recipient's username" aria-describedby="basic-addon2"id="angka" /> <br>
                                        </div>
                                        
                                        <div class="form-group" id="total">
                                            <label for="title">Total</label>
                                            <input require type="number" name="total[]" class="form-control" 
                                        value="" >
                                        </div>
                                    </div>
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
    var totalTambah = 0;
    $("body").on("click", "#tambah", function () {
        totalTambah++;
        tambahCombo +='<div class="form-group"  id="tmbhBarangJasa'+totalTambah+'">\n';
        tambahCombo +='<div class="form-check form-check-inline">\n';
        tambahCombo +='<input class="form-check-input" type="radio" name="jenis" id="barang">\n';
        tambahCombo +='<label class="form-check-label" for="barang" >Barang</label>\n';
        tambahCombo +='</div>\n';
        tambahCombo +='<div class="form-check form-check-inline">\n';
        tambahCombo +='<input class="form-check-input" type="radio" name="jenis" id="jasa">\n';
        tambahCombo +='<label class="form-check-label" for="jasa">Jasa</label>\n';
        tambahCombo +='</div>\n';
        tambahCombo +='<div class="form-group" id="ket">\n';
        tambahCombo +='<label for="title">Keterangan</label>\n';
        tambahCombo +='<input require type="text" name="Keterangan" class="form-control">\n';
        tambahCombo +='</div>\n';
        tambahCombo += '<select require name="barang[]" class="form-control" id="barang">\n';
        tambahCombo += '<option value="">--Pilih barang--</option>\n';
        tambahCombo += '@foreach($dataBarang as $key => $data)\n';
        tambahCombo += '<option name="idBarang" value="{{$data->ItemID}}"{{$data->ItemName == $data->ItemID? 'selected' :'' }}>{{$data->ItemName}}  </option>\n';
        tambahCombo += '@endforeach\n';
        tambahCombo += '</select>\n';
        tambahCombo += '<input min=1 require name="jumlah[]" id="jml" type="number" class="form-control" placeholder="Jumlah barang" aria-label="Recipient'+"'"+'s username" aria-describedby="basic-addon2"id="angka" />\n';
        tambahCombo += '<br id="br">\n';
        tambahCombo +='<div class="form-group" id="total">\n';
        tambahCombo +='<label for="title">Total</label>\n';
        tambahCombo +='<input require type="number" name="total" class="form-control">\n';
        tambahCombo +='</div>';
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

    /*$("body").on("click", "#barang", function (){
        $("#tmbhBarang").show();
        $("#total").show();
        $("#ket").hide();
        //$("#buttonBarang").show();
    });
    $("body").on("click", "#jasa", function (){
        $("#ket").show();
        $("#tmbhBarang").hide();
        //$("#buttonBarang").hide();
    });*/

    $(document).ready(function(){
        $("input[name=jenis]").click(function(){

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
    });
    
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

 