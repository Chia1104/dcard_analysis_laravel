<?php

namespace App\Dcard\Controllers;

use App\Http\Controllers\APIController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Dcard\Services\DcardService;

class DcardAPIController extends APIController
{
    private DcardService $_dcardService;

    public function __construct(DcardService $dcardService)
    {
        $this->middleware('auth:api');
        $this->_dcardService = $dcardService;
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @return JsonResponse
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
    public function getDcards(): JsonResponse
    {
        try {

            $dcards = $this->_dcardService->getAllDcards()
                ->paginate(30);

            return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
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
                $dcards = $this->_dcardService->searchDcards($search)
                    ->paginate(30);

                if ($dcards->isEmpty()) {
                    $error['message'] = '404 Not Found';
                    return response()->json($error, 404);
                }

                return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
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
            $dcards = $this->_dcardService->getDcardById($id)
                ->get();
            if ($dcards->isEmpty()) {
                $error['message'] = '404 Not Found';
                return response()->json($error, 404);
            }
            return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
        } catch (\Exception $e) {
            $error['message'] = '404 Not Found ' . $e;
            return response()->json($error, 404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @param $date1
     * @param $date2
     * @return JsonResponse
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
            $dcards = $this->_dcardService->getDateBetween($date1, $date2)
                ->paginate(30);
            if ($dcards->isEmpty()) {
                $error['message'] = '404 Not Found';
                return response()->json($error, 404);
            }
            return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
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
     *          name="type(today, week, month)",
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
            $dcards = $this->_dcardService->getDateDcards($type)
                ->paginate(30);
            if ($dcards->isEmpty()) {
                $error['message'] = '404 Not Found';
                return response()->json($error, 404);
            }
            return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
        } catch (\Exception $e) {
            $error['message'] = '404 Not Found';
            return response()->json($error, 404);
        }
    }

    /**
     * Display a listing of the resource.
     *
     *
     * @param $date1
     * @param $date2
     * @return JsonResponse
     * @OA\Get(
     *      path="/api/v2/maxScore/{date1}/{date2}",
     *      operationId="maxScore",
     *      tags={"Dcard"},
     *      summary="Get Max SA_Score",
     *      description="Get Max SA_Score",
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
    public function getMaxScoreDcard($date1, $date2): JsonResponse
    {
        try {
            $dcards = $this->_dcardService->getMaxScoreDcard($date1, $date2)->get();
            if ($dcards->isEmpty()) {
                $error['message'] = '404 Not Found';
                return response()->json($error, 404);
            }
            return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
        } catch (\Exception $e) {
            $error['message'] = '404 Not Found';
            return response()->json($error, 404);
        }
    }
}
