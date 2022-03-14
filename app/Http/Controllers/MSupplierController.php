<?php

namespace App\Http\Controllers;

use App\Models\MSupplier;
use Illuminate\Http\Request;

class MSupplierController extends Controller
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
        $data = DB::table('MSupplier')
            ->leftjoin('infoSupplier', 'MSupplier.InfoSupplierID','=','infoSupplier.InfoSupplierID')
            ->leftjoin('MCurrency','MSupplier.MCurrencyID','=','MCurrency.MCurrencyID')
            ->leftjoin('Tax','MSupplier.TaxID','=','Tax.TaxID')
            ->leftjoin('PaymentTerms','MSupplier.PaymentTermsID','=','PaymentTerms.PaymentTermsID')
            ->leftjoin('MKota','MSupplier.MKotaID','=','MKota.MKotaID')
            ->get();
        return view('master.msupplier.index',[
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $infoSupplier = DB::table('infoSupplier')
            ->get();
        $MCurrency = DB::table('MCurrency')
            ->get();
        $Tax = DB::table('Tax')
            ->get();
        $PaymentTerms = DB::table('PaymentTerms')
            ->get();
        $MKota = DB::table('MKota')
            ->get();
        return view('master.msupplier.index',[
                'infoSupplier' => $infoSupplier,
                'MCurrency' => $MCurrency,
                'Tax' => $Tax,
                'PaymentTerms' => $PaymentTerms,
                'MKota' => $MKota,
        ]);
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
        $data = $request->collect();
        $user = Auth::user();
        
        DB::table('MSupplier')
            ->insert(array(
                'InfoSupplierID' => $data['infoSupplierID'],
                'MCurrencyID' => $data['mCurrencyID'],
                'TaxID' => $data['taxID'],
                'CostCodeID' => $data['costCodeID'],
                'Name' => $data['name'],
                'Alamat' => $data['alamat'],
                'Kota' => $data['kota'],
                'KodePos' => $data['kodePos'],
                'Phone1' => $data['phone1'],
                'Phone2' => $data['phone2'],
                'Fax1' => $data['fax1'],
                'Fax2' => $data['fax2'],
                'ContactPerson' => $data['contactPerson'],
                'Email' => $data['email'],
                'NPWP' => $data['NPWP'],
                'RekeningBank' => $data['rekeningBank'],
                'NoRekening' => $data['noRekening'],
                'Note' => $data['note'],
                'AtasNama' => $data['atasNama'],
                'Lokasi' => $data['lokasi'],
                'Kode' => $data['kode'],
                'Hapus' => 0,
                'Keterangan' => $data['keterangan'],
                'SaldoDP' => $data['saldoDP'],
                'NamaNPWP' => $data['namaNPWP'],
                'SKT' => $data['SKT'],
                'SPPKP' => $data['SPPKP'],
                'KTP' => $data['KTP'],
                'MKotaID' => $data['mKotaID'],
                'CreatedBy'=> $user->id,
                'CreatedOn'=> date("Y-m-d h:i:sa"),
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
                
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MSupplier  $mSupplier
     * @return \Illuminate\Http\Response
     */
    public function show(MSupplier $mSupplier)
    {
        //
        return view('master.msupplier.detail',[
            'mSupplier' => $mSupplier,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MSupplier  $mSupplier
     * @return \Illuminate\Http\Response
     */
    public function edit(MSupplier $mSupplier)
    {
        //
        $infoSupplier = DB::table('infoSupplier')
            ->get();
        $MCurrency = DB::table('MCurrency')
            ->get();
        $Tax = DB::table('Tax')
            ->get();
        $PaymentTerms = DB::table('PaymentTerms')
            ->get();
        $MKota = DB::table('MKota')
            ->get();
        return view('master.mcurrency.index',[
                'infoSupplier' => $infoSupplier,
                'MCurrency' => $MCurrency,
                'Tax' => $Tax,
                'PaymentTerms' => $PaymentTerms,
                'MKota' => $MKota,
                'mSupplier' => $mSupplier,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MSupplier  $mSupplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MSupplier $mSupplier)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        DB::table('MSupplier')
            ->where('MSupplier', $mSupplier['id'])
            ->update(array(
                'InfoSupplierID' => $data['infoSupplierID'],
                'MCurrencyID' => $data['mCurrencyID'],
                'TaxID' => $data['taxID'],
                'CostCodeID' => $data['costCodeID'],
                'Name' => $data['name'],
                'Alamat' => $data['alamat'],
                'Kota' => $data['kota'],
                'KodePos' => $data['kodePos'],
                'Phone1' => $data['phone1'],
                'Phone2' => $data['phone2'],
                'Fax1' => $data['fax1'],
                'Fax2' => $data['fax2'],
                'ContactPerson' => $data['contactPerson'],
                'Email' => $data['email'],
                'NPWP' => $data['NPWP'],
                'RekeningBank' => $data['rekeningBank'],
                'NoRekening' => $data['noRekening'],
                'Note' => $data['note'],
                'AtasNama' => $data['atasNama'],
                'Lokasi' => $data['lokasi'],
                'Kode' => $data['kode'],
                'Hapus' => 0,
                'Keterangan' => $data['keterangan'],
                'SaldoDP' => $data['saldoDP'],
                'NamaNPWP' => $data['namaNPWP'],
                'SKT' => $data['SKT'],
                'SPPKP' => $data['SPPKP'],
                'KTP' => $data['KTP'],
                'MKotaID' => $data['mKotaID'],
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MSupplier  $mSupplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(MSupplier $mSupplier)
    {
        //
        $data = $request->collect();
        $user = Auth::user();
        DB::table('MSupplier')
            ->where('MSupplier', $mSupplier['id'])
            ->update(array(
                'Hapus' => 1,
                'UpdatedBy'=> $user->id,
                'UpdatedOn'=> date("Y-m-d h:i:sa"),
            )
        );
    }
}