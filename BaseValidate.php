<?php
namespace app\api\validate;

use app\lib\exception\ParameterException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{
    public function goCheck()
    {
        //获取http传入的参数
        //对这些参数进行校验
        $params = Request::instance()->param();

        $result = $this->batch()->check($params);
        if (!$result){
            $e = new ParameterException([
                'msg'=>$this->error,
            ]);
//            $e->msg = $this->error;
            throw $e;
//            $errno = $this->error;
//            throw new Exception($errno);
        }else{
            return true;
        }
    }

    protected function isPostiveInteger($value,$rule='',$data='',$filed='')
    {
        if (is_numeric($value) && is_int($value+0) && ($value+0) > 0){
            return true;
        }else{
//            return $filed . '必须是正整数';
            return false;
        }
    }

    protected function isNotEmpty($value,$rule='',$data='',$field=''){
        if (empty($value)) {
            return $field . '不允许为空';
        } else {
            return true;
        }
        //return empty($value) ? false:true;
    }

    protected function isMobile($value){
        $rule = '^1([3|4|5|7|8])[0-9]\d{8}$^';
        $result = preg_match($rule,$value);
        if ($result){
            return false;
        }
        return true;
    }

    /**
     * @description 只接受需要验证的字段
     * @param array $arrays
     * @return array
     * @throws ParameterException
     */
    public function getDataByRule($arrays)
    {
        if (array_key_exists('user_id',$arrays) || array_key_exists('uid',$arrays)){
            throw new ParameterException([
                'msg' => '参数中包含非法的user_id或者uid参数'
            ]);
        }

        $newArray = [];
        foreach ($this->rule as $key=>$value){
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }
}