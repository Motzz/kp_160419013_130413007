@extends('layouts.home_master')
<style>
    p {
        font-family: "Nunito", sans-serif;
    }
</style>

@section('content')
<div class="container-fluid"> 
    <!-- Page Heading -->
   <div class="container">
   <form action="purchaseRequest.store" method="GET" >
        <div class="py-5 ">
            <h2>Pembuatan Nota Permintaan Pembelian</h2><br>
               <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="firstName">Nama NPP</label>
                        <input type="text" class="form-control" id="firstName" placeholder="" value="{{$namaNpp}}" readonly required="">
                        <div class="invalid-feedback"> Valid first name is required. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Tanggal Pembuatan</label>
                        <input type="date" class="form-control" id="lastName" placeholder="" value="{{$date}}" readonly required="">
                        <div class="invalid-feedback"> Valid last name is required. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Tanggal Dibutuhkan</label>
                        <input type="date" name="tanggalDibutuhkan" class="form-control" id="firstName" placeholder="" value="{{old('tanggalDibutuhkan')}}" required="">
                        <div class="invalid-feedback"> Valid first name is required. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Tanggal Batas Akhir</label>
                        <input type="date" name="tanggalAkhir" class="form-control" id="lastName" placeholder="" value="{{old('tanggalAkhir')}}" required="">
                        <div class="invalid-feedback"> Valid last name is required. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Gudang</label>
                        <select require name="gudang" class="form-control">
                            <option value="">
                                --Pilih gudang--
                            </option>
                            @foreach($dataGudang as $key => $data)
                                <option name="idGudang" value="{{$data->MGudangID}}"{{$data->cname == $data->MGudangID? 'selected' :'' }}>{{$data->cname}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>     
        </div>
        <div class="row">
            <!--Start Permintaan-->
            <div class="col-md-6 mb-3 bg-light text-dark border ">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" novalidate="">
                    <input type="hidden" name="totalRequest[]">
                    <div class="form-group"  id='tmbhBarang'>
                        <label for="title">Barang</label>
                        <select require name="barang" class="form-control" id="barang">
                            <option value="">--Pilih barang--</option>
                            @foreach($dataBarang as $key => $data)
                            <option id="namaBarang" name="idBarang" value="{{$data->ItemID}}"{{$data->ItemName == $data->ItemID? 'selected' :'' }}>{{$data->ItemName}}<nbsp>({{$data->unitName}})  </option>
                            @endforeach
                        </select>
                        <input min=1 require name="jumlah" type="number" class="form-control" placeholder="Jumlah barang" aria-label="Recipient's username" aria-describedby="basic-addon2"id="jumlahBarang" />
                    </div>
                  
                    <div class="form-group mb-3" id="harga">
                        <label for="title">Harga</label>
                        <input require type="number" id="hargaBarang" name="harga" class="form-control" value="{{old('harga','')}}" >
                    </div>

                    <div class="form-group mb-3" id="ket">
                        <label for="title">Keterangan</label>
                        <input require type="text" id="keteranganBarang" name="Keterangan" class="form-control" value="{{old('keterangan','')}}" >
                    </div>
                                   
                    <button class="btn btn-primary btn-lg btn-block" type="submit" id="tambahKeranjang">Tambah kedalam Keranjang</button>
                </form>
            </div>
            <!--End Permintaan-->
            <!--Start Keranjang-->
            <div class="col-md-6 mb-3">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Keranjang</span>
                    <span class="badge badge-secondary badge-pill" name="totalBarangnya" id="totalBarangnya">0</span>
                </h4>
                <ul class="list-group mb-3 sticky-top" id="keranjang">
                    <!--<li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <input type="hidden" name="itemId[]" value="">
                            <h6 class="my-0" name="itemName[]">Product name <small name="itemTotal[]">(6)</small> </h6> 
                            <small class="text-muted" name="itemKeterangan[]">Keterangan</small><br>                      
                        </div>
                        <div>
                            <strong name="itemHarga[]">$20</strong>
                            <button class="btn btn-danger" type="button" id="hapusKeranjang">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                                </svg>
                            </button>
                        </div>
                    </li>     -->             
                </ul>
                <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>$20</strong>
                    </li>
                <form class="card p-2">
                    <button class="btn btn-primary" type="button"id="tambah">cek ot</button><br>
                </form>
            </div>
            <!--End Keranjang-->

            
        </div>
    </form>
    </div>
</div>
<script type="text/javascript">
    var tambahCombo = "";
    var totalTambah = 0;
    $('body').on('click','#hapusKeranjang', function(){
        $(this).parent().remove();
        totalTambah -= 1;
        $('#totalBarangnya').val(totalTambah);
        $('#totalBarangnya').html(totalTambah);
    });

    $('body').on('click','#tambahKeranjang', function(){
        var idBarang = $("#barang").val();
        var namaBarang = $("#barang option:selected").html();
        var jumlahBarang = $("#jumlahBarang").val();
        var hargaBarang = $("#hargaBarang").val();
        var keteranganBarang = $("#keteranganBarang").val();
        //alert(jumlahBarang + hargaBarang+ keteranganBarang);

        var htmlKeranjang = "";
        htmlKeranjang += '<li class="list-group-item d-flex justify-content-between lh-condensed">\n';
        htmlKeranjang += '<div>\n';
        htmlKeranjang += '<input type="hidden" name="itemId[]" value="'+idBarang+'">\n';
        htmlKeranjang += '<h6 class="my-0" name="itemName[]">'+ namaBarang +'<small name="itemTotal[]" value="'+jumlahBarang+'">('+jumlahBarang+')</small> </h6>\n';
        htmlKeranjang += '<small class="text-muted" name="itemKeterangan[]" value="'+keteranganBarang+'">'+keteranganBarang+'</small><br>\n';
        htmlKeranjang += '</div>\n';
        htmlKeranjang += '<strong name="itemHarga[]" value="'+hargaBarang+'">Rp. '+hargaBarang+',-</strong>\n';
        htmlKeranjang += '<button class="btn btn-danger" type="button" id="hapusKeranjang">\n';
        htmlKeranjang += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">\n';
        htmlKeranjang += '<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>\n';
        htmlKeranjang += '</svg>\n';
        htmlKeranjang += '</button>\n';
        htmlKeranjang += '</div>\n';
        htmlKeranjang += '</li>\n';

        $('#keranjang').append(htmlKeranjang);
        totalTambah += 1
        $('#totalBarangnya').val(totalTambah);
        $('#totalBarangnya').html(totalTambah);
    });


    $("body").on("click", "#tambah", function () {  
        totalTambah++;
        tambahCombo +='<div class="form-group p-3 mb-2 bg-light text-dark border" id="tmbhBarangJasa'+totalTambah+'">\n';
        tambahCombo +='<input type="hidden" name="totalRequest[]">\n';
        tambahCombo += '<div class="form-group" id="tmbhBarang">\n';
        tambahCombo += '<label for="title">Barang</label>\n';
        tambahCombo += '<select require name="barang[]" class="form-control" id="barang'+totalTambah+'">\n';
        tambahCombo += '<option value="">--Pilih barang--</option>\n';
        tambahCombo += '@foreach($dataBarang as $key => $data)\n';
        tambahCombo += '<option name="idBarang" value="{{$data->ItemID}}"{{$data->ItemName == $data->ItemID? 'selected' :'' }}>{{$data->ItemName}}<nbsp>({{$data->unitName}})  </option>\n';
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

    $(document).ready(function(){
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

 