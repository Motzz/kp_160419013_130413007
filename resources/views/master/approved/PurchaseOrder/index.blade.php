
@extends('layouts.home_master')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Persetujuan Permintaan Pembelian</h1>
    </div>

    <!-- Content Row -->
    <div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Status Approve 1</th>
                                <th scope="col">Status Approve 2</th>
                                <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prKeluar as $purchaseRequest)
                                <tr >
                                <th scope="row" name='id'>{{$purchaseRequest->id}}</th>
                                <td>{{$purchaseRequest->name}}</td>
                                @if($purchaseRequest->approved==0)
                                <td>Not Approved</td>
                                @else
                                <td>Approved</td>
                                @endif

                                @if($purchaseRequest->approvedAkhir==0)
                                <td>Not Approved</td>
                                @else
                                <td>Approved</td>
                                @endif
                                <td>  
                                <a href="{{route('approvedPurchaseRequest.edit',[$purchaseRequest->id])}}" class="btn btn-primary btn-responsive">Approve</a>
                                    
                                
                                </td>
                                
                                </tr>
                                @endforeach
                            
                            </tbody>
                            </table>
                        
        </div>
    </div>
    </div>

</div>

@endsection