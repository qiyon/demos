<div class="container">
    <div class="row">
        <?php foreach ($agencys as $oneagen) { ?>
        <div class="panel panel-default col-md-4">
            <button class="btn btn-xs btn-info pull-right">编辑</button>
            <h4><?php echo $oneagen->name;?></h4>
            <label for="">联系人： <?php echo $oneagen->person;?></label><br/>
            <label for="">联系地址： <?php echo $oneagen->address;?></label><br/>
            <label for="">联系电话： <?php echo $oneagen->telephone;?></label><br/>
            <label for="">工作时间： <?php echo $oneagen->worktime;?></label><br/>
            <label for="">捐赠点描述： <?php echo $oneagen->description;?></label><br/>
            <label for="">地理坐标： <?php echo $oneagen->coordinate;?> (纬度,经度)</label><br/>
        </div>
        <?php } ?>

    </div>
</div>