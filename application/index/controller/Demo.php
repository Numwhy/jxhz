<?php
/**
 * 验证测试
 */
namespace app\index\controller;
use app\common\controller\Base;
use think\Validate;
use think\Db;
use think\Loader;

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
            'name' => 'require|length:2,20|chsAlpha',
            'contain' => 'require|length:8,225'
        ];
        //验证提示信息
        $message = [
            'name.require' => '请填写用户名！',
            'name.length' => '姓名长度为2-20个字符！',
            'name.chsAlpha' => '姓名必须为汉字或者字母',
            'contain.require' => '请填写留言内容！',
            'contain.length' => '留言内容长度为8 - 225个字符！'
        ];
        //实例化验证
        //如果有多个数据都不满足验证条件 批量验证 batch()
        $validate = new Validate($rule,$message);
        $res = $validate -> check($sjBase);
        if(!$res){
            $errorInfo = $validate -> getError();
            print_r($errorInfo);
        }else{
            Db::table('hz_user_message')->insertGetId($sjBase);
            //$res = Db::table('hz_user_message')->where(['id'=>$msgid])->find();
            //$data = array('datas'=>$res,'infosa'=>'留言成功!');
           // $result = json_encode($data,true);
            $arr = array('info'=>'留言成功','status'=>1);
            $result = json_encode($arr);
            return $result;
        }
    }
}
?>