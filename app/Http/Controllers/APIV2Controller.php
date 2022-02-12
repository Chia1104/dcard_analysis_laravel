<?php

namespace App\Http\Controllers;

use App\Models\Dcard;
use App\Models\DcardRawData;
use App\Models\Nlp;
use App\Models\Comparison;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
            $limit = $request -> limit == null ? 10 : $request -> limit;
            if ($limit <= 0) {
                $limit = 1;
            }

            $dcards = DcardRawData::with(['nlp','comparison'])
                ->main()
                ->orderByDesc('Id')
                ->limit($limit)
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
     * @param Request $request
     * @return JsonResponse
     */

    public function beforeId(Request $request): JsonResponse {

        try {
            $limit = $request -> limit == null ? 10 : $request -> limit;
            $beforeId = $request -> beforeId;
            if ($limit <= 0) {
                $limit = 1;
            } elseif ($beforeId == null) {
                $error['message'] = '404 Not Found';
                return response()->json($error, 404);
            }

            $dcards = DcardRawData::with(['nlp','comparison'])
                ->main()
                ->orderByDesc('Id')
                ->where('Id', '<', $beforeId)
                ->limit($limit)
                ->get();
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
            $search = $request -> search;
            if($request->has('search')){
                $dcards = DcardRawData::search($search)
                    ->get();

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
            $dcards = DcardRawData::with(['nlp','comparison'])
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
            $dcards = DcardRawData::with(['nlp','comparison'])
                ->main()
                ->whereBetween('CreatedAt', [$date1, $date2])
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
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getDateDcards(Request $request): JsonResponse
    {
        $type = $request -> type == null ? 'today' : $request -> type;

        try {
            switch ($type) {
                case 'today':
//                $today = date("Y-m-d");
                    $today = "2021-11-09";
                    $dcards = DcardRawData::with(['nlp','comparison'])
                        ->main()
                        ->whereDate('CreatedAt', $today)
                        ->get();
                    if ($dcards->isEmpty()) {
                        $error['message'] = '404 Not Found';
                        return response()->json($error, 404);
                    }

                    return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                        JSON_UNESCAPED_UNICODE);
                case 'week':
//                $day = date('w');
//                $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
//                $week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
                    $week_start = "2021-11-07";
                    $week_end = "2021-11-13";
                    $dcards = DcardRawData::with(['nlp','comparison'])
                        ->main()
                        ->whereBetween('CreatedAt', [$week_start, $week_end])
                        ->get();
                    if ($dcards->isEmpty()) {
                        $error['message'] = '404 Not Found';
                        return response()->json($error, 404);
                    }

                    return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                        JSON_UNESCAPED_UNICODE);
                case 'month':
//                $m0d1 = date("Y-m-d", strtotime("first day of 0 month"));
//                $m0d31 = date("Y-m-d", strtotime("last day of 0 month"));
                    $m0d1 = "2021-11-01";
                    $m0d31 = "2021-11-30";
                    $dcards = DcardRawData::with(['nlp','comparison'])
                        ->main()
                        ->whereBetween('CreatedAt', [$m0d1, $m0d31])
                        ->get();
                    if ($dcards->isEmpty()) {
                        $error['message'] = '404 Not Found';
                        return response()->json($error, 404);
                    }

                    return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
                        JSON_UNESCAPED_UNICODE);

                default:
                    $dcards = DcardRawData::with(['nlp','comparison'])
                        ->main()
                        ->whereDate('CreatedAt', $type)
                        ->get();
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
}
