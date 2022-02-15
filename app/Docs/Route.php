// app/Docs/Route.php
<?php
/**
 * @OA\Get(
 *      path="/api/v2/dcard",
 *      operationId="articles",
 *      tags={"Article Tag"},
 *      summary="取得文章列表 Summary",
 *      description="取得文章列表 Description",
 *      security={
 *         {
 *              "Authorization": {}
 *         }
 *      },
 *      @OA\Response(
 *          response=200,
 *          description="請求成功"
 *       )
 * )
 * Returns list of articles
 */
