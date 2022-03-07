<?php

namespace App\Http\Controllers;

use App\Models\UserAccess;
use Illuminate\Http\Request;

class UserAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menuByUserID = DB::table('menu')
            ->select('menu.*','role_access.idRole as roleMenu', 'user_access.idUsers as userMenu')
            ->leftjoin('user_access', 'menu.MenuID','=','user_access.idMenu')
            ->leftjoin('role_access', 'menu.MenuID','=','role_access.idMenu')
            ->get();
        return view('master.userAccess.index',[
            'menuByUserID' => $menuByUserID,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //no
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //no
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAccess  $userAccess
     * @return \Illuminate\Http\Response
     */
    public function show(UserAccess $userAccess)
    {
        //no
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAccess  $userAccess
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAccess $userAccess)
    {
        //
        $menuByUserID = DB::table('menu')
            ->select('menu.*','role_access.idRole as roleMenu', 'user_access.idUsers as userMenu')
            ->leftjoin('user_access', 'menu.MenuID','=','user_access.idMenu')
            ->leftjoin('role_access', 'menu.MenuID','=','role_access.idMenu')
            ->get();
        return view('master.userAccess.edit',[
            'menuByUserID' => $menuByUserID,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserAccess  $userAccess
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAccess $userAccess)
    {
        //masih bingung belum ada gambaran
        //pakek checkbox nanti disave baru keupdate
        for($i = 0; $i < count($data['menuTotal']); $i++){
            if($data['menu'][$i] != "" || $data['menu'][$i] != null || $data['menu'][$i] != 0 ){
                //update berdasarkan nama e apa
                //updatenya nambah row di bagian user_access


            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAccess  $userAccess
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAccess $userAccess)
    {
        //no
    }
}
