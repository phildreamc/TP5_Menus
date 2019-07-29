<?php
namespace app\menu\controller;
use think\Controller;
use think\Request;
use app\menu\model\Menus;

class UpLoad extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    
    public function upload(Request $request)
    {
        $result = $this->validate(input('post.'),'UpLoad');
        if (true !== $result) {
            $this->error($result,'index');
        }
        $upfile = $request->file('upfile');
        if(!empty($upfile)){
            // $hz = array_pop(explode(".", $request->file('upfile')->filename));
            // $filename = date("YmdHis").rand(100,999).".".$hz;
            $rules = ['ext' => 'jpge,jpg,png', 'size' => 2*1024*1024];
            $f = "";
            $filename = "";
            foreach($upfile as $file){
                $r = $file->validate($rules);
                if(!$r){
                    $this->error('图片太大！','index');
                }
                $info = $file->move(ROOT_PATH.'public'.DS.'uploads/images');
                if(!$info){
                    $this->error('图片太大或上传失败！','goIndex');
                }
                $filename .= $f.'/uploads/images/'.$info->getSaveName();
                $f = "@";
            }
            if($filename){
                $url = $filename;
                $menus = new Menus;
                $menus->name = $request->param('name');
                $menus->type = implode("", $request->param('type/a'));
                $menus->pics = $url;
                if($menus->save()){
                    $this->success('上传成功！','goIndex');
                }else{
                    return $menus->getError();
                }
            }
            $this->error('添加失败，请重试！','index');
        }
        $this->error('菜单图片不能为空！','index');
    }
    
    public function goIndex()
    {
        $this->redirect(url('index/index/index'));
    }
}
