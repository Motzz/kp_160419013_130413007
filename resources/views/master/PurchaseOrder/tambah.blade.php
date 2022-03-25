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
   <form action="{{route('purchaseOrder.store')}}" method="POST" >
           @csrf
        <div class="py-5 ">
            <h2>Pembuatan Purchase Order</h2><br>
               <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="firstName">Nama NPP</label>
                        <input type="text" class="form-control" id="firstName" placeholder="" value="{{$namaPo}}" readonly required="">
                        <div class="invalid-feedback"> Valid first name is required. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Tanggal Pembuatan</label>
                        <input type="date" class="form-control" id="lastName" placeholder="" value="{{$date}}" readonly required="">
                        <div class="invalid-feedback"> Valid last name is required. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Tanggal Batas Akhir</label>
                        <input type="date" name="tanggalAkhir" class="form-control" id="lastName" placeholder="" value="{{old('tanggalAkhir','')}}" required="">
                        <div class="invalid-feedback"> Valid last name is required. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Cara Pembayaran</label> 
                        <select name="gudang" class="form-control selectpicker" data-live-search="true" data-show-subtext="true">
                            <option value="">
                                --Pilih Cara Pembayaran--
                            </option>
                            @foreach($dataPayment as $key => $data)
                                <option name="idPaymentTerms" value="{{$data->PaymentTermsID}}"{{$data->Name == $data->PaymentTermsID? 'selected' :'' }}>{{$data->Name}} ({{$data->PaymentName}})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Supplier</label> 
                        <select name="gudang" class="form-control selectpicker" data-live-search="true" data-show-subtext="true">
                            <option value="">
                                --Pilih Supplier--
                            </option>
                            @foreach($dataSupplier as $key => $data)
                                <option name="idSupplier" value="{{$data->SupplierID}}"{{$data->Name == $data->SupplierID? 'selected' :'' }}>{{$data->Name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>     
        </div>
        <div class="row">
            <!--Start Permintaan-->
            <div class="col-md-6 mb-3 bg-light text-dark border ">
                <h4 class="mb-3">Billing address</h4>
                <div >

                    <label for="title">Permintaan Pembelian</label>

                    <select class="form-control selectpicker" id="pReq" data-show-subtext="true">
                            <option value="pilih">--Permintaan Order--</option>
                            @foreach($dataPurchaseRequest as $key => $data)
                            <option id="preqID" value="{{$data->id}}"{{$data->name == $data->id? 'selected' :'' }}>{{$data->name}}</option>
                            @endforeach
                    </select><br>


                    <div class="form-group"  id='tmbhBarang'>
                        <label for="title">Barang</label>
                        <!--<select class="form-control selectpicker" id="tag" data-live-search="true">
                            <option value="all">Semua Data</option>
                            @foreach($dataTag as $key => $data)
                            <option id="namaTag" value="{{$data->ItemTagID}}"{{$data->Name == $data->ItemTagID? 'selected' :'' }}>{{$data->Name}}</option>
                            @endforeach
                        </select>-->
                        <select  id="barang" class="form-control selectpicker" data-live-search="true" data-show-subtext="true">
                            <option value="pilih">--Pilih barang--</option>
                            <!--@foreach($dataBarang as $key => $data)
                            <option id="namaBarang" value="{{$data->ItemID}}"{{$data->ItemName == $data->ItemID? 'selected' :'' }}>{{$data->ItemName}}<nbsp>({{$data->unitName}})</option>
                            @endforeach-->
                        </select>
                        <input id="jumlahBarang" min="1" max="2"  type="number" step=".01" class="form-control" placeholder="Jumlah barang" aria-label="Recipient's username" aria-describedby="basic-addon2" />
                    </div>


                    <label for="title">Pajak</label>

                    <select class="form-control selectpicker" id="tax" data-show-subtext="true">
                            <option value="pilih">--Pajak--</option>
                            @foreach($dataTax as $key => $data)
                            <option id="taxId" taxPercent="{{$data->TaxPercent}}" value="{{$data->TaxID}}"{{$data->Name == $data->TaxID? 'selected' :'' }}>{{$data->Name}}</option>
                            @endforeach
                    </select>
                  
                    <div class="form-group mb-3" id="harga">
                        <label for="title">Harga</label>
                        <input  type="text" id="tanpa-rupiah" class="form-control" value="{{old('harga','')}}" >
                        <input type="hidden" id="hargaBarang" value="">
                    </div>

                    <div class="form-group mb-3" id="ket">
                        <label for="title">Keterangan</label>
                        <textarea rows="3"  type="text" id="keteranganBarang" class="form-control" value="{{old('keterangan','')}}" ></textarea>
                    </div>
                                   
                    <input class="btn btn-primary btn-lg btn-block" type="button" id="tambahKeranjang" value="Tambah kedalam Keranjang">
                </div>
            </div>
            <!--End Permintaan-->
            <!--Start Keranjang-->
            
            <div class="col-md-6 mb-3">
                
            
                <!--<input type="hidden" name="tanggalDibutuhkan" value="{{old('tanggalDibutuhkanVal')}}">
                <input type="hidden" name="gudang" value="{{old('tanggalDibutuhkanVal')}}">
                <input type="hidden" name="tanggalAkhir" value="{{old('tanggalAkhirVal')}}">-->
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Keranjang</span>
                    <span class="badge badge-secondary badge-pill" name="totalBarangnya" id="totalBarangnya" value="0">0</span>
                </h4>
                <ul class="list-group mb-3 sticky-top" id="keranjang">
                    <!--<li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <input type="hidden" name="itemId[]" value="">
                            <input type="hidden" name="itemTotal[]" value="">
                            <input type="hidden" name="itemKeterangan[]" value="">
                            <input type="hidden" name="itemHarga[]" value="">
                            <h6 class="my-0">Product name <small>(6)</small> </h6> 
                            <small class="text-muted">Keterangan</small><br>                    
                        </div>
                        <div>
                            <strong>$20</strong>
                            <button class="btn btn-primary copyKe" type="button" id="copyKe">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                    <path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
                                </svg>
                            </button>
                            <button class="btn btn-danger" type="button" id="hapusKeranjang">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                                    <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                                </svg>
                            </button>  
                        </div>
                    </li>      -->            
                </ul>
                <li class="list-group-item d-flex justify-content-between">
                        <span>Total (Rupiah)</span>
                        <strong id="totalJumlahHarga">$20</strong>
                </li>
                
                <button class="btn btn-primary" type="submit" id="tambah">Kirim</button><br>
                
            </div>
            
            <!--End Keranjang-->

            
        </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var tambahCombo = "";
    var totalTambah = 0;
    

    //$('body').on('click','#namaTag', function(){
        
    //});
    $("#pReq").change(function() {
        //alert(this.value);
        var id = this.value;
        var optionnya = '';
        //var dataBarangTag = <?php //echo json_encode($dataBarangTag); ?>;
        var dataPurchaseRequestDetail = <?php echo json_encode($dataPurchaseRequestDetail); ?>;

        //alert('masuk sini');
        optionnya += '<option value="" selected>--Pilih barang--</option>\n';
        $.each(dataPurchaseRequestDetail, function( key, value ){
            //alert(value.ItemName);
            if(value.idPurchaseRequest.toString() == id.toString()){
                //alert('masuk');
                optionnya += '<option id="namaBarang" idPr='+ value.ItemID +' value="'+value.id+'">'+value.ItemName+'<nbsp>('+value.UnitName+')</option>\n';               
            }
        });
        //alert(optionnya);
        
        //alert(optionnya);
                            
        $("#barang").empty();
        $("#barang").append(optionnya);
        $('.selectpicker').selectpicker('refresh');
    });

    $("#barang").change(function() {
        //alert(this.value);
        var id = this.value;
        var dataPurchaseRequestDetail = <?php echo json_encode($dataPurchaseRequestDetail); ?>;

        $.each(dataPurchaseRequestDetail, function( key, value ){
            //alert(value.ItemName);
            if(value.id.toString() == id.toString()){
                var maxAngka = parseFloat(value.jumlah) - parseFloat(value.jumlahProses);
                //alert(maxAngka);
                $("#jumlahBarang").attr({
                    "max" : maxAngka,        
                    "min" : 1,
                    "placeholder" : "Jumlah Barang (Maksimal: " + maxAngka + ")",          
                });  
                $("#jumlahBarang").val("");    
            }
        });
        
    });

    $('body').on('click','#hapusKeranjang', function(){
        //alert($('.cekId:eq(2)').val());
        //alert($('.cekId').length);
        $(this).parent().parent().remove();
        totalTambah -= 1;
        $('#totalBarangnya').val(totalTambah);
        $('#totalBarangnya').html(totalTambah);
    });

    $('body').on('click','#tambahKeranjang', function(){
        var idPurchaseDetail = $("#barang").val();//
        var namaBarang = $("#barang option:selected").html();//
        var jumlahBarang = $("#jumlahBarang").val();//
        var hargaBarang = $("#hargaBarang").val();//
        var keteranganBarang = $("#keteranganBarang").val();//
        var taxPercent = $("#tax option:selected").attr("taxPercent");
        var taxId = $("#tax option:selected").val();
        var idBarang = $("#barang option:selected").attr("idPr");
        //alert(taxPercent);
        
        var indexSama = null;
        /*for(let i=0;i<$('.cekId').length;i++){
            if($('.cekId:eq('+i+')').val() == idBarang){
                if($('.cekHarga:eq('+i+')').val() == hargaBarang){
                    indexSama = i;
                }
            }
        }*/
        if(idBarang == "" || namaBarang == "--Pilih barang--" || jumlahBarang == 0 || jumlahBarang == "" || hargaBarang == 0 || hargaBarang == "" || keteranganBarang == "" || parseFloat(jumlahBarang) > parseFloat($("#jumlahBarang").attr("max"))){
            alert('Harap lengkapi atau isi data Barang dengan benar');
            die;
        }
        //alert(jumlahBarang + hargaBarang+ keteranganBarang);
        else if(indexSama != null){
            var jumlah = $('.cekJumlah:eq('+indexSama+')').val();
            $('.cekJumlah:eq('+indexSama+')').val(parseInt(jumlah) + parseInt(jumlahBarang))
            var keterangan = $('.cekKeterangan:eq('+indexSama+')').val();
            $('.cekKeterangan:eq('+indexSama+')').val(keterangan + ".\n" +keteranganBarang)
            
            $('.keteranganVal:eq('+indexSama+')').html($('.cekKeterangan:eq('+indexSama+')').val());
            $('.hargaVal:eq('+indexSama+')').html(($('.cekJumlah:eq('+indexSama+')').val()));

        }
        else{
            var htmlKeranjang = "";
            htmlKeranjang += '<li class="list-group-item d-flex justify-content-between lh-condensed">\n';
            htmlKeranjang += '<div>\n';
            htmlKeranjang += '<input type="hidden" class="cekId" name="itemId[]" value="'+idBarang+'">\n';
            htmlKeranjang += '<input type="hidden" class="cekJumlah" name="itemTotal[]" value="'+jumlahBarang+'">\n';
            htmlKeranjang += '<input type="hidden" class="cekKeterangan" name="itemKeterangan[]" value="'+keteranganBarang+'">\n';
            htmlKeranjang += '<input type="hidden" class="cekHarga" name="itemHarga[]" value="'+hargaBarang+'">\n';
            htmlKeranjang += '<input type="hidden" class="cekTax" name="itemTax[]" value="'+taxID+'">\n';
            htmlKeranjang += '<input type="hidden" class="cekPrd" name="prdID[]" value="'+idPurchaseDetail+'">\n';
            htmlKeranjang += '<h6 class="my-0">'+ namaBarang +'<small class="hargaVal" value="'+jumlahBarang+'">('+jumlahBarang+')</small> </h6>\n';
            htmlKeranjang += '<small class="text-muted keteranganVal" value="'+keteranganBarang+'">'+keteranganBarang+'</small><br>\n';
            htmlKeranjang += '</div>\n';
            htmlKeranjang += '<div>\n';
            htmlKeranjang += '<strong value="'+hargaBarang * jumlahBarang / (100.0-taxPercent) * 100+'">Rp. '+hargaBarang * jumlahBarang / (100.0-taxPercent) * 100+',-</strong>\n';
            htmlKeranjang += '<button class="btn btn-danger" type="button" id="copyKe">\n';
            htmlKeranjang += '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">\n';
            htmlKeranjang += '<path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>\n';
            htmlKeranjang += '</svg>\n';
            htmlKeranjang += '</button>\n';
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

            var maxAngka = parseFloat($("#jumlahBarang").attr("max")) - parseFloat(jumlahBarang);
            //alert(maxAngka);
            $("#jumlahBarang").attr({
                "max" : maxAngka,        
                "min" : 1,
                "placeholder" : "Jumlah Barang (Maksimal: " + maxAngka + ")",       
            });     
            $("#jumlahBarang").val("");    
        }

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

    /* Tanpa Rupiah */
    var tanpa_rupiah = document.getElementById('tanpa-rupiah');
    tanpa_rupiah.addEventListener('keyup', function(e)
    {
        $('#hargaBarang').val(this.value);
        tanpa_rupiah.value = formatRupiah(this.value);
    });

    /* Dengan Rupiah */
    var dengan_rupiah = document.getElementById('dengan-rupiah');
    dengan_rupiah.addEventListener('keyup', function(e)
    {
        $('#hargaBarang').val(this.value);
        dengan_rupiah.value = formatRupiah(this.value, 'Rp. ');
    });

    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
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

 