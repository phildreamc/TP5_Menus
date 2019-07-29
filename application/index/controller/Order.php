<?php
namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Mid;
use app\menu\model\Menus;

class Order extends Controller
{
    public function order(Request $request)
    {
        $result = $this->validate(input('param.'),'Order');
        if (true !== $result) {
            $this->error($result,'index/index');
        }
        $menu_id = input('param.menu_id');
        $menus = Menus::get($menu_id);
        if(!$menus) {
            $this->error('菜单不存在！','index/index');
        }else{
            $order = new Mid;
            $order->menu = $menus->pics;
            $order->mid = date("YmdHis").rand(100,999);
            $order->off = false;
            if($order->save()){
                cookie('mid',$order->mid,3600*24);
                $this->success('创建成功，前往点餐地址！','index?mid='.$order->mid);
            }
        }
    }
    
    public function index(Request $request)
    {
        $result = $this->validate(input('param.'),'Mid');
        if (true !== $result) {
            $this->error($result,'index/index');
        }
        $mid = Mid::get(input('param.mid'));
        if(!$mid){
            $this->error('菜单不存在！','index/index');
        }
        $pics = explode("@",$mid->menu);
        $this->assign('pics',$pics);
        $this->assign('data',$mid);
        $this->assign('mid',input('param.mid'));
        return $this->fetch();
    }
    
    public function olist(Request $request)
    {
        $result = $this->validate(input('param.'),'Mid');
        if (true !== $result) {
            $this->error($result,'index/index');
        }
        $mid = Mid::get(input('param.mid'));
        if(!$mid){
            $this->error('菜单不存在！','index/index');
        }
        $orders = "";
        $count = 0;
        if($mid->orders){
            $orders = explode("@",$mid->orders);
            foreach($orders as $order){
                $price = explode("=",$order)[1];
                $count += $price;
            }
        }
        $this->assign('orders',$orders);
        $this->assign('count',$count);
        return $this->fetch();
    }
    
    public function add(Request $request)
    {
        $result = $this->validate(input('param.'),'Add');
        if (true !== $result) {
            $this->error($result,'index/index');
        }
        $mid = Mid::get(input('param.mid'));
        if(!$mid){
            $this->error('请按套路出牌！','index/index');
        }else{
            if($mid->off){
                $this->error('抱歉，已截单！','index/index');
            }
            $orders = input('param.name').":".input('param.orders')."=".input('param.count');
            if(!$mid->orders){
                $mid->orders = $orders;
            }else{
                if(strpos($mid->orders,input('param.name'))!==false){
                    $each = explode('@',$mid->orders);
                    for($i=0;$i<count($each);$i++){
                        if(strpos($each[$i],input('param.name'))!==false){
                            $each[$i] = $orders;
                        }
                    }
                    $mid->orders = implode("@",$each);
                }else{
                    $mid->orders .= "@".$orders;
                }
            }
            $mid->save();
            cookie('name',input('param.name'),3600*24*365);
            return "success";
        }
    }
    
    public function shut(Request $request)
    {
        $result = $this->validate(input('param.'),'Mid');
        if (true !== $result) {
            $this->error($result,'index/index');
        }
        $mid = Mid::get(input('param.mid'));
        if(!$mid){
            $this->error('请按套路出牌！','index/index');
        }else{
            if(!$mid->off){
                $mid->off = 1;
                $mid->save();
                $this->success('操作成功！','index?mid='.input('param.mid'));
            }
            $this->error('请勿重复操作！','index?mid='.input('param.mid'));
        }
    }
}
