<?php

namespace App\Http\Controllers;

use App\Models\GetGBChartData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use PDO;
use Illuminate\Support\Collection;

class GetGBChartDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($date1, $date2)
    {
        $m0pos = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Positive"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$date1, $date2])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m0posCount = collect($m0pos)->count();

        $m0neu = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Neutral"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$date1, $date2])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m0neuCount = collect($m0neu)->count();

        $m0neg = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select('nlp_analysis.SA_Class')
        ->whereIn('nlp_analysis.SA_Class', ["Negative"])
        ->whereBetween('dcard_rawdata.CreatedAt', [$date1, $date2])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();
        $m0negCount = collect($m0neg)->count();

        $output[] = [
            "m0posCount" => $m0posCount,
            "m0neuCount" => $m0neuCount,
            "m0negCount" => $m0negCount,
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
     * @param  \App\Models\GetGBChartData  $getGBChartData
     * @return \Illuminate\Http\Response
     */
    public function show(GetGBChartData $getGBChartData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GetGBChartData  $getGBChartData
     * @return \Illuminate\Http\Response
     */
    public function edit(GetGBChartData $getGBChartData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GetGBChartData  $getGBChartData
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GetGBChartData $getGBChartData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GetGBChartData  $getGBChartData
     * @return \Illuminate\Http\Response
     */
    public function destroy(GetGBChartData $getGBChartData)
    {
        //
    }
}
