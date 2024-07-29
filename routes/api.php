<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::any('/public/setting', [\App\Http\Controllers\Api\PublicController::class, 'setting']);
Route::any('/public/upload', [\App\Http\Controllers\Api\PublicController::class, 'upload']);
Route::any('/public/noticeList', [\App\Http\Controllers\Api\PublicController::class, 'noticeList']);
Route::any('/public/noticeDetail', [\App\Http\Controllers\Api\PublicController::class, 'noticeDetail']);
Route::any('/public/bannerList', [\App\Http\Controllers\Api\PublicController::class, 'bannerList']);
Route::any('/public/typeList', [\App\Http\Controllers\Api\PublicController::class, 'typeList']);
Route::any('/public/interestList', [\App\Http\Controllers\Api\PublicController::class, 'interestList']);
Route::any('/public/biasList', [\App\Http\Controllers\Api\PublicController::class, 'biasList']);
Route::any('/public/vipList', [\App\Http\Controllers\Api\PublicController::class, 'vipList']);
Route::any('/public/test', [\App\Http\Controllers\Api\PublicController::class, 'test']);

Route::any('/user/login', [\App\Http\Controllers\Api\UserController::class, 'login'])->name('login');

Route::middleware('auth:api')->any('/user/couponList', [\App\Http\Controllers\Api\UserController::class, 'couponList']);
Route::middleware('auth:api')->any('/user/userPrice', [\App\Http\Controllers\Api\UserController::class, 'userPrice']);
Route::middleware('auth:api')->any('/user/applyTi', [\App\Http\Controllers\Api\UserController::class, 'applyTi']);
Route::middleware('auth:api')->any('/user/mySubordinate', [\App\Http\Controllers\Api\UserController::class, 'mySubordinate']);
Route::middleware('auth:api')->any('/user/myCollect', [\App\Http\Controllers\Api\UserController::class, 'myCollect']);
Route::middleware('auth:api')->any('/user/userInfo', [\App\Http\Controllers\Api\UserController::class, 'userInfo']);
Route::middleware('auth:api')->any('/user/follow', [\App\Http\Controllers\Api\UserController::class, 'follow']);
Route::middleware('auth:api')->any('/user/fansList', [\App\Http\Controllers\Api\UserController::class, 'fansList']);
Route::middleware('auth:api')->any('/user/followList', [\App\Http\Controllers\Api\UserController::class, 'followList']);
Route::middleware('auth:api')->any('/user/editUserInfo', [\App\Http\Controllers\Api\UserController::class, 'editUserInfo']);
Route::middleware('auth:api')->any('/user/editBias', [\App\Http\Controllers\Api\UserController::class, 'editBias']);
Route::middleware('auth:api')->any('/user/editInterest', [\App\Http\Controllers\Api\UserController::class, 'editInterest']);
Route::middleware('auth:api')->any('/user/editType', [\App\Http\Controllers\Api\UserController::class, 'editType']);
Route::middleware('auth:api')->any('/user/searchNum', [\App\Http\Controllers\Api\UserController::class, 'searchNum']);
Route::middleware('auth:api')->any('/user/myActivity', [\App\Http\Controllers\Api\UserController::class, 'myActivity']);
Route::middleware('auth:api')->any('/user/mySigns', [\App\Http\Controllers\Api\UserController::class, 'mySigns']);
Route::middleware('auth:api')->any('/user/todayPrice', [\App\Http\Controllers\Api\UserController::class, 'todayPrice']);
Route::middleware('auth:api')->any('/user/monthPrice', [\App\Http\Controllers\Api\UserController::class, 'monthPrice']);
Route::middleware('auth:api')->any('/user/otherInfo', [\App\Http\Controllers\Api\UserController::class, 'otherInfo']);
Route::middleware('auth:api')->any('/user/myFollow', [\App\Http\Controllers\Api\UserController::class, 'myFollow']);



Route::middleware('auth:api')->any('/user/activityNoticeList', [\App\Http\Controllers\Api\UserController::class, 'activityNoticeList']);
Route::middleware('auth:api')->any('/user/activityNoticeDetail', [\App\Http\Controllers\Api\UserController::class, 'activityNoticeDetail']);





Route::any('/activity/typeList', [\App\Http\Controllers\Api\ActivityController::class, 'typeList']);
Route::any('/activity/dislikeList', [\App\Http\Controllers\Api\ActivityController::class, 'dislikeList']);
Route::middleware('auth:api')->any('/activity/publish', [\App\Http\Controllers\Api\ActivityController::class, 'publish']);
Route::any('/activity/detail', [\App\Http\Controllers\Api\ActivityController::class, 'detail']);
Route::any('/activity/list', [\App\Http\Controllers\Api\ActivityController::class, 'list']);
Route::middleware('auth:api')->any('/activity/sign', [\App\Http\Controllers\Api\ActivityController::class, 'sign']);
Route::middleware('auth:api')->any('/activity/activitySet', [\App\Http\Controllers\Api\ActivityController::class, 'activitySet']);
Route::middleware('auth:api')->any('/activity/cancel', [\App\Http\Controllers\Api\ActivityController::class, 'cancel']);
Route::middleware('auth:api')->any('/activity/quit', [\App\Http\Controllers\Api\ActivityController::class, 'quit']);
Route::middleware('auth:api')->any('/activity/qaList', [\App\Http\Controllers\Api\ActivityController::class, 'qaList']);
Route::middleware('auth:api')->any('/activity/qa', [\App\Http\Controllers\Api\ActivityController::class, 'qa']);
Route::middleware('auth:api')->any('/activity/qaAnswer', [\App\Http\Controllers\Api\ActivityController::class, 'qaAnswer']);
Route::middleware('auth:api')->any('/activity/comment', [\App\Http\Controllers\Api\ActivityController::class, 'comment']);
Route::middleware('auth:api')->any('/activity/replyComment', [\App\Http\Controllers\Api\ActivityController::class, 'replyComment']);
Route::middleware('auth:api')->any('/activity/collect', [\App\Http\Controllers\Api\ActivityController::class, 'collect']);
Route::middleware('auth:api')->any('/activity/cancelCollect', [\App\Http\Controllers\Api\ActivityController::class, 'cancelCollect']);
Route::middleware('auth:api')->any('/activity/dislike', [\App\Http\Controllers\Api\ActivityController::class, 'dislike']);
Route::middleware('auth:api')->any('/activity/prohibitList', [\App\Http\Controllers\Api\ActivityController::class, 'prohibitList']);
Route::middleware('auth:api')->any('/activity/otherList', [\App\Http\Controllers\Api\ActivityController::class, 'otherList']);
Route::middleware('auth:api')->any('/activity/otherSignList', [\App\Http\Controllers\Api\ActivityController::class, 'otherSignList']);
Route::middleware('auth:api')->any('/activity/like', [\App\Http\Controllers\Api\ActivityController::class, 'like']);
Route::middleware('auth:api')->any('/activity/getQrCode', [\App\Http\Controllers\Api\ActivityController::class, 'getQrCode']);
Route::middleware('auth:api')->any('/activity/getMpUrl', [\App\Http\Controllers\Api\ActivityController::class, 'getMpUrl']);



Route::middleware('auth:api')->any('/pay/pay', [\App\Http\Controllers\Api\PayController::class, 'pay']);

