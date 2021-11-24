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
        $m0d1 = date("Y-m-d", strtotime("first day of 0 month"));
        $m0d31 = date("Y-m-d", strtotime("last day of 0 month"));
        $m1d1 = date("Y-m-d", strtotime("first day of -1 month"));
        $m1d31 = date("Y-m-d", strtotime("last day of -1 month"));
        $m2d1 = date("Y-m-d", strtotime("first day of -2 month"));
        $m2d31 = date("Y-m-d", strtotime("last day of -2 month"));
        $m3d1 = date("Y-m-d", strtotime("first day of -3 month"));
        $m3d31 = date("Y-m-d", strtotime("last day of -3 month"));
        $m0 = date('Y-M', strtotime('0 month'));
        $m1 = date('Y-M', strtotime('-1 month'));
        $m2 = date('Y-M', strtotime('-2 month'));
        $m3 = date('Y-M', strtotime('-3 month'));
        $m0pos = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Positive"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m0d1, $m0d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m0posCount = collect($m0pos)->count();

        $m0neu = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Neutral"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m0d1, $m0d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m0neuCount = collect($m0neu)->count();

        $m0neg = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Negative"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m0d1, $m0d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m0negCount = collect($m0neg)->count();

        $m1pos = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Positive"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m1d1, $m1d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m1posCount = collect($m1pos)->count();

        $m1neu = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Neutral"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m1d1, $m1d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m1neuCount = collect($m1neu)->count();

        $m1neg = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Negative"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m1d1, $m1d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m1negCount = collect($m1neg)->count();

        $m2pos = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Positive"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m2d1, $m2d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m2posCount = collect($m2pos)->count();

        $m2neu = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Neutral"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m2d1, $m2d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m2neuCount = collect($m2neu)->count();

        $m2neg = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Negative"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m2d1, $m2d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m2negCount = collect($m2neg)->count();

        $m3pos = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Positive"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m3d1, $m3d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m3posCount = collect($m3pos)->count();

        $m3neu = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Neutral"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m3d1, $m3d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m3neuCount = collect($m3neu)->count();

        $m3neg = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Negative"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m3d1, $m3d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m3negCount = collect($m3neg)->count();
        $output[] = [
            "m0" => $m0,
            "m0posCount" => $m0posCount,
            "m0neuCount" => $m0neuCount,
            "m0negCount" => $m0negCount,
            "m1" => $m1,
            "m1posCount" => $m1posCount,
            "m1neuCount" => $m1neuCount,
            "m1negCount" => $m1negCount,
            "m2" => $m2,
            "m2posCount" => $m2posCount,
            "m2neuCount" => $m2neuCount,
            "m2negCount" => $m2negCount,
            "m3" => $m3,
            "m3posCount" => $m3posCount,
            "m3neuCount" => $m3neuCount,
            "m3negCount" => $m3negCount,
        ];
        return response()->json($output, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
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
