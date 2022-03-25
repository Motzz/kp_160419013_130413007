@extends('layouts.home_master')

@if(session()->has('status'))
    <div class="alert alert-success">
        {{ session()->get('status') }}
    </div>
@endif

@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Purchase Request</h1>
    <a href="{{route('purchaseRequest.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        Tambah Purchase Request <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                           </svg></a>
</div>

<!-- Content Row -->
<div class="row">
    
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">Purchase Request</div>
                <div class="card-body">
                    <div>
                     <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Nama</th>
                               <th scope="col">Tanggal Terima</th>
                              <th scope="col">Status</th>
                            </tr>
                          </thead>
                          <tbody>

                            <tr>
                              <th scope="row" name='id'>{{$purchaseRequest->id}}</th>
                              <td>{{$purchaseRequest->name}}</td>
                              <td>{{$purchaseRequest->tanggalDiterima}}</td>
                              @if($purchaseRequest->approved==0)
                              <td>Not Approved</td>
                              @else
                              <td>Approved</td>
                              @endif

                            </tr>

                           
                          </tbody>
                        </table>
                       
                </div>

                </div>

            </div>
        </div>
    </div>
</div>
</div>


</div>

@endsection