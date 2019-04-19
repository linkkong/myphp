<?php

namespace app\controllers;

use app\models\ItemModel;
use core\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        if ($keyword) {
            $items = (new ItemModel())->search($keyword);
        } else {
            // 查询所有内容，并按倒序排列输出
            // where()方法可不传入参数，或者省略
            $items = (new ItemModel)->where()->order(['id DESC'])->fetchAll();
        }

        $this->assign('title', '全部条目');
        $this->assign('keyword', $keyword);
        $this->assign('items', $items);
        $this->render();
    }

    /**
     * 新增页面
     */
    public function create()
    {
        $this->render();
    }

    /**
     * 保存页面
     */
    public function store()
    {
        $data['item_name'] = $_POST['item_name'] ?? "";
        $count = (new ItemModel)->add($data);

        $this->toIndex();
    }

    /**
     * 编辑页面
     *
     * @param $id
     */
    public function edit($id)
    {
        $this->assign('id', $id);

        $detail = $this->detail($id);

        $this->assign('detail', $detail);

        $this->render();
    }

    // 查看单条记录详情
    public function detail($id)
    {
        // 通过?占位符传入$id参数
        return (new ItemModel())->where(["id = ?"], [$id])->fetch();
    }

    /**
     * 保存修改
     *
     * @param $id
     */
    public function update($id)
    {
        $data = array('id' => $id, 'item_name' => $_POST['item_name']);
        (new ItemModel)->where(['id = :id'], [':id' => $data['id']])->update($data);

        $this->toIndex();
    }

    /**
     * 删除
     *
     * @param $id
     */
    public function delete($id)
    {
        (new ItemModel)->delete($id);
        $this->toIndex();
    }

    /**
     * 跳转首页
     */
    public function toIndex()
    {
        header("Location: //a.vipx.de");
        exit();
    }
}