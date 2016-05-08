<?php
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>书香-后台管理</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--    <link type="text/css" href="/js/bootwatch/default/bootstrap.min.css" rel="stylesheet">-->
    <!--    <link type="text/css" href="/js/messenger/css/messenger.css" rel="stylesheet">-->
    <!--    <link type="text/css" href="/js/messenger/css/messenger-theme-future.css" rel="stylesheet">-->
    <!--    <link type="text/css" href="/js/jquerydatatables/css/jquery.dataTables.min.css" rel="stylesheet">-->
    <!--    <link type="text/css" href="/js/jquerydatatables/css/jquery.dataTables_themeroller.min.css" rel="stylesheet">-->
    <!--    <script src="/js/jquery.min.js" type="text/javascript"></script>-->
    <!--    <script src="/js/messenger/js/messenger.min.js" type="text/javascript"></script>-->
    <!--    <script src="/js/jquerydatatables/js/jquery.dataTables.min.js" type="text/javascript"></script>-->
    <!--    <script src="/js/selfDefine.js" type="text/javascript"></script>-->
    <style type="text/css">
        body {
            padding-top: 70px;
            padding-bottom: 40px;
        }
    </style>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- 加载视图文件部分 -->
<?php include("adminMenu.php") ?>
<?php echo $content; ?>
<!--<script src="/js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
