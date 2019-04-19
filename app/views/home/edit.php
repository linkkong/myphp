<div class="table-responsive">
    <h2>编辑内容</h2>
    <form class="form-horizontal" method="post" action="/home/update/<?php echo $id ?? 0 ?>">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Item Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"
                       value="<?php echo $detail['item_name'] ?? "" ?>"
                       name="item_name"
                       placeholder="Item Name">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">保存</button>
            </div>
        </div>
    </form>
</div>
