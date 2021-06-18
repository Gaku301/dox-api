<?php

namespace app\controller;

require_once 'controller.php';

class contact extends controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $reponse = [
            'code' => 'C200',
            'result' => '成功しました',
        ];

        return $reponse;
    }

    public function post()
    {
        echo 'post成功';
    }
}
