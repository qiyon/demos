<?php
\app\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="en">
<head>
    <title>捐助查询</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo \yii\helpers\Html::csrfMetaTags(); ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php echo $content; ?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
