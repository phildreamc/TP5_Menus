<?php
namespace app\menu\validate;

use think\Validate;

class UpLoad extends Validate
{
    // 验证规则
    protected $rule = [
        'name|店铺名称' => 'require|checkName',
        'type|经营类型'    => 'require|checkType',
    ];
    
    protected function checkName($str)
    {
        $len = preg_match('/^[\x{4e00}-\x{9fa5}a-zA-Z]+$/u',$str);
        if ($len){
            return true;
        }
        return '店铺名称只能是中文或英文！';
    }
    
    protected function checkType($str)
    {
        $typeArray = array('1','2','3','4');
        foreach ($str as $key => $value){
            if(!in_array($value,$typeArray)){
                return '请按套路出牌！';
            }
        }
        return true;
    }
}