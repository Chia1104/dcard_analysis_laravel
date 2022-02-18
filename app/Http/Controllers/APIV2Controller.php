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
            $error['message'] = '404 Not Found ' . $e;
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
            $dcards = Dcard::with(['nlp', 'comparison'])
                ->main()
                ->whereBetween('CreatedAt', array(
                    Carbon::createFromDate(Carbon::createFromFormat('Y-m-d', $date1)->year, Carbon::createFromFormat('Y-m-d', $date1)->month, Carbon::createFromFormat('Y-m-d', $date1)->day),
                    Carbon::createFromDate(Carbon::createFromFormat('Y-m-d', $date2)->year, Carbon::createFromFormat('Y-m-d', $date2)->month, Carbon::createFromFormat('Y-m-d', $date2)->day)
                ))
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
            switch ($type) {
                case 'today':
                    $dcards = Dcard::with(['nlp', 'comparison'])
                        ->main()
                        ->whereBetween('CreatedAt', array(
                            Carbon::createFromDate(2021, 11, 9),
                            Carbon::createFromDate(2021, 11, 10)
                        ))
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
                        ->whereBetween('CreatedAt', array(
                            Carbon::createFromDate(2021, 11, 7),
                            Carbon::createFromDate(2021, 11, 13)
                        ))
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
                        ->whereBetween('CreatedAt', array(
                            Carbon::createFromDate(2021, 11, 1),
                            Carbon::createFromDate(2021, 11, 30)
                        ))
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
                        ->whereDate('CreatedAt', array(
                            Carbon::createFromDate(2021, 11, 8),
                            Carbon::createFromDate(2021, 11, 9)
                        ))
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
            $saclass = array(0 => 'Positive', 1 => 'Neutral', 2 => 'Negative');
            $pdatas = array();

            for ($i = 0; $i < count($saclass); $i++) {
                $count = Nlp::main()
                    ->where('SA_Class', $saclass[$i])
                    ->whereBetween('CreatedAt', array(
                        Carbon::createFromDate(Carbon::createFromFormat('Y-m-d', $date1)->year, Carbon::createFromFormat('Y-m-d', $date1)->month, Carbon::createFromFormat('Y-m-d', $date1)->day),
                        Carbon::createFromDate(Carbon::createFromFormat('Y-m-d', $date2)->year, Carbon::createFromFormat('Y-m-d', $date2)->month, Carbon::createFromFormat('Y-m-d', $date2)->day)
                    ))
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

            $avg = Nlp::raw(function($collection)
                {
                    return $collection->aggregate([
                        [
                            '$project' => [
                                'formattedDate' => [
                                    '$dateToString' => [
                                        'format' => '%Y-%m',
                                        'date' => '$CreatedAt'
                                    ]
                                ],
                            ]
                        ],
                        [
                            '$match' => [
                                'formattedDate' => ['$gte' => '2020-12', '$lte' => '2021-11'],
                            ]
                        ],
                        [
                            '$group' => [
                                '_id' => '$formattedDate',
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
