<?php

namespace App\Http\Controllers\api;

use OpenApi\Annotations as OA;

/**
 * @OA\Info (
 *     version="3.0",
 *     title="用户列表",
 *     @OA\Contact (
 *         name="hlt",
 *         url="localhost",
 *         email="935298911@qq.com"
 *     )
 * ),
 *
 * @OA\Server (
 *     url="http://localhost/api/user"
 * ),
 *
 * @OA\SecuritySchema (
 *     type="oauth2"
 * )
 */
class UserController extends \App\Http\Controllers\Controller
{

    /**
     * @OA\Get(
     *     path="/",
     *     operationId="index",
     *     tags={"users"},
     *     summary="获取随机用户列表",
     *     description="获取随机用户列表",
     *     @OA\Parameter(
     *         name="pre",
     *         description="随机姓名的前缀",
     *         required=false,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="age",
     *         description="随机年龄的基数",
     *         required=false,
     *         in="query",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="401",
     *         description="fail"
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="success",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(
     *                     format="string",
     *                     title="name",
     *                     description="用户名称，包括前缀（如果有）",
     *                     property="name",
     *                 ),
     *                 @OA\Property(
     *                     format="string",
     *                     title="gender",
     *                     description="用户性别",
     *                     property="gender",
     *                 ),
     *                 @OA\Property(
     *                     format="integer",
     *                     title="age",
     *                     description="用户年龄+基数",
     *                     property="age",
     *                 )
     *             )
     *         ),
     *     )
     * )
     * @return array
     */
    public function index()
    {
        $list = [];
        for ($i = 0; $i < 10; $i++) {
            $list[] = [
                'name' => $this->randomName(),
                'gender' => $this->randomGender(),
                'age' => $this->randomAge()
            ];
        }
        return $list;
    }

    private function randomName()
    {
        $len = rand(10, 20);
        $ans = '';
        for ($i = 0; $i < $len; $i++) {
            $ans .= chr(ord('a') + rand(0, 25));
        }
        return ucwords($ans);
    }

    private function randomGender()
    {
        $genders = ['男', '女'];
        return $genders[rand(0, 1)];
    }

    private function randomAge()
    {
        return rand(15, 18);
    }

}
