<?php

namespace App\Http\Controllers;

use App\Models\MGudangAreaSimpan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class MGudangAreaSimpanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MGudangAreaSimpan  $mGudangAreaSimpan
     * @return \Illuminate\Http\Response
     */
    public function show(MGudangAreaSimpan $mGudangAreaSimpan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MGudangAreaSimpan  $mGudangAreaSimpan
     * @return \Illuminate\Http\Response
     */
    public function edit(MGudangAreaSimpan $mGudangAreaSimpan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MGudangAreaSimpan  $mGudangAreaSimpan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MGudangAreaSimpan $mGudangAreaSimpan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MGudangAreaSimpan  $mGudangAreaSimpan
     * @return \Illuminate\Http\Response
     */
    public function destroy(MGudangAreaSimpan $mGudangAreaSimpan)
    {
        //
    }
}
