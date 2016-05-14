<?php
use app\assets\AppAsset;

AppAsset::register($this);
//messenger
$this->registerCssFile('/js/lib/messenger/css/messenger.css');
$this->registerCssFile('/js/lib/messenger/css/messenger-theme-future.css');
$this->registerJsFile('/js/lib/messenger/js/messenger.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//dataTable
$this->registerCssFile('/js/lib/jquerydatatables/css/jquery.dataTables.min.css');
$this->registerCssFile('/js/lib/jquerydatatables/css/jquery.dataTables_themeroller.min.css');
$this->registerJsFile('/js/lib/jquerydatatables/js/jquery.dataTables.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//util
$this->registerJsFile('/js/app/Util.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
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
