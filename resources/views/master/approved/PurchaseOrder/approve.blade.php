@extends('layouts.home_master')
<style>
            p {
                font-family: 'Nunito', sans-serif;
            }
 </style>
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Persetujuan Permintaan pembelian -> Approve</h1>   
    </div><br><br>
    <div class="container">
    <div class="row">
        <div class="col-12">
        <form method="POST" action="{{route('approvedPurchaseRequest.update',[$purchaseRequest->id])}}" >
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                    <th scope="col" colspan="3"><h2>PERSETUJUAN PERMINTAAN PEMBELIAN</h2></th>
                                    <th scope="col" colspan="3">
                                        Nama Npp : {{$purchaseRequest->name}}<br>
                                        Tanggal pembuatan : {{date("d-m-Y", strtotime($purchaseRequest->created_on))}}

                                    </th>
                                    </tr>
                                </thead>
                                <thead class="thead-light">
                                    <tr>
                                    <th scope="col"colspan="6"cellspacing="3" >
                                                                        
                                    @foreach($dataGudang as $data)
                                        @if($data->MGudangID == $purchaseRequest->MGudangID)
                                        Gudang :{{$data->cname}} <nbsp> ({{$purchaseRequest->MGudangID}}) <br> 
                                        @endif 
                                    @endforeach
                                    Jenis permintaan : {{$purchaseRequest->jenisProses}} <br>
                                    Tanggal dibutuhkan : {{date("d-m-Y", strtotime($purchaseRequest->tanggalDibutuhkan))}}<br>
                                    Tanggal batas akhir : {{date("d-m-Y", strtotime($purchaseRequest->tanggalAkhirDibutuhkan))}}
                                    </th>
                                    </tr>
                                </thead>
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Barang</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>

                                        @foreach($prd as $data) 
                                        <tr>
                                            @if($data->idPurchaseRequest==$purchaseRequest->id)
                                            <th scope="row">{{$data->id}}</th>
                                            <th scope="row">{{$data->ItemName}}</th>
                                            <td>{{$data->jumlah}}</td>
                                            <td>{{number_format($data->harga, 2)}}</td>              
                                            <td>{{$data->keterangan_jasa}}</td>                                          
                                            <td>{{number_format($data->jumlah * $data->harga, 2)}}</td>                                          
                                            @endif
                                        </tr>
                                        @endforeach

                                        <tr>
                                            <th scope="row" colspan="5">Total Harga</th>
                                            <th scope="row">{{number_format($purchaseRequest->totalHarga, 2)}}</th>
                                        </tr>
                                
                                </tbody>
                            </table>

                        </div>

                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <input id="setuju" class="form-check-input" type="radio" name="approve" value="1"{{'1' == old('approved','')? 'checked' :'' }}>
                                <label class="form-check-label" for="setuju">Setuju</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input checked id="tdkSetuju" class="form-check-input" type="radio" name="approve" value="2"{{'2'== old('approved','')? 'checked' :'' }}>
                                <label class="form-check-label" for="tdkSetuju">Tidak Setuju</label><br>
                               
                            </div><br><br>
                            <div id="ket">
                                <label class="form-check-label" >Keterangan :</label><br>
                                <textarea rows="3" required type="text" name="keterangan"class="form-control" value="{{old('keterangan','')}}"></textarea>
                            </div>
                            
                        </div>
                        
                        <button class="btn btn-primary">Save</button>
        </form>

                        
        </div>
      </div>
    </div>

</div>
<script type="text/javascript">
$('body').on("click", "#setuju", function (){

         $("#ket").hide();
});
$('body').on("click", "#tdkSetuju", function (){

        $("#ket").show();
});
/*$(document).ready(function(){
    $('input[name=approve]').click(function(){

        if($("#setuju").is(':checked'))
        {
            $("#ket").hide();
        }
        else
        {
            $("#ket").show();
        }
    });
});*/
</script>
@endsection



