<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $user = Auth::user();
        $getDataKepalaDivisi = DB::table('MGudang')
            ->where('UserIDKepalaDivisi','=', $user->id)
            ->get();
        
        $getData = DB::table('MGudang')
            ->where('UserIDKepalaDivisi','=', $user->id)
            ->get();
        if(count($getData) == 0){
            echo 'masukk';
        }
            
        $messageForApprovalPR = DB::table('purchase_request')
            ->where('approved',0)
            ->where('hapus',0)
            ->get();
        
        return view('home',[
            'messageForApprovalPR' => $messageForApprovalPR,
        ]);
    }
}
