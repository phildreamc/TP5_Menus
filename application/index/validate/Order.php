<?php
namespace app\index\validate;

use think\Validate;

class Order extends Validate
{
    protected $rule = [
        ['menu_id','require|number','请按套路出牌！|请按套路出牌！'],
    ];
}