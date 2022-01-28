<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getDcard(Request $request): JsonResponse
    {
        $limit = $request -> limit == null ? 10 : $request -> limit;
        try {
            $dcardAll = DB::table('dcard_rawdata')
                ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
                ->leftJoin('comparison', 'comparison.Id', '=', 'nlp_analysis.Id')
                ->select('dcard_rawdata.Id', 'dcard_rawdata.Title', 'dcard_rawdata.CreatedAt', 'dcard_rawdata.Content'
                    , 'nlp_analysis.SA_Score', 'nlp_analysis.SA_Class', 'comparison.Level', 'comparison.KeywordLevel1',
                    'comparison.KeywordLevel2', 'comparison.KeywordLevel3')
                ->orderByDesc('dcard_rawdata.Id')
                ->limit($limit)
                ->get();
        } catch (Exception $e) {
            $error['message'] = '404 Not Found!!' . $e;
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
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function beforeId(Request $request): JsonResponse {
        $limit = $request -> limit == null ? 10 : $request -> limit;
        $beforeId = $request -> beforeId == null ? 237415791 : $request -> beforeId;
        try {
            $dcardAll = DB::table('dcard_rawdata')
                ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
                ->leftJoin('comparison', 'comparison.Id', '=', 'nlp_analysis.Id')
                ->select('dcard_rawdata.Id', 'dcard_rawdata.Title', 'dcard_rawdata.CreatedAt', 'dcard_rawdata.Content'
                    , 'nlp_analysis.SA_Score', 'nlp_analysis.SA_Class', 'comparison.Level', 'comparison.KeywordLevel1',
                    'comparison.KeywordLevel2', 'comparison.KeywordLevel3')
                ->orderByDesc('dcard_rawdata.Id')
                ->where('dcard_rawdata.Id', '<', $beforeId)
                ->limit($limit)
                ->get();
        } catch (Exception $e) {
            $error['message'] = '404 Not Found!!' . $e;
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
     * Display a listing of the resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function getArticle($id): JsonResponse
    {
        try {
            $dcardAll = DB::table('dcard_rawdata')
                ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
                ->leftJoin('comparison', 'comparison.Id', '=', 'nlp_analysis.Id')
                ->select('dcard_rawdata.Id', 'dcard_rawdata.Title', 'dcard_rawdata.CreatedAt', 'dcard_rawdata.Content'
                    , 'nlp_analysis.SA_Score', 'nlp_analysis.SA_Class', 'comparison.Level', 'comparison.KeywordLevel1',
                    'comparison.KeywordLevel2', 'comparison.KeywordLevel3')
                ->whereIn('dcard_rawdata.Id', [$id])
                ->get();
        } catch (Exception $e) {
            $error['message'] = '404 Not Found!!' . $e;
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
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function searchContent(Request $request): JsonResponse {
        $content = $request -> search;

        if ($request -> search == null) {
            $error['message'] = '404 Not Found!!';
            return response()->json($error, 404);
        } else {
            try {
                $dcardAll = DB::table('dcard_rawdata')
                    ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
                    ->leftJoin('comparison', 'comparison.Id', '=', 'nlp_analysis.Id')
                    ->select('dcard_rawdata.Id', 'dcard_rawdata.Title', 'dcard_rawdata.CreatedAt', 'dcard_rawdata.Content'
                        , 'nlp_analysis.SA_Score', 'nlp_analysis.SA_Class', 'comparison.Level', 'comparison.KeywordLevel1',
                        'comparison.KeywordLevel2', 'comparison.KeywordLevel3')
                    ->orderByDesc('dcard_rawdata.Id')
                    ->where('dcard_rawdata.Content', 'LIKE', "%{$content}%")
                    ->orWhere('dcard_rawdata.Title', 'LIKE', "%{$content}%")
                    ->get();
            } catch (Exception $e) {
                $error['message'] = '404 Not Found!!' . $e;
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
    }

    /**
     * Display a listing of the resource.
     *
     * @param $date1
     * @param $date2
     * @return JsonResponse
     */
    public function getDateBetween($date1, $date2): JsonResponse
    {
        try {
            $dcardAll = DB::table('dcard_rawdata')
                ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
                ->leftJoin('comparison', 'comparison.Id', '=', 'nlp_analysis.Id')
                ->select('dcard_rawdata.Id', 'dcard_rawdata.Title', 'dcard_rawdata.CreatedAt', 'dcard_rawdata.Content'
                    , 'nlp_analysis.SA_Score', 'nlp_analysis.SA_Class', 'comparison.Level', 'comparison.KeywordLevel1',
                    'comparison.KeywordLevel2', 'comparison.KeywordLevel3')
                ->whereBetween('dcard_rawdata.CreatedAt', [$date1, $date2])
                ->orderByDesc('dcard_rawdata.Id')
                ->get();
        } catch (Exception $e) {
            $error['message'] = '404 Not Found!!' . $e;
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
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function getToday(): JsonResponse
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
            $error['message'] = '404 Not Found!!' . $e;
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
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function getWeek(): JsonResponse
    {
        try {
//            $day = date('w');
//            $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
//            $week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
            $week_start = "2021-11-07";
            $week_end = "2021-11-13";
            $dcardAll = DB::table('dcard_rawdata')
                ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
                ->leftJoin('comparison', 'comparison.Id', '=', 'nlp_analysis.Id')
                ->select('dcard_rawdata.Id', 'dcard_rawdata.Title', 'dcard_rawdata.CreatedAt', 'dcard_rawdata.Content'
                    , 'nlp_analysis.SA_Score', 'nlp_analysis.SA_Class', 'comparison.Level', 'comparison.KeywordLevel1',
                    'comparison.KeywordLevel2', 'comparison.KeywordLevel3')
                ->whereBetween('dcard_rawdata.CreatedAt', [$week_start, $week_end])
                ->orderByDesc('dcard_rawdata.Id')
                ->get();
        } catch (Exception $e) {
            $error['message'] = '404 Not Found!!' . $e;
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
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function getMonth(): JsonResponse
    {
        try {
//            $m0d1 = date("Y-m-d", strtotime("first day of 0 month"));
//            $m0d31 = date("Y-m-d", strtotime("last day of 0 month"));
            $m0d1 = "2021-11-01";
            $m0d31 = "2021-11-30";
            $dcardAll = DB::table('dcard_rawdata')
                ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
                ->leftJoin('comparison', 'comparison.Id', '=', 'nlp_analysis.Id')
                ->select('dcard_rawdata.Id', 'dcard_rawdata.Title', 'dcard_rawdata.CreatedAt', 'dcard_rawdata.Content'
                    , 'nlp_analysis.SA_Score', 'nlp_analysis.SA_Class', 'comparison.Level', 'comparison.KeywordLevel1',
                    'comparison.KeywordLevel2', 'comparison.KeywordLevel3')
                ->whereBetween('dcard_rawdata.CreatedAt', [$m0d1, $m0d31])
                ->orderByDesc('dcard_rawdata.Id')
                ->get();
        } catch (Exception $e) {
            $error['message'] = '404 Not Found!!' . $e;
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
     * Display a listing of the resource.
     *
     * @param $date1
     * @param $date2
     * @return JsonResponse
     */
    public function getGBChartDateBetween($date1, $date2): JsonResponse
    {
        try {
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
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function getGBChart4Month(): JsonResponse
    {
        try {
//            $m0d31 = date("Y-m-d", strtotime("last day of 0 month"));
//            $m3d1 = date("Y-m-d", strtotime("first day of -3 month"));
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
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function getGBChart12Month(): JsonResponse
    {
        try {
//            $m0d31 = date("Y-m-d", strtotime("last day of 0 month"));
//            $m11d1 = date("Y-m-d", strtotime("first day of -11 month"));
            $m0d31 = "2021-11-30";
            $m11d1 = "2020-12-01";
            $posCount = DB::table('dcard_rawdata')
                ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
                ->select(DB::raw('count(nlp_analysis.SA_Class) as Count'), DB::raw("DATE_FORMAT(dcard_rawdata.CreatedAt, '%Y-%m') as newDate"))
                ->where('nlp_analysis.SA_Class', 'Positive')
                ->groupBy('newDate')
                ->orderByDesc('newDate')
                ->whereBetween('dcard_rawdata.CreatedAt', [$m11d1, $m0d31])
                ->get();
            $posCount = collect($posCount);
            $neuCount = DB::table('dcard_rawdata')
                ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
                ->select(DB::raw('count(nlp_analysis.SA_Class) as Count'), DB::raw("DATE_FORMAT(dcard_rawdata.CreatedAt, '%Y-%m') as newDate"))
                ->where('nlp_analysis.SA_Class', 'Neutral')
                ->groupBy('newDate')
                ->orderByDesc('newDate')
                ->whereBetween('dcard_rawdata.CreatedAt', [$m11d1, $m0d31])
                ->get();
            $neuCount = collect($neuCount);
            $negCount = DB::table('dcard_rawdata')
                ->leftJoin('nlp_analysis', 'dcard_rawdata.Id', '=', 'nlp_analysis.Id')
                ->select(DB::raw('count(nlp_analysis.SA_Class) as Count'), DB::raw("DATE_FORMAT(dcard_rawdata.CreatedAt, '%Y-%m') as newDate"))
                ->where('nlp_analysis.SA_Class', 'Negative')
                ->groupBy('newDate')
                ->orderByDesc('newDate')
                ->whereBetween('dcard_rawdata.CreatedAt', [$m11d1, $m0d31])
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
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function getLineChart12Month(): JsonResponse
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
}
