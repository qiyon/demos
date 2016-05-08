<?php
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="en">
<head>
    <title>捐助查询</title>
    <meta charset="UTF-8">
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
    <!--    <script src="/js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php echo $content; ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
