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
    /**
     * @OA\Get(
     *      path="/api/v2/dcard",
     *      operationId="dcards",
     *      tags={"Dcard"},
     *      summary="Get All Dcards",
     *      description="Get All Dcards",
     *      security={
     *         {
     *              "Authorization": {}
     *         }
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated."
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     * )
     * Returns list of articles
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
    /**
     * @OA\Get(
     *      path="/api/v2/searchDcard",
     *      operationId="searchDcards",
     *      tags={"Dcard"},
     *      summary="Search Dcards",
     *      description="Search Dcards",
     *      security={
     *         {
     *              "Authorization": {}
     *         }
     *      },
     *      @OA\Parameter(
     *          name="search",
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated."
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     * )
     * Returns list of articles
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
    /**
     * @OA\Get(
     *      path="/api/v2/dcard/{id}",
     *      operationId="dcard",
     *      tags={"Dcard"},
     *      summary="Get Dcard",
     *      description="Get Dcard",
     *      security={
     *         {
     *              "Authorization": {}
     *         }
     *      },
     *     @OA\Parameter(
     *          name="id",
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated."
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     * )
     * Returns list of articles
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
    /**
     * @OA\Get(
     *      path="/api/v2/date/{date1}/{date2}",
     *      operationId="dateBetween",
     *      tags={"Dcard"},
     *      summary="Get Date Between Dcards",
     *      description="Get Date Between Dcards",
     *      security={
     *         {
     *              "Authorization": {}
     *         }
     *      },
     *     @OA\Parameter(
     *          name="date1",
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="date2",
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated."
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     * )
     * Returns list of articles
     */
    public function getDateBetween($date1, $date2): JsonResponse
    {
        try {
            $dcards = Dcard::with(['nlp', 'comparison'])
                ->main()
                ->whereBetween('CreatedAt', array(
                    Carbon::createFromFormat('Y-m-d', $date1),
                    Carbon::createFromFormat('Y-m-d', $date2)
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
    /**
     * @OA\Get(
     *      path="/api/v2/date/{type}",
     *      operationId="date",
     *      tags={"Dcard"},
     *      summary="Get Date Dcards",
     *      description="Get Date Dcards",
     *      security={
     *         {
     *              "Authorization": {}
     *         }
     *      },
     *     @OA\Parameter(
     *          name="type",
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated."
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     * )
     * Returns list of articles
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
    /**
     * @OA\Get(
     *      path="/api/v2/totalSAClass",
     *      operationId="totalSaClass",
     *      tags={"Chart"},
     *      summary="Get Total SA_Class",
     *      description="Get Total SA_Class",
     *      security={
     *         {
     *              "Authorization": {}
     *         }
     *      },
     *     @OA\Parameter(
     *          name="date1",
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="date2",
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated."
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     * )
     * Returns list of articles
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
                        Carbon::createFromFormat('Y-m-d', $date1),
                        Carbon::createFromFormat('Y-m-d', $date2)
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
    /**
     * @OA\Get(
     *      path="/api/v2/avgSAScore",
     *      operationId="avgSAScore",
     *      tags={"Chart"},
     *      summary="Get Avg SA_Score",
     *      description="Get Avg SA_Score",
     *      security={
     *         {
     *              "Authorization": {}
     *         }
     *      },
     *      @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated."
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="not found"
     *      ),
     * )
     * Returns list of articles
     */
    public function getAvgSAScore(Request $request): JsonResponse
    {
        try {

            $avg = Nlp::raw(function($collection)
                {
                    return $collection->aggregate([
//                        [
//                            '$match' => [
//                                'CreatedAt' => [
//                                    '$gte' => Carbon::createFromFormat('Y-m', '2020-12'),
//                                    '$lte' => Carbon::createFromFormat('Y-m', '2021-11'),
//                                ]
//                            ]
//                        ],
                        [
                            '$group' => [
                                '_id' => [
                                    '$dateToString' => [
                                        'format' => '%Y-%m',
                                        'date' => '$CreatedAt'
                                    ]
                                ],
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
