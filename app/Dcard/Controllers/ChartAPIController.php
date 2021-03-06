<?php

namespace App\Dcard\Controllers;

use App\Dcard\Services\NlpService;
use App\Http\Controllers\APIController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChartAPIController extends APIController
{
    private NlpService $_nlpService;

    public function __construct(NlpService $nlpService)
    {
        $this->middleware('auth:api');
        $this->_nlpService = $nlpService;
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @param Request $request
     * @return JsonResponse
     * @OA\Get(
     *      path="/api/v2/totalSAClass",
     *      operationId="totalSaClass",
     *      tags={"Chart"},
     *      summary="Get Total SA_Class",
     *      description="Get Total SA_Class, between start and end date",
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
            $date1 = $request->date1;
            $date2 = $request->date2;
            $totalSAClass = $this->_nlpService->getTotalSAClass($date1, $date2);

            return response()->json($totalSAClass, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
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
     * @OA\Get(
     *      path="/api/v2/avgSAScore",
     *      operationId="avgSAScore",
     *      tags={"Chart"},
     *      summary="Get Avg SA_Score",
     *      description="Get Avg SA_Score, between start and end date in three categories(date , week, month)",
     *      security={
     *         {
     *              "Authorization": {}
     *         }
     *      },
     *     @OA\Parameter(
     *          name="type",
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
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
    public function getAvgSAScore(Request $request): JsonResponse
    {
        try {
            $type = $request->type;
            $date1 = $request->date1;
            $date2 = $request->date2;
            $avgSAScore = $this->_nlpService->getAvgSAScore($type, $date1, $date2);

            return response()->json($avgSAScore, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
        } catch (\Exception $e) {
            $error['message'] = '404 Not Found';

            return response()->json($error, 404);
        }
    }
}
