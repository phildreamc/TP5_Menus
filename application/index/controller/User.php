<?php
namespace app\index\controller;

use think\Controller;
use think\Request;

class User extends Controller
{
    public function create()
    {
        return $this->fetch();
    }
    
    public function add()
    {
        $check = $this->validate(input('post.'),'User');
        if (true === $check){
            return '用户新增成功';
        }else{
            return $check;
        }
    }
}
