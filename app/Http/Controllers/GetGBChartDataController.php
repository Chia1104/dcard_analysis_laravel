<?php

namespace App\Http\Controllers;

use App\Models\GetGBChartData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use PDO;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class GetGBChartDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($date1, $date2)
    {
        $posCount = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select(DB::raw('count(nlp_analysis.SA_Class) as Count'), DB::raw("DATE_FORMAT(dcard_rawdata.CreatedAt, '%Y-%m') as newDate"))
        ->where('nlp_analysis.SA_Class', 'Positive')
        ->groupBy('newDate')
        ->orderByDesc('newDate')
        ->whereBetween('dcard_rawdata.CreatedAt', [$date1, $date2])
        ->get();
        $posCount = collect($posCount);
        $neuCount = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select(DB::raw('count(nlp_analysis.SA_Class) as Count'), DB::raw("DATE_FORMAT(dcard_rawdata.CreatedAt, '%Y-%m') as newDate"))
        ->where('nlp_analysis.SA_Class', 'Neutral')
        ->groupBy('newDate')
        ->orderByDesc('newDate')
        ->whereBetween('dcard_rawdata.CreatedAt', [$date1, $date2])
        ->get();
        $neuCount = collect($neuCount);
        $negCount = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select(DB::raw('count(nlp_analysis.SA_Class) as Count'), DB::raw("DATE_FORMAT(dcard_rawdata.CreatedAt, '%Y-%m') as newDate"))
        ->where('nlp_analysis.SA_Class', 'Negative')
        ->groupBy('newDate')
        ->orderByDesc('newDate')
        ->whereBetween('dcard_rawdata.CreatedAt', [$date1, $date2])
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
