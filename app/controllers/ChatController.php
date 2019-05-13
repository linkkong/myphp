<?php

namespace app\controllers;


use core\Controller;

class ChatController extends Controller
{


    public function index()
    {

        $this->assign('isChat', true);
        $this->render();
    }
}