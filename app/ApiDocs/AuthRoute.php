<?php

/**
 * @OA\Post(
 ** path="/api/v2/login",
 *   tags={"Auth"},
 *   summary="Login",
 *   operationId="login",
 *
 *   @OA\Parameter(
 *      name="email",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="password",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *          type="string"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated."
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *   @OA\Response(
 *      response=403,
 *      description="Forbidden"
 *   )
 *)
 **/

/**
 * @OA\Post(
 ** path="/api/v2/register",
 *   tags={"Auth"},
 *   summary="Register",
 *   operationId="register",
 *
 *  @OA\Parameter(
 *      name="name",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *  @OA\Parameter(
 *      name="email",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="password",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Parameter(
 *      name="c_password",
 *      in="query",
 *      required=true,
 *      @OA\Schema(
 *           type="string"
 *      )
 *   ),
 *   @OA\Response(
 *      response=200,
 *       description="Success",
 *      @OA\MediaType(
 *           mediaType="application/json",
 *      )
 *   ),
 *   @OA\Response(
 *      response=401,
 *       description="Unauthenticated"
 *   ),
 *   @OA\Response(
 *      response=400,
 *      description="Bad Request"
 *   ),
 *   @OA\Response(
 *      response=404,
 *      description="not found"
 *   ),
 *   @OA\Response(
 *      response=403,
 *      description="Forbidden"
 *   )
 *)
 **/

/**
 * @OA\Post(
 *      path="/api/v2/details",
 *      operationId="user-details",
 *      tags={"Auth"},
 *      summary="Get User Details",
 *      description="Get User Details",
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
 *          description="Unauthenticated"
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Bad Request"
 *      ),
 *      @OA\Response(
 *          response=404,
 *          description="not found"
 *      ),
 *      @OA\Response(
 *          response=403,
 *          description="Forbidden"
 *      )
 * )
 * Returns list of articles
 */
