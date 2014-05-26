<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $this->title;?></title> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/js/bootwatch/<?php echo $this->theme;?>/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/js/messenger/css/messenger.css" rel="stylesheet">
    <link type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/js/messenger/css/messenger-theme-future.css" rel="stylesheet">
    <link type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/js/jquerydatatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link type="text/css" href="<?php echo Yii::app()->request->baseUrl;?>/js/jquerydatatables/css/jquery.dataTables_themeroller.min.css" rel="stylesheet">
    <script src="<?php echo Yii::app()->request->baseUrl;?>/js/jquery.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl;?>/js/messenger/js/messenger.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->request->baseUrl;?>/js/jquerydatatables/js/jquery.dataTables.min.js" type="text/javascript"></script>

    <script src="<?php echo Yii::app()->request->baseUrl;?>/js/selfDefine.js" type="text/javascript"></script>
    <style type="text/css">
        body{
            padding-top:70px;
            padding-bottom:40px;
        }
    </style>
</head>
<body>
    <!-- 加载视图文件部分 -->
    <?php include("adminMenu.php")?>
    <?php echo $content;?>

    <script src="<?php echo Yii::app()->request->baseUrl;?>/js/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
