<?php

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
