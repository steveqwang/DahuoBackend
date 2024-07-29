<?php

// This file is auto-generated, don't edit it. Thanks.
namespace App\Logic;

use AlibabaCloud\SDK\Dypnsapi\V20170525\Dypnsapi;
use AlibabaCloud\SDK\Imageaudit\V20191230\Imageaudit;
use AlibabaCloud\SDK\Imageaudit\V20191230\Models\ScanImageRequest;
use AlibabaCloud\SDK\Imageaudit\V20191230\Models\ScanImageRequest\task;
use AlibabaCloud\SDK\Imageaudit\V20191230\Models\ScanTextRequest\labels;
use AlibabaCloud\SDK\Imageaudit\V20191230\Models\ScanTextRequest\tasks;
use AlibabaCloud\Tea\Model;
use App\Exceptions\CommonException;
use \Exception;
use AlibabaCloud\Tea\Exception\TeaError;
use AlibabaCloud\Tea\Utils\Utils;

use Darabonba\OpenApi\Models\Config;
use AlibabaCloud\SDK\Dypnsapi\V20170525\Models\GetMobileRequest;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;
use AlibabaCloud\SDK\Imageaudit\V20191230\Models\ScanTextRequest;
use Illuminate\Support\Facades\Storage;

class AliLogic {

    /**
     * 使用AK&SK初始化账号Client
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @return Config
     */
    public static function createClient($accessKeyId, $accessKeySecret){
        $config = new Config([
            // 必填，您的 AccessKey ID
            "accessKeyId" => $accessKeyId,
            // 必填，您的 AccessKey Secret
            "accessKeySecret" => $accessKeySecret
        ]);
        return $config;

    }

    /**
     * 获取手机号
     * @param $token
     * @return string
     * @throws CommonException
     */
    public static function main($token){
        // 工程代码泄露可能会导致AccessKey泄露，并威胁账号下所有资源的安全性。以下代码示例仅供参考，建议使用更安全的 STS 方式，更多鉴权访问方式请参见：https://help.aliyun.com/document_detail/311677.html
        $config = self::createClient(env('ALIYUN_ACCESS_ID'), env('ALIYUN_ACCESS_KEY'));
        $config->endpoint = "dypnsapi.aliyuncs.com";
        $client = new Dypnsapi($config);
        $getMobileRequest = new GetMobileRequest([
            "accessToken" => $token,
        ]);
        $runtime = new RuntimeOptions([]);
        try {
            // 复制代码运行请自行打印 API 的返回值
            $res = $client->getMobileWithOptions($getMobileRequest, $runtime);
            if($res->body->getMobileResultDTO){
                return $res->body->getMobileResultDTO->mobile;
            }
            throw new CommonException( '获取手机号失败',450);
        }
        catch (Exception $error) {
            if (!($error instanceof TeaError)) {
                $error = new TeaError([], $error->getMessage(), $error->getCode(), $error);
            }
            // 如有需要，请打印 error
            throw new CommonException( $error->message,$error->code);

        }
    }

    /**
     * @param string $content
     * @return bool
     * @throws CommonException
     */
    public static function text($content){
        // 请确保代码运行环境设置了环境变量 ALIBABA_CLOUD_ACCESS_KEY_ID 和 ALIBABA_CLOUD_ACCESS_KEY_SECRET。
        // 工程代码泄露可能会导致 AccessKey 泄露，并威胁账号下所有资源的安全性。以下代码示例使用环境变量获取 AccessKey 的方式进行调用，仅供参考，建议使用更安全的 STS 方式，更多鉴权访问方式请参见：https://help.aliyun.com/document_detail/311677.html

        $config = self::createClient(env('ALIYUN_ACCESS_ID'), env('ALIYUN_ACCESS_KEY'));
        $config->endpoint = "imageaudit.cn-shanghai.aliyuncs.com";

        $client = new Imageaudit($config);

        $tasks0 = new tasks([
            "content" => $content
        ]);

        $labels[] = new labels([
            "label" => "politics"
        ]);
        $labels[] = new labels([
            "label" => "terrorism"
        ]);
        $labels[] = new labels([
            "label" => "porn"
        ]);
        $labels[] = new labels([
            "label" => "contraband"
        ]);
        $labels[] = new labels([
            "label" => "abuse"
        ]);


        $scanTextRequest = new ScanTextRequest([
            "tasks" => [
                $tasks0
            ],
            "labels" => $labels
        ]);
        $runtime = new RuntimeOptions([]);
        try {
            // 复制代码运行请自行打印 API 的返回值
            $aa = $client->scanTextWithOptions($scanTextRequest, $runtime);
            $bb = json_decode(json_encode($aa),true);
//            dd($bb);
            if(empty($bb['data']['elements'][0]['results']) || $bb['data']['elements'][0]['results'][0]['suggestion']=='pass'){
               return true;
            }else{
                throw new CommonException('文字内容违规');
            }
        }
        catch (Exception $error) {
            if (!($error instanceof TeaError)) {
                $error = new TeaError([], $error->getMessage(), $error->getCode(), $error);
            }
            // 如有需要，请打印 error
            throw new CommonException($error->message);

        }
    }


    /**
     * @param string $image
     * @return false
     * @throws CommonException
     */
    public static function image($image){
        // 请确保代码运行环境设置了环境变量 ALIBABA_CLOUD_ACCESS_KEY_ID 和 ALIBABA_CLOUD_ACCESS_KEY_SECRET。
        // 工程代码泄露可能会导致 AccessKey 泄露，并威胁账号下所有资源的安全性。以下代码示例使用环境变量获取 AccessKey 的方式进行调用，仅供参考，建议使用更安全的 STS 方式，更多鉴权访问方式请参见：https://help.aliyun.com/document_detail/311677.html
        $config = self::createClient(env('ALIYUN_ACCESS_ID'), env('ALIYUN_ACCESS_KEY'));
        $config->endpoint = "imageaudit.cn-shanghai.aliyuncs.com";
        $client = new Imageaudit($config);
        $task0 = new task([
            "imageURL" => Storage::disk('public')->url($image)
        ]);
        $scanImageRequest = new ScanImageRequest([
            "scene" => [
                "porn",
                "terrorism"
            ],
            "task" => [
                $task0
            ]
        ]);
        $runtime = new RuntimeOptions([]);
        try {
            // 复制代码运行请自行打印 API 的返回值
            $aa = $client->scanImageWithOptions($scanImageRequest, $runtime);
            $bb = json_decode(json_encode($aa),true);
//            dd($bb);
            foreach ($bb['data']['results'][0]['subResults'] as $k=>$v){
                if($v['label'] != 'normal'){
                    throw new CommonException('图片违规');
                }
            }
            return true;
        }
        catch (Exception $error) {
            if (!($error instanceof TeaError)) {
                $error = new TeaError([], $error->getMessage(), $error->getCode(), $error);
            }
            // 如有需要，请打印 error
            throw new CommonException($error->message);
        }
    }

}
