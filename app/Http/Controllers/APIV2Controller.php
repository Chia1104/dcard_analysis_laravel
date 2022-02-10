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
    public function testData(Request $request): JsonResponse
    {
        $limit = $request -> limit == null ? 10 : $request -> limit;
        $dcards = Dcard::find(228746468)->comparison
//            ->limit($limit)
//            ->orderByDesc('Id')
            ->get();
        return response()->json($dcards, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);

    }
}
