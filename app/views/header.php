<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title ?? "标题" ?></title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Mxc的框架</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <form class="navbar-form navbar-right" method="get">
                <div class="form-group">
                    <input type="text" placeholder="搜索内容" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">搜索</button>
            </form>
            <ul class="nav navbar-nav">
                <li class="<?php echo $_SERVER['REQUEST_URI'] == "/home/create" ? "active" : "" ?>"><a
                            href="/home/create">新增</a></li>
            </ul>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</nav>
<div class="container" style="padding-top: 60px;">