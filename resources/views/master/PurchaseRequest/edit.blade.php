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
   <form action="{{route('purchaseRequest.update',[$purchaseRequest->id])}}" method="POST" >
            @csrf
            @method('PUT')
        <div class="py-5 ">
            <h2>Pembuatan Nota Permintaan Pembelian</h2><br>
           
               <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="firstName">Nama NPP</label>
                        <input type="text" class="form-control" id="firstName" placeholder="" value="{{old('name',$purchaseRequest->name)}}" readonly required="">
                        <div class="invalid-feedback"> Valid first name is required. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Tanggal Pembuatan</label>
                        <input type="date" class="form-control" id="lastName" placeholder="" value="{{old('created_on',$purchaseRequest->created_on)}}" readonly required="">
                        <div class="invalid-feedback"> Valid last name is required. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Tanggal Dibutuhkan</label>
                        <input type="date" name="tanggalDibutuhkan" class="form-control" id="firstName" placeholder="" value="{{old('tanggalDibutuhkan',$purchaseRequest->tanggalDibutuhkan)}}" required="">
                        <div class="invalid-feedback"> Valid first name is required. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Tanggal Batas Akhir</label>
                        <input type="date" name="tanggalAkhir" class="form-control" id="lastName" placeholder="" value="{{old('tanggalAkhir',$purchaseRequest->tanggalAkhirDibutuhkan)}}" required="">
                        <div class="invalid-feedback"> Valid last name is required. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Gudang</label>
                        <select required name="gudang" class="form-control">
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

                    <div class="col-md-6 mb-3">
                        <label for="lastName">Jenis Permintaan</label> 
                        <select name="jenisProses" class="form-control selectpicker" data-live-search="true" data-show-subtext="true">
                                @if($purchaseRequest->jenisProses==1)
                                <option value="1" selected>Pembelian Melalui Pusat</option>
                                <option value="0">Pembelian Melalui Lokal</option>
                                @else
                                <option value="1">Pembelian Melalui Pusat</option>
                                <option value="0" selected>Pembelian Melalui Lokal</option>
                                @endif
                            
                        </select>
                    </div>
                </div>     
        </div>
        <div class="row">
            <!--Start Permintaan-->
            <div class="col-md-6 mb-3 bg-light text-dark border ">
                <h4 class="mb-3">Billing address</h4>
                <div >
                    <div class="form-group"  id='tmbhBarang'>
                        <label for="title">Barang</label>
                        <select   class="form-control" id="barang">
                            <option value="">--Pilih barang--</option>
                            @foreach($dataBarang as $key => $data)
                            <option id="namaBarang" value="{{$data->ItemID}}"{{$data->ItemName == $data->ItemID? 'selected' :'' }}>{{$data->ItemName}}<nbsp>({{$data->unitName}})  </option>
                            @endforeach
                        </select>
                        <input min=1   type="number" step=".01" class="form-control" placeholder="Jumlah barang" aria-label="Recipient's username" aria-describedby="basic-addon2"id="jumlahBarang" />
                    </div>
                  
                    <div class="form-group mb-3" id="harga">
                        <label for="title">Harga</label>
                        <input  type="text" step=".01" id="tanpa-rupiah" class="form-control" value="{{old('harga','')}}" >
                        <input type="hidden" id="hargaBarang" value = "">
                    </div>

                    <div class="form-group mb-3" id="ket">
                        <label for="title">Keterangan</label>
                        <textarea  rows="3" id="keteranganBarang" class="form-control" value="{{old('keterangan','')}}" ></textarea>
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
                    <span class="badge badge-secondary badge-pill" name="totalBarangnya" id="totalBarangnya" value="0">{{count($dataDetail)}}</span>
                </h4>
                <ul class="list-group mb-3 sticky-top" id="keranjang">
                    @foreach($dataDetail as $data)
                        @foreach($dataBarang as $item)
                          @if($item->ItemID == $data->ItemID)
                    <li  class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <input type="hidden" class="cekId" name="itemId[]" value="{{$data->ItemID}}">
                            <input type="hidden" class="cekJumlah" name="itemTotal[]" value="{{$data->jumlah}}">
                            <input type="hidden" class="cekKeterangan" name="itemKeterangan[]" value="{{$data->keterangan_jasa}}">
                            <input type="hidden" class="cekHarga" name="itemHarga[]" value="{{$data->harga}}">
                            <h6 class="my-0">{{$item->ItemName}}<small class="hargaVal">({{$data->jumlah}})</small> </h6> 
                            <small class="text-muted keteranganVal">{{$data->keterangan_jasa}}</small><br>                      
                        </div>
                        <div>
                            <strong>Rp.{{$data->harga}},-</strong>
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
                    </li>  
                          @endif    
                        @endforeach           
                    @endforeach           
                </ul>
                <!--<li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>$20</strong>
                </li>-->  
                
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

    $('body').on('click','.copyKe', function(){
        //alert($(this).index('.copyKe'));
        var i = $(this).index('.copyKe');
        var idBarang = $('.cekId:eq('+i+')').val();
        //var namaBarang = $('.cekJumlah:eq('+i+')').val();
        var jumlahBarang = $('.cekJumlah:eq('+i+')').val();
        var hargaBarang = $('.cekHarga:eq('+i+')').val();
        var keteranganBarang = $('.cekKeterangan:eq('+i+')').val();
        
        $("#barang").val(idBarang);
        $("#jumlahBarang").val(jumlahBarang);
        $("#hargaBarang").val(hargaBarang);
        $("#tanpa-rupiah").val(formatRupiah(hargaBarang));
        $("#keteranganBarang").val(keteranganBarang);

    });

    $('body').on('click','#hapusKeranjang', function(){
        $(this).parent().parent().remove();
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
        
        var indexSama = null;
        for(let i=0;i<$('.cekId').length;i++){
            if($('.cekId:eq('+i+')').val() == idBarang){
                if($('.cekHarga:eq('+i+')').val() == hargaBarang){
                    indexSama = i;
                }
            }
        }

        if(idBarang == "" || namaBarang == "--Pilih barang--" || jumlahBarang == 0 || jumlahBarang == "" || hargaBarang == 0 || hargaBarang == "" || keteranganBarang == ""){
            alert('Harap lengkapi data Barang untuk menambahkan ke keranjang');
            die;
        }
        //alert(jumlahBarang + hargaBarang+ keteranganBarang);
        else if(indexSama != null){
            var jumlah = $('.cekJumlah:eq('+indexSama+')').val();
            $('.cekJumlah:eq('+indexSama+')').val(parseInt(jumlah) + parseInt(jumlahBarang))
            var keterangan = $('.cekKeterangan:eq('+indexSama+')').val();
            $('.cekKeterangan:eq('+indexSama+')').val(keterangan + ".\n" +keteranganBarang)
            
            $('.keteranganVal:eq('+indexSama+')').html($('.cekKeterangan:eq('+indexSama+')').val());
            $('.jumlahVal:eq('+indexSama+')').html(($('.cekJumlah:eq('+indexSama+')').val()));
            $('.hargaVal:eq('+indexSama+')').html( "Rp. " + ($('.cekJumlah:eq('+indexSama+')').val()* $("#hargaBarang").val())+',-');
            
            var totalHargaKeranjang = $('#TotalHargaKeranjang').val()
            totalHargaKeranjang += ($('.cekJumlah:eq('+indexSama+')').val()) * ($("#hargaBarang").val());
            $('#TotalHargaKeranjang').html(formatRupiah(totalHargaKeranjang));
        }
        else{
            var htmlKeranjang = "";
            htmlKeranjang += '<li class="list-group-item d-flex justify-content-between lh-condensed">\n';
            htmlKeranjang += '<div>\n';
            htmlKeranjang += '<input type="hidden" class="cekId" name="itemId[]" value="'+idBarang+'">\n';
            htmlKeranjang += '<input type="hidden" class="cekJumlah" name="itemTotal[]" value="'+jumlahBarang+'">\n';
            htmlKeranjang += '<input type="hidden" class="cekKeterangan" name="itemKeterangan[]" value="'+keteranganBarang+'">\n';
            htmlKeranjang += '<input type="hidden" class="cekHarga" name="itemHarga[]" value="'+hargaBarang+'">\n';
            htmlKeranjang += '<h6 class="my-0">'+ namaBarang +'<small class="jumlahVal" value="'+jumlahBarang+'">('+jumlahBarang+')</small> </h6>\n';
            htmlKeranjang += '<small class="text-muted keteranganVal" value="'+keteranganBarang+'">'+keteranganBarang+'</small><br>\n';
            htmlKeranjang += '</div>\n';
            htmlKeranjang += '<div>\n';
            htmlKeranjang += '<strong class="hargaVal" value="'+hargaBarang+'">Rp. '+hargaBarang+',-</strong>\n';
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


   /* $("body").on("click", "#tambah", function () {  
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

 