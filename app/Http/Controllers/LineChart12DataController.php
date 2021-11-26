<?php

namespace App\Http\Controllers;

use App\Models\LineChart12Data;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use PDO;
use Illuminate\Support\Collection;

class LineChart12DataController extends Controller
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

        $m0score = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Score')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m0d1, $m0d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->avg('nlp_analysis.SA_Score');
        $m0score = round($m0score, 2);
        $m1score = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Score')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m1d1, $m1d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->avg('nlp_analysis.SA_Score');
        $m1score = round($m1score, 2);
        $m2score = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Score')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m2d1, $m2d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->avg('nlp_analysis.SA_Score');
        $m2score = round($m2score, 2);
        $m3score = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Score')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m3d1, $m3d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->avg('nlp_analysis.SA_Score');
        $m3score = round($m3score, 2);
        $m4score = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Score')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m4d1, $m4d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->avg('nlp_analysis.SA_Score');
        $m4score = round($m4score, 2);
        $m5score = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Score')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m5d1, $m5d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->avg('nlp_analysis.SA_Score');
        $m5score = round($m5score, 2);
        $m6score = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Score')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m6d1, $m6d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->avg('nlp_analysis.SA_Score');
        $m6score = round($m6score, 2);
        $m7score = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Score')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m7d1, $m7d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->avg('nlp_analysis.SA_Score');
        $m7score = round($m7score, 2);
        $m8score = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Score')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m8d1, $m8d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->avg('nlp_analysis.SA_Score');
        $m8score = round($m8score, 2);
        $m9score = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Score')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m9d1, $m9d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->avg('nlp_analysis.SA_Score');
        $m9score = round($m9score, 2);
        $m10score = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Score')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m10d1, $m10d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->avg('nlp_analysis.SA_Score');
        $m10score = round($m10score, 2);
        $m11score = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Score')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m11d1, $m11d31])
        ->orderByDesc('dcard_rawdata.Id')
        ->avg('nlp_analysis.SA_Score');
        $m11score = round($m11score, 2);
        $output[] = [
            "m0" => $m0,
            "m0score" => $m0score,
            "m1" => $m1,
            "m1score" => $m1score,
            "m2" => $m2,
            "m2score" => $m2score,
            "m3" => $m3,
            "m3score" => $m3score,
            "m4" => $m4,
            "m4score" => $m4score,
            "m5" => $m5,
            "m5score" => $m5score,
            "m6" => $m6,
            "m6score" => $m6score,
            "m7" => $m7,
            "m7score" => $m7score,
            "m8" => $m8,
            "m8score" => $m8score,
            "m9" => $m9,
            "m9score" => $m9score,
            "m10" => $m10,
            "m10score" => $m10score,
            "m11" => $m11,
            "m11score" => $m11score,
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
     * @param  \App\Models\LineChart12Data  $lineChart12Data
     * @return \Illuminate\Http\Response
     */
    public function show(LineChart12Data $lineChart12Data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LineChart12Data  $lineChart12Data
     * @return \Illuminate\Http\Response
     */
    public function edit(LineChart12Data $lineChart12Data)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LineChart12Data  $lineChart12Data
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LineChart12Data $lineChart12Data)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LineChart12Data  $lineChart12Data
     * @return \Illuminate\Http\Response
     */
    public function destroy(LineChart12Data $lineChart12Data)
    {
        //
    }
}
