<?php
namespace app\index\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        ['nickname','require|min:5|token','昵称必须|昵称不能短于5个字符'],
        ['email', 'require|checkMail:gmail.com', '邮箱必须|只能是gmail邮箱'],
        'birthday' => 'dateFormat:Y-m-d',
    ];
    
    protected function checkMail($value,$rule)
    {
        return 1 === preg_match('/^\w+([-+.]\w+)*@' . $rule . '$/', $value);
    }
}