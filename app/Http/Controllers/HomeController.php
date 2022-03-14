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
        $user_2 = DB::table('roles')
            ->select('menu.*')
            ->join('role_access','roles.id','=','role_access.idRole')
            ->join('menu','role_access.idMenu','=','menu.MenuID')
            ->where('roles.id', $user->idRole)
            ->where('menu.Name','%create_purchase_order%')
            ->get();

        $user_3 = DB::table('roles')
            ->select('menu.*')
            ->join('role_access','roles.id','=','role_access.idRole')
            ->join('menu','role_access.idMenu','=','menu.MenuID')
            ->where('roles.id', $user->idRole)
            ->where('menu.Name','%approve_purchase_order%')
            ->get();

        $getData = DB::table('MGudang')
            ->where('UserIDKepalaDivisi','=', $user->id)
            ->get();


        $message = null;
        if(count($getData) > 0){
            $message= DB::table('purchase_request')
                ->where('approved',0)
                ->where('hapus',0)
                ->where('MGudangID',$user->MGudangID)
                ->get();
        }
        elseif(count($user_2) > 0){
            $message= DB::table('purchase_request')
                ->where('approved',1)
                ->where('proses', 1)
                ->where('hapus',0)
                ->get();
        }
        elseif(count($user_3) > 0){
            $message= DB::table('purchase_order')
                ->where('approved',0)
                ->where('hapus',0)
                ->get();
        }
        
        return view('home',[
            'message' => $message,
        ]);
    }
}
