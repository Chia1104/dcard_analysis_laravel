<?php

namespace App\Http\Controllers;

use App\Models\GetDateDcard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class GetDateDcardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($date1, $date2)
    {
        $dcardAll = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->leftJoin('comparison', 'comparison.Id', '=', 'nlp_analysis.Id')
        ->select('dcard_rawdata.Id', 'dcard_rawdata.Title', 'dcard_rawdata.CreatedAt', 'dcard_rawdata.Content'
        , 'nlp_analysis.SA_Score', 'nlp_analysis.SA_Class', 'comparison.Level', 'comparison.KeywordLevel1', 
        'comparison.KeywordLevel2', 'comparison.KeywordLevel3')
        ->whereBetween('dcard_rawdata.CreatedAt', [$date1, $date2])
        ->orderByDesc('dcard_rawdata.Id')
        ->get();

        return response()->json($dcardAll, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
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
     * @param  \App\Models\GetDateDcard  $getDateDcard
     * @return \Illuminate\Http\Response
     */
    public function show(GetDateDcard $getDateDcard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GetDateDcard  $getDateDcard
     * @return \Illuminate\Http\Response
     */
    public function edit(GetDateDcard $getDateDcard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GetDateDcard  $getDateDcard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GetDateDcard $getDateDcard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GetDateDcard  $getDateDcard
     * @return \Illuminate\Http\Response
     */
    public function destroy(GetDateDcard $getDateDcard)
    {
        //
    }
}
