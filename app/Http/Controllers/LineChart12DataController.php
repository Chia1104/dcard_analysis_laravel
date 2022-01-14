<?php

namespace App\Http\Controllers;

use App\Models\LineChart12Data;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class LineChart12DataController extends Controller
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
//            $m11d1 = date("Y-m-d", strtotime("first day of -11 month"));
            $m0d31 = "2021-11-30";
            $m11d1 = "2020-12-01";
            $lineChartData = DB::table('dcard_rawdata')
                ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
                ->select(DB::raw('avg(nlp_analysis.SA_Score) as avgScore'), DB::raw("DATE_FORMAT(dcard_rawdata.CreatedAt, '%Y-%m') as newDate"))
                ->groupBy('newDate')
                ->orderByDesc('newDate')
                ->whereBetween('dcard_rawdata.CreatedAt', [$m11d1, $m0d31])
                ->get();
        } catch (Exception $e) {
            $error['message'] = '404 Not Found!!' . $e;
            return response()->json($error, 404);
        } finally {
            if (!$lineChartData->isEmpty()){
                return response()->json($lineChartData, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
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
