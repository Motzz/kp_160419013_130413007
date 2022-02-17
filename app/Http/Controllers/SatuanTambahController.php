<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SatuanTambahController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('/master/satuan_tambah');
    }


    protected function create(array $data)
    {
        
        $id = DB::table('satuan')->insert(
            array(
                'name' =>$data['satuan']
            )
        );
        if($id != null){
            return view('master/satuan');   
        }
        else{   
        }
    }
}
