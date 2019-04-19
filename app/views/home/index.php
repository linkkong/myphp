<h2 class="sub-header">首页</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>ItemName</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items ?? "" as $item): ?>
            <tr>
                <td><?php echo $item['id'] ?></td>
                <td><?php echo $item['item_name'] ?></td>
                <td>
                    <a href="/home/edit/<?php echo $item['id'] ?>">编辑</a>
                    <a href="/home/delete/<?php echo $item['id'] ?>">删除</a>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
</div>

