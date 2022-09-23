<?php

\app\assets\AppAsset::register($this);

//util
$this->registerJsFile('/js/app/Util.js', ['depends' => [
    \app\assets\JqueryAsset::class,
    \app\assets\lib\JqueryDataTablesAsset::class,
    \app\assets\lib\MessengerAsset::class,
]]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>书香-后台管理</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo \yii\helpers\Html::csrfMetaTags(); ?>
    <!--    <link type="text/css" href="/js/bootwatch/default/bootstrap.min.css" rel="stylesheet">-->
    <!--    <script src="/js/jquery.min.js" type="text/javascript"></script>-->
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
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
