<?php

/**
 * @OA\Info(
 *      version="2.0.0",
 *      title="CGU Dcard Analysis API",
 *      description="CGU Dcard Analysis API",
 *      @OA\Contact(
 *          email="yuyuchia7423@gmail.com"
 *      )
 * )
 * @OA\server(
 *      url = "http://127.0.0.1:8000/",
 *      description="Localhost"
 * )
 * @OA\server(
 *      url = "https://dcard-analysis-laravel-develop-fdqsyjapma-de.a.run.app/",
 *      description="測試區主機"
 * )
 * @OA\server(
 *      url = "https://dcard-analysis-laravel-fdqsyjapma-de.a.run.app/",
 *      description="正式區主機"
 * )
 * @OA\SecurityScheme(
 *      securityScheme="Authorization",
 *      type="apiKey",
 *      in="header",
 *      name="Authorization"
 * )
 */
