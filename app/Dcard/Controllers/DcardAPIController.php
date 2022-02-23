<?php

namespace App\Dcard\Controllers;

use App\Http\Controllers\APIController;
use App\Dcard\Models\Dcard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Dcard\Services\DcardService;

class DcardAPIController extends APIController
{
    private DcardService $dcardService;

    public function __construct(DcardService $dcardService)
    {
        $this->middleware('auth:api');
        $this->dcardService = $dcardService;
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

            $dcards = $this->dcardService->getDcard()
                ->paginate(30);

            return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8']);
        } catch (\Exception $e) {
            $error['message'] = '404 Not Found';
            return response()->json($error, 404);
        }
    }
}
