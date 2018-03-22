<?php
/**
 * Created by PhpStorm.
 * User: rui
 * Date: 2017/9/24
 * Time: 10:28
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    public $code = 400;//HTTP 状态码 400 404
    public $msg = '参数错误';//错误具体信息
    public $errorCode = 10000;//自定义错误码
}