<?php

namespace App\Http\Controllers;

use App\Models\GetArticleId;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class GetArticleIdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $dcardAll = DB::table('dcard_rawdata')
        ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
        ->leftJoin('comparison', 'comparison.Id', '=', 'nlp_analysis.Id')
        ->select('dcard_rawdata.Id', 'dcard_rawdata.Title', 'dcard_rawdata.CreatedAt', 'dcard_rawdata.Content'
        , 'nlp_analysis.SA_Score', 'nlp_analysis.SA_Class', 'comparison.Level', 'comparison.KeywordLevel1', 
        'comparison.KeywordLevel2', 'comparison.KeywordLevel3')
        ->whereIn('dcard_rawdata.Id', [$id])
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
     * @param  \App\Models\GetArticleId  $getArticleId
     * @return \Illuminate\Http\Response
     */
    public function show(GetArticleId $getArticleId)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GetArticleId  $getArticleId
     * @return \Illuminate\Http\Response
     */
    public function edit(GetArticleId $getArticleId)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GetArticleId  $getArticleId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GetArticleId $getArticleId)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GetArticleId  $getArticleId
     * @return \Illuminate\Http\Response
     */
    public function destroy(GetArticleId $getArticleId)
    {
        //
    }
}