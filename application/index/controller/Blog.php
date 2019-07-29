<?php
namespace app\Index\Controller;

use think\Controller;
use think\Db;

class Blog extends Controller
{
    public function get()
    {
        return 'swoole——
链接：https://pan.baidu.com/s/1XfUTwgUEmRv2A0xBaD2l4w 
提取码：u6r6 


高并发（新）
链接：https://pan.baidu.com/s/1F80ZbSbjlqgIGLekQaZ3qA 
提取码：fe2t';
    }
    
    public function read($name)
    {
        return '查看name='.$name.'的内容';
    }
    
    public function archive($year,$month)
    {
        return '查看'.$year.'/'.$month.'的归档内容';
    }
    
    public function test()
    {
        $data = Db::name('data')->find();
        $this->assign('result',$data);
        return $this->fetch();
    }
}