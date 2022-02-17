<?php

namespace App\Http\Controllers;

use App\Models\Dcard;
use App\Models\Nlp;
use App\Models\Comparison;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class APIV2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getDcards(Request $request): JsonResponse
    {
        try {

            $dcards = Dcard::with(['nlp', 'comparison'])
                ->main()
                ->paginate(30);

            return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            $error['message'] = '404 Not Found';
            return response()->json($error, 404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function searchDcards(Request $request): JsonResponse
    {
        try {
            if($request->has('search')){
                $search = $request -> search;
                $dcards = Dcard::search($search)
                    ->paginate(30);

                if ($dcards->isEmpty()) {
                    $error['message'] = '404 Not Found';
                    return response()->json($error, 404);
                }

                return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                    JSON_UNESCAPED_UNICODE);
            }else{
                $error['message'] = '404 Not Found';
                return response()->json($error, 404);
            }
        } catch (\Exception $e) {
            $error['message'] = '404 Not Found';
            return response()->json($error, 404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @param $id
     * @return JsonResponse
     */
    public function getDcardById($id): JsonResponse
    {
        try {
            $dcards = Dcard::with(['nlp', 'comparison'])
                ->main()
                ->whereIn('Id', [$id])
                ->get();

            if ($dcards->isEmpty()) {
                $error['message'] = '404 Not Found';
                return response()->json($error, 404);
            }

            return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            $error['message'] = '404 Not Found';
            return response()->json($error, 404);
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
            $date2 = $date2 . 'T23:59:59';
            $dcards = Dcard::with(['nlp', 'comparison'])
                ->main()
                ->whereBetween('CreatedAt', [$date1, $date2])
                ->paginate(30);

            if ($dcards->isEmpty()) {
                $error['message'] = '404 Not Found';
                return response()->json($error, 404);
            }

            return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            $error['message'] = '404 Not Found';
            return response()->json($error, 404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @param $type
     * @return JsonResponse
     */
    public function getDateDcards($type): JsonResponse
    {

        try {
//            $today = Carbon::now();
//            $tomorrow = Carbon::now()->addDay();
            $today = "2021-11-09";
            $tomorrow = "2021-11-10";
//            $day = date('w');
//            $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
//            $week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
            $week_start = "2021-11-07";
            $week_end = "2021-11-14";
//            $m0d1 = date("Y-m-d", strtotime("first day of 0 month"));
//            $m0d31 = date("Y-m-d", strtotime("last day of 0 month"));
            $m0d1 = "2021-11-01";
            $m0d31 = "2021-12-01";
            switch ($type) {
                case 'today':
                    $dcards = Dcard::with(['nlp', 'comparison'])
                        ->main()
                        ->whereBetween('CreatedAt', [$today, $tomorrow])
                        ->paginate(30);
                    if ($dcards->isEmpty()) {
                        $error['message'] = '404 Not Found';
                        return response()->json($error, 404);
                    }

                    return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                        JSON_UNESCAPED_UNICODE);
                case 'week':
                    $dcards = Dcard::with(['nlp', 'comparison'])
                        ->main()
                        ->whereBetween('CreatedAt', [$week_start, $week_end])
                        ->paginate(30);
                    if ($dcards->isEmpty()) {
                        $error['message'] = '404 Not Found';
                        return response()->json($error, 404);
                    }

                    return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                        JSON_UNESCAPED_UNICODE);
                case 'month':
                    $dcards = Dcard::with(['nlp', 'comparison'])
                        ->main()
                        ->whereBetween('CreatedAt', [$m0d1, $m0d31])
                        ->paginate(30);
                    if ($dcards->isEmpty()) {
                        $error['message'] = '404 Not Found';
                        return response()->json($error, 404);
                    }

                    return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                        JSON_UNESCAPED_UNICODE);

                default:
                    $dcards = Dcard::with(['nlp', 'comparison'])
                        ->main()
                        ->whereDate('CreatedAt', [$today, $tomorrow])
                        ->paginate(30);
                    if ($dcards->isEmpty()) {
                        $error['message'] = '404 Not Found';
                        return response()->json($error, 404);
                    }

                    return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                        JSON_UNESCAPED_UNICODE);
            }

        } catch (\Exception $e) {
            $error['message'] = '404 Not Found';
            return response()->json($error, 404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getTotalSAClass(Request $request): JsonResponse
    {
        try {
            $date1 = $request -> date1;
            $date2 = $request -> date2;
            $date2 = $date2 . 'T23:59:59';
            $saclass = array(0 => 'Positive', 1 => 'Neutral', 2 => 'Negative');
            $pdatas = array();

            for ($i = 0; $i < count($saclass); $i++) {
                $count = Nlp::main()
                    ->where('SA_Class', $saclass[$i])
                    ->whereBetween('CreatedAt', [$date1, $date2])
                    ->count();
                $pdatas[] = array($saclass[$i] => $count);
            }

            $result['total'] = $pdatas;

            return response()->json($result, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            $error['message'] = '404 Not Found';
            return response()->json($error, 404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getAvgSAScore(Request $request): JsonResponse
    {
        try {
            $date1 = $request -> date1;
            $date2 = $request -> date2;
            $date2 = $date2 . 'T23:59:59';

//            $avg = Nlp::main()
//                ->whereBetween('CreatedAt', [$date1, $date2])
//                ->avg('SA_Score');

            $avg = Nlp::raw(function($collection)
            {
                return $collection->aggregate([
                    [
                        '$match' => [
                            'CreatedAt' => ['$gt' => '2020-12', '$lte' => '2021-11T23:59:59'],
                        ]
                    ],
                    [
                        '$project' => [
                            'datetime' => [
                                '$substr' => [
                                    '$CreatedAt', 0, 7
                                ]
//                                '$dateFromString' => [
//                                    'dateString' => '$CreatedAt',
//                                ]
                            ],
                        ]
                    ],
                    [
                        '$group' => [
                            '_id' => '$datetime',
                            'avg_score' => [
                                '$avg' => '$SA_Score',
                            ],
                        ]
                    ],
                    [
                        '$sort' => [
                            '_id' => -1
                        ],
                    ],
                ]);
            });

            $result['avg'] = $avg;
            return response()->json($result, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                JSON_UNESCAPED_UNICODE);
        } catch (\Exception $e) {
            $error['message'] = '404 Not Found ' . $e;
            return response()->json($error, 404);
        }
    }
}
