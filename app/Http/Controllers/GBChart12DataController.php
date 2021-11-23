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

        $m4pos = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Positive"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m4d1, $m4d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m4posCount = collect($m4pos)->count();

        $m4neu = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Neutral"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m4d1, $m4d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m4neuCount = collect($m4neu)->count();

        $m4neg = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Negative"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m4d1, $m4d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m4negCount = collect($m4neg)->count();

        $m5pos = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Positive"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m5d1, $m5d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m5posCount = collect($m5pos)->count();

        $m5neu = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Neutral"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m5d1, $m5d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m5neuCount = collect($m5neu)->count();

        $m5neg = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Negative"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m5d1, $m5d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m5negCount = collect($m5neg)->count();

        $m6pos = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Positive"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m6d1, $m6d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m6posCount = collect($m6pos)->count();

        $m6neu = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Neutral"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m6d1, $m6d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m6neuCount = collect($m6neu)->count();

        $m6neg = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Negative"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m6d1, $m6d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m6negCount = collect($m6neg)->count();

        $m7pos = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Positive"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m7d1, $m7d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m7posCount = collect($m7pos)->count();

        $m7neu = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Neutral"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m7d1, $m7d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m7neuCount = collect($m7neu)->count();

        $m7neg = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Negative"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m7d1, $m7d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m7negCount = collect($m7neg)->count();

        $m8pos = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Positive"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m8d1, $m8d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m8posCount = collect($m8pos)->count();

        $m8neu = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Neutral"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m8d1, $m8d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m8neuCount = collect($m8neu)->count();

        $m8neg = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Negative"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m8d1, $m8d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m8negCount = collect($m8neg)->count();

        $m9pos = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Positive"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m9d1, $m9d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m9posCount = collect($m9pos)->count();

        $m9neu = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Neutral"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m9d1, $m9d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m9neuCount = collect($m9neu)->count();

        $m9neg = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Negative"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m9d1, $m9d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m9negCount = collect($m9neg)->count();

        $m10pos = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Positive"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m10d1, $m10d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m10posCount = collect($m10pos)->count();

        $m10neu = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Neutral"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m10d1, $m10d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m10neuCount = collect($m10neu)->count();

        $m10neg = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Negative"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m10d1, $m10d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m10negCount = collect($m10neg)->count();

        $m11pos = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Positive"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m11d1, $m11d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m11posCount = collect($m11pos)->count();

        $m11neu = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Neutral"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m11d1, $m11d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m11neuCount = collect($m11neu)->count();

        $m11neg = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Negative"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$m11d1, $m11d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m11negCount = collect($m11neg)->count();
        
        $output = [
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
            "m4" => $m4,
            "m4posCount" => $m4posCount,
            "m4neuCount" => $m4neuCount,
            "m4negCount" => $m4negCount,
            "m5" => $m5,
            "m5posCount" => $m5posCount,
            "m5neuCount" => $m5neuCount,
            "m5negCount" => $m5negCount,
            "m6" => $m6,
            "m6posCount" => $m6posCount,
            "m6neuCount" => $m6neuCount,
            "m6negCount" => $m6negCount,
            "m7" => $m7,
            "m7posCount" => $m7posCount,
            "m7neuCount" => $m7neuCount,
            "m7negCount" => $m7negCount,
            "m8" => $m8,
            "m8posCount" => $m8posCount,
            "m8neuCount" => $m8neuCount,
            "m8negCount" => $m8negCount,
            "m9" => $m9,
            "m9posCount" => $m9posCount,
            "m9neuCount" => $m9neuCount,
            "m9negCount" => $m9negCount,
            "m10" => $m10,
            "m10posCount" => $m10posCount,
            "m10neuCount" => $m10neuCount,
            "m10negCount" => $m10negCount,
            "m11" => $m11,
            "m11posCount" => $m11posCount,
            "m11neuCount" => $m11neuCount,
            "m11negCount" => $m11negCount
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
