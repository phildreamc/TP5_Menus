<?php
namespace app\index\validate;

use think\Validate;

class Add extends Validate
{
    protected $rule = [
        ['name','require|checkOrders','请按套路出牌！|请按套路出牌！'],
        ['orders','require|checkOrders','请按套路出牌！|请按套路出牌！'],
        ['count','require|checkData','请按套路出牌！|请按套路出牌！'],
    ];
    
    protected function checkData($value)
    {
        return 1 === preg_match('/^[a-zA-Z0-9+]+$/', $value);
    }
    
    protected function checkOrders($value)
    {
        return 1 === preg_match('/^([\x80-\xff]|[a-zA-Z0-9+]|[(),（），])+$/', $value);
    }
}