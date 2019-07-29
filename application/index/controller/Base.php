<?php
namespace app\index\controller;

class Base
{
    public function index($name = 'base')
    {
        return 'Hello,'.$name.'!';
    }
}