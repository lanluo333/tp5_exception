<?php
namespace app\lib\exception;
use think\Exception;
use think\exception\Handle;
use think\Log;
use think\Request;

/**
 * Created by PhpStorm.
 * User: rui
 * Date: 2017/9/23
 * Time: 10:47
 */
class ExceptionHandler extends Handle
{
    private $code;//HTTP 状态码 400 404
    private $msg;//错误具体信息
    private $errorCode;//自定义错误码

    //自定义异常处理
    //覆盖tp5自己封装的render方法,抛出的异常都会进入render里面来
    //之后还要在配置文件哪里配置
    public function render(\Exception $e)
    {
        if ( $e instanceof BaseException){
            //如果是自定义的异常
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }else{
            if(config('app_debug')){
                return parent::render($e);
            }else {
                $this->code = 500;
                $this->msg = '服务器内部错误';
                $this->errorCode = 999;
                $this->recordErrorLog($e);
            }
        }
        $request = Request::instance();
        $result = [
            'error_code' => $this->errorCode,
            'msg' => $this->msg,
            'request_url' => $request->url()
        ];
        return json($result,$this->code);
    }

    private function recordErrorLog(\Exception $e){
        //日志初始化，因为在配置文件那里关闭了框架的自动日志记录，所以，我们这里要初始化回来
        Log::init([
            'type'=>'file',
            'path'=>LOG_PATH,
            'level'=>['error']//设置error的错误级别才能进行日志的写入
        ]);
        Log::record($e->getMessage(),'error');//日志记录，第一个参数是记录信息，第二个是错误级别
    }
}