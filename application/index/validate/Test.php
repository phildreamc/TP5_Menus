<?php
namespace app\index\validate;

use think\Validate;

class Test extends Validate
{
    protected $rule = [
        'nickname|昵称' => 'require|min:5|token',
        'email' => 'require|email',
        'birthday' => 'dateFormat:Y-m-d',
    ];
}