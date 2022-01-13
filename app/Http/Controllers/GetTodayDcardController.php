<?php

namespace App\Http\Controllers;

use App\Models\GetTodayDcard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use mysql_xdevapi\Exception;

class GetTodayDcardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
//            $today = date("Y-m-d");
            $today = "2021-11-09";
            $dcardAll = DB::table('dcard_rawdata')
                ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
                ->leftJoin('comparison', 'comparison.Id', '=', 'nlp_analysis.Id')
                ->select('dcard_rawdata.Id', 'dcard_rawdata.Title', 'dcard_rawdata.CreatedAt', 'dcard_rawdata.Content'
                    , 'nlp_analysis.SA_Score', 'nlp_analysis.SA_Class', 'comparison.Level', 'comparison.KeywordLevel1',
                    'comparison.KeywordLevel2', 'comparison.KeywordLevel3')
                ->whereDate('dcard_rawdata.CreatedAt', $today)
                ->orderByDesc('dcard_rawdata.Id')
                ->get();
        } catch (Exception $e) {
            $error['message'] = '404 Not Found!!';
            return response()->json($error, 404);
        } finally {
            if (!$dcardAll->isEmpty()){
                return response()->json($dcardAll, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                    JSON_UNESCAPED_UNICODE);
            } else {
                $error['message'] = '404 Not Found!!';
                return response()->json($error, 404);
            }
        }
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
     * @param  \App\Models\GetTodayDcard  $getTodayDcard
     * @return \Illuminate\Http\Response
     */
    public function show(GetTodayDcard $getTodayDcard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GetTodayDcard  $getTodayDcard
     * @return \Illuminate\Http\Response
     */
    public function edit(GetTodayDcard $getTodayDcard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GetTodayDcard  $getTodayDcard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GetTodayDcard $getTodayDcard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GetTodayDcard  $getTodayDcard
     * @return \Illuminate\Http\Response
     */
    public function destroy(GetTodayDcard $getTodayDcard)
    {
        //
    }
}
