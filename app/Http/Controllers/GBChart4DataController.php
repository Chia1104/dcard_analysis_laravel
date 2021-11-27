<?php

namespace App\Http\Controllers;

use App\Models\GBChart4Data;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use PDO;
use Illuminate\Support\Collection;

class GBChart4DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $m0d31 = date("Y-m-d", strtotime("last day of 0 month"));
        $m3d1 = date("Y-m-d", strtotime("first day of -3 month"));
        $posCount = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select(DB::raw('count(nlp_analysis.SA_Class) as Count'), DB::raw("DATE_FORMAT(dcard_rawdata.CreatedAt, '%Y-%m') as newDate"))
        ->where('nlp_analysis.SA_Class', 'Positive')
        ->groupBy('newDate')
        ->orderByDesc('newDate')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m3d1, $m0d31])
        ->get();
        $posCount = collect($posCount);
        $neuCount = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select(DB::raw('count(nlp_analysis.SA_Class) as Count'), DB::raw("DATE_FORMAT(dcard_rawdata.CreatedAt, '%Y-%m') as newDate"))
        ->where('nlp_analysis.SA_Class', 'Neutral')
        ->groupBy('newDate')
        ->orderByDesc('newDate')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m3d1, $m0d31])
        ->get();
        $neuCount = collect($neuCount);
        $negCount = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select(DB::raw('count(nlp_analysis.SA_Class) as Count'), DB::raw("DATE_FORMAT(dcard_rawdata.CreatedAt, '%Y-%m') as newDate"))
        ->where('nlp_analysis.SA_Class', 'Negative')
        ->groupBy('newDate')
        ->orderByDesc('newDate')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m3d1, $m0d31])
        ->get();
        $negCount = collect($negCount);
        $merged = $posCount->merge($neuCount)->merge($negCount);
        return response()->json($merged, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
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
     * @param  \App\Models\GBChart4Data  $gBChart4Data
     * @return \Illuminate\Http\Response
     */
    public function show(GBChart4Data $gBChart4Data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GBChart4Data  $gBChart4Data
     * @return \Illuminate\Http\Response
     */
    public function edit(GBChart4Data $gBChart4Data)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GBChart4Data  $gBChart4Data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GBChart4Data $gBChart4Data)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GBChart4Data  $gBChart4Data
     * @return \Illuminate\Http\Response
     */
    public function destroy(GBChart4Data $gBChart4Data)
    {
        //
    }
}
