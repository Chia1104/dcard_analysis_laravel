<?php

namespace App\Http\Controllers;

use App\Models\GBChart12Data;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use PDO;
use Illuminate\Support\Collection;

class GBChart12DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $m0d1 = date("Y-m-d", strtotime("first day of 0 month"));
        $m0d31 = date("Y-m-d", strtotime("last day of 0 month"));
        $m1d1 = date("Y-m-d", strtotime("first day of -1 month"));
        $m1d31 = date("Y-m-d", strtotime("last day of -1 month"));
        $m2d1 = date("Y-m-d", strtotime("first day of -2 month"));
        $m2d31 = date("Y-m-d", strtotime("last day of -2 month"));
        $m3d1 = date("Y-m-d", strtotime("first day of -3 month"));
        $m3d31 = date("Y-m-d", strtotime("last day of -3 month"));
        $m4d1 = date("Y-m-d", strtotime("first day of -4 month"));
        $m4d31 = date("Y-m-d", strtotime("last day of -4 month"));
        $m5d1 = date("Y-m-d", strtotime("first day of -5 month"));
        $m5d31 = date("Y-m-d", strtotime("last day of -5 month"));
        $m6d1 = date("Y-m-d", strtotime("first day of -6 month"));
        $m6d31 = date("Y-m-d", strtotime("last day of -6 month"));
        $m7d1 = date("Y-m-d", strtotime("first day of -7 month"));
        $m7d31 = date("Y-m-d", strtotime("last day of -7 month"));
        $m8d1 = date("Y-m-d", strtotime("first day of -8 month"));
        $m8d31 = date("Y-m-d", strtotime("last day of -8 month"));
        $m9d1 = date("Y-m-d", strtotime("first day of -9 month"));
        $m9d31 = date("Y-m-d", strtotime("last day of -9 month"));
        $m10d1 = date("Y-m-d", strtotime("first day of -10 month"));
        $m10d31 = date("Y-m-d", strtotime("last day of -10 month"));
        $m11d1 = date("Y-m-d", strtotime("first day of -11 month"));
        $m11d31 = date("Y-m-d", strtotime("last day of -11 month"));
        $m0 = date('Y-M', strtotime('0 month'));
        $m1 = date('Y-M', strtotime('-1 month'));
        $m2 = date('Y-M', strtotime('-2 month'));
        $m3 = date('Y-M', strtotime('-3 month'));
        $m4 = date('Y-M', strtotime('-4 month'));
        $m5 = date('Y-M', strtotime('-5 month'));
        $m6 = date('Y-M', strtotime('-6 month'));
        $m7 = date('Y-M', strtotime('-7 month'));
        $m8 = date('Y-M', strtotime('-8 month'));
        $m9 = date('Y-M', strtotime('-9 month'));
        $m10 = date('Y-M', strtotime('-10 month'));
        $m11 = date('Y-M', strtotime('-11 month'));
        $m0posCount = 0;
        $m0neuCount = 0;
        $m0negCount = 0;
        $m1posCount = 0;
        $m1neuCount = 0;
        $m1negCount = 0;
        $m2posCount = 0;
        $m2neuCount = 0;
        $m2negCount = 0;
        $m3posCount = 0;
        $m3neuCount = 0;
        $m3negCount = 0;
        $m4posCount = 0;
        $m4neuCount = 0;
        $m4negCount = 0;
        $m5posCount = 0;
        $m5neuCount = 0;
        $m5negCount = 0;
        $m6posCount = 0;
        $m6neuCount = 0;
        $m6negCount = 0;
        $m7posCount = 0;
        $m7neuCount = 0;
        $m7negCount = 0;
        $m8posCount = 0;
        $m8neuCount = 0;
        $m8negCount = 0;
        $m9posCount = 0;
        $m9neuCount = 0;
        $m9negCount = 0;
        $m10posCount = 0;
        $m10neuCount = 0;
        $m10negCount = 0;
        $m11posCount = 0;
        $m11neuCount = 0;
        $m11negCount = 0;
        $m0result = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m0d1, $m0d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m1result = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m1d1, $m1d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m2result = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m2d1, $m2d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m3result = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m3d1, $m3d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m4result = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m4d1, $m4d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m5result = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m5d1, $m5d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m6result = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m6d1, $m6d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m7result = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m7d1, $m7d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m8result = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m8d1, $m8d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m9result = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m9d1, $m9d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m10result = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m10d1, $m10d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m11result = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m11d1, $m11d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        return response()->json($m0result, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
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
     * @param  \App\Models\GBChart12Data  $gBChart12Data
     * @return \Illuminate\Http\Response
     */
    public function show(GBChart12Data $gBChart12Data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GBChart12Data  $gBChart12Data
     * @return \Illuminate\Http\Response
     */
    public function edit(GBChart12Data $gBChart12Data)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GBChart12Data  $gBChart12Data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GBChart12Data $gBChart12Data)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GBChart12Data  $gBChart12Data
     * @return \Illuminate\Http\Response
     */
    public function destroy(GBChart12Data $gBChart12Data)
    {
        //
    }
}
