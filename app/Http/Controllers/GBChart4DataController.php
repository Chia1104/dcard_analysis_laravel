<?php

namespace App\Http\Controllers;

use App\Models\GBChart4Data;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class GBChart4DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
//            $m0d31 = date("Y-m-d", strtotime("last day of 0 month"));
            $m3d1 = date("Y-m-d", strtotime("first day of -3 month"));
            $m0d31 = "2021-11-30";
            $m3d1 = "2021-08-01";
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
        } catch (Exception $e) {
            $error['message'] = '404 Not Found!!' . $e;
            return response()->json($error, 404);
        } finally {
            if (!$merged->isEmpty()){
                return response()->json($merged, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
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
