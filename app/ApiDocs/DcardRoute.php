<?php

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

/**
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
