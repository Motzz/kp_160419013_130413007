@extends('layouts.home_master')
<?php 
//$currentUrl = Route::current()->getName();  //buat dapetno nama directory nya / route yang diapakek

//echo($currentUrl);
?>


@section('content')
<div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Item</h1>
        
         <br>
         <a href="{{route('item.create')}}" class="btn btn-primary btn-responsive">Tambah Item
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
              </svg>
        </a> 
        
    </div>
</div>


<br>
<div class="container">
    <div class="row height d-flex justify-content-center align-items-center">
        <div class="col-md-8">
               <form class='form' action="/iteme/searchname/" method="get" >
                    <div class="input-group"> 
                      <input type="text" class="form-control mr-2" name="searchname" placeholder="Mencari Nama Barang" >                   
                            <button class="btn btn-info" type="submit" title="Search name">
                                <span class="fas fa-search"></span>
                            </button>
                    </div>
                </form>
        </div>
       
    </div>
</div><br>
<div class="container">
    <div class="row height d-flex justify-content-center align-items-center">
        <div class="col-md-8">
               <form class='form' action="/iteme/searchtag/" method="get" >
                    <div class="input-group"> 
                        <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    	<span id="search_concept">Filter by</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#contains">Contains</a></li>
                      <li><a href="#its_equal">It's equal</a></li>
                      <li><a href="#greather_than">Greather than ></a></li>
                      <li><a href="#less_than">Less than < </a></li>
                      <li class="divider"></li>
                      <li><a href="#all">Anything</a></li>
                    </ul>
                </div>
                      <input type="text" class="form-control mr-2" name="searchtag" placeholder="Mencari Tag Barang" >                   
                            <button class="btn btn-info" type="submit" title="Search name">
                                <span class="fas fa-search"></span>
                            </button>
                    </div>
                </form>
        </div>
       
    </div>
</div>

<!-- Content Row -->

<div class="container">
  <div class="row">
    <div class="col-12">
       <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Nama Item</th>
                            
                              <th scope="col">Tag</th>
                              <th scope="col">Handle</th>
                            </tr>
                          </thead>
                          <tbody>
                          @foreach($dataItem as $key => $data)            
                          <tr>
                                    
                              <th scope="row">{{$data->ItemID}}</th>
                              <td>{{$data->ItemName}}</td>                     
                             
                              <td>
                                @foreach($dataTag as $tag) 
                                  @if($tag->ItemID == $data->ItemID)
                                  <span class="badge badge-pill badge-success"> {{$tag->Name}}</span>
                                   
                                  @endif
                                @endforeach
                                
                              </td>
                              <td>  
                              <a href="{{route('item.show',[$data->ItemID])}}" class="btn btn-primary btn-responsive">Detail</a> 
                              <a href="{{route('item.edit',[$data->ItemID])}}" class="btn btn-secondary btn-responsive">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                </svg>
                              </a> 
                                  <form action="{{route('item.destroy',[$data->ItemID])}}" method="POST" class="btn btn-responsive">
                                    @csrf
                                    @method('DELETE')
                                    <button action="{{route('item.destroy',[$data->ItemID])}}" method="POST" class="btn btn-secondary btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                       <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                
                                    </button>
                                   </form>
                              </td>
                            </tr>
                            @endforeach      

                            <!--@for ($i = 0; $i < count($dataItem); $i++)
                              {{$dataItem}}
                            @endfor      -->  
                          </tbody>
                        
                        </table>
                          {{$dataItem->links()}}
                        
                       
   </div>
  </div>
</div>


@endsection