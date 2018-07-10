<?php
/**
 * 验证测试
 */

namespace app\index\controller;
use app\common\controller\Base;
use think\Validate;
use think\Db;

class Demo extends Base
{
    public function getBase()
    {
//        获取用户输入内容
        $sjBase = [
            'name' => input('jxhz-username'),
            'tel' => input('jxhz-tel'),
            'contain' => input('jxhz-lyb'),
        ];
//        验证规则
        $rule = [
            'name' => 'require|length:3,20|chsAlpha',
            'contain' => 'require|length:8,225|chsAlphaNum'
        ];
        //验证提示信息
        $message = [
            'name.require' => '请填写用户名！',
            'name.length' => '姓名长度为3-20个字符！',
            'name.chsAlpha' => '姓名必须为汉字或者字母',
            'contain.require' => '请填写留言内容！',
            'contain.length' => '留言内容长度为8 - 225个字符！',
            'contain.chsAlphaNum' => '留言内容必须为汉字或者字母'
        ];
        //实例化验证
        //如果有多个数据都不满足验证条件 批量验证 batch()
        $validate = new Validate($rule,$message);
        $res = $validate -> check($sjBase);
        //返回错误 array
        if(!$res){
            $errorInfo = $validate -> getError();
            print_r($errorInfo);
        }else{
            Db::table('hz_user_message')->insertGetId($sjBase);
            print_r('留言成功!');
        }
    }
}