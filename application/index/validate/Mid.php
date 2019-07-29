<?php
namespace app\index\validate;

use think\Validate;

class Mid extends Validate
{
    protected $rule = [
        ['mid','require|checkMid','点餐链接不存在！|点餐链接不存在！'],
    ];
    
    protected function checkMid($value)
    {
        return 1 === preg_match('/^[a-zA-Z\d]+$/', $value);
    }
}