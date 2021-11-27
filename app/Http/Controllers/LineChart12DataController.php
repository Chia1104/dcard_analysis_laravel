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
        $m0d31 = date("Y-m-d", strtotime("last day of 0 month"));
        $m11d1 = date("Y-m-d", strtotime("first day of -11 month"));
        $m0 = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->select(DB::raw('avg(nlp_analysis.SA_Score) as avgScore'), DB::raw("DATE_FORMAT(dcard_rawdata.CreatedAt, '%Y-%m') as newDate"))
        ->groupBy('newDate')
        ->orderByDesc('newDate')
        ->whereBetween('dcard_rawdata.CreatedAt', [$m11d1, $m0d31])
        ->get();
        return response()->json($m0, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
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
