<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\menu\model\Menus;
use think\Db;

class Index extends Controller
{
    public function index(Request $request,$type = 0)
    {
        if($type==1){
            $store = Menus::all(function($query){
                $query->where('type','like',"%1%")->order('id', 'asc');
            });
            $this->assign('type',1);
            $this->assign('store',$store);
            return $this->fetch();
        }else if($type==2){
            $store = Menus::all(function($query){
                $query->where('type','like',"%2%")->order('id', 'asc');
            });
            $this->assign('type',2);
            $this->assign('store',$store);
            return $this->fetch();
        }else if($type==3){
            $store = Menus::all(function($query){
                $query->where('type','like',"%3%")->order('id', 'asc');
            });
            $this->assign('type',3);
            $this->assign('store',$store);
            return $this->fetch();
        }else if($type==4){
            $store = Menus::all(function($query){
                $query->where('type','like',"%4%")->order('id', 'asc');
            });
            $this->assign('type',4);
            $this->assign('store',$store);
            return $this->fetch();
        }else{
            $store = Menus::all(function($query){
                $query->order('id', 'asc');
            });
            $this->assign('type',0);
            $this->assign('store',$store);
            return $this->fetch();
        }
    }
    
    public function guest()
    {
        return '游客禁止';
    }
}