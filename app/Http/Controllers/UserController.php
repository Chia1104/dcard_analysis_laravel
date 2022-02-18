<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public int $successStatus = 200;

    /**
     * login api
     *
     * @return JsonResponse
     */
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
    public function login(): JsonResponse
    {
        $randomstr = Str::random(30);
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['message'] = 'success';
            $success['user_id'] = $user->id;
            $success['token'] =  $user->createToken($randomstr)->accessToken;
            $success['name'] =  $user->name;
            return response()->json($success, $this->successStatus);
        }
        else {
            $error['message'] = 'Unauthorised';
            return response()->json($error, 401);
        }
    }


    /**
     * Register api
     *
     * @param Request $request
     * @return JsonResponse
     */
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
    public function register(Request $request): JsonResponse
    {
        $randomstr = Str::random(30);
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'c_password' => 'required|same:password',
        ]);


        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()], 401);
        }


        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['message'] = 'success';
        $success['user_id'] = $user->id;
        $success['token'] =  $user->createToken($randomstr)->accessToken;
        $success['name'] =  $user->name;


        return response()->json($success, $this->successStatus);
    }


    /**
     * details api
     *
     * @return JsonResponse
     */
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
    public function details(): JsonResponse
    {
        $user = Auth::user();
        $success['message'] = 'success';
        $success['id'] = $user->id;
        $success['name'] = $user->name;
        $success['email'] = $user->email;
        $success['email_verified_at'] = $user->email_verified_at;
        $success['created_at'] = $user->created_at;
        $success['updated_at'] = $user->updated_at;
        return response()->json($success, $this->successStatus);
    }
}
