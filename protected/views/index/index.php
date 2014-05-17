<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=iviUKktVw3l8WRUrjyMGGvaG"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/CurveLine/1.5/src/CurveLine.min.js"></script>

<div class="container">
    <div class="row">
        <a class="btn btn-primary " href="?r=admin/index/index">后台管理</a>
        <hr>
        <input type="text" name="" id="search-donate-id" placeholder="输入二维码上方的ID查询捐助信息"/>
        <button id="donateid-button" class="btn btn-info btn-xs ">查找</button>
        <br>

        <?php if (!empty($Dinfo["id"])) { ?>
        <div class="panel panel-default col-md-4">
            <div class="panel-body">

                <h3><?php echo $Dinfo["bookinfo"]["bookname"];?></h3>
                <label>作者</label> <?php echo $Dinfo["bookinfo"]["author"];?> <br>
                <label>ISBN</label> <?php echo $Dinfo["bookinfo"]["ISBN"];?> <br>
                <label>出版社</label> <?php echo $Dinfo["bookinfo"]["pub_house"];?> <br>
                <label>标签</label> <?php echo $Dinfo["bookinfo"]["tags"];?> <br>
                <label>相关链接</label> <?php echo $Dinfo["bookinfo"]["about_link"];?> <br>
                <dl>
                    <dt>书籍描述</dt>
                    <dd><?php echo $Dinfo["bookinfo"]["description"];?></dd>
                </dl>
                <label>捐助者</label> <?php echo $Dinfo["donorinfo"]["nickname"];?> <br>
                <label>捐赠点</label> <?php echo $Dinfo["agencyinfo"]["name"];?> <br>
                <label>捐助描述</label> <?php echo $Dinfo["description"];?> <br>
                <label>捐助记录</label>
                <div class="well">
                    <?php foreach ($Dinfo["tracks"] as $oneT) { ?>
                        <dl>
                            <dt><?php echo $oneT["information"];?></dt>
                            <dd> --<?php echo $oneT["tracktime"];?></dd>
                        </dl>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div id="baidump"></div>
        </div>
        <?php  } ?>

    </div>
</div>

<script>
    $(document).ready(function(){

        _baiduMP();

        $("#donateid-button").click(function(){
            var donateId=$("#search-donate-id").val();
            window.location="?r=index&donateid="+donateId;
        });

        $("#search-donate-id").keydown(function(e){
            if(e.keyCode==13){
                $("#donateid-button").click();
            }
        });
    });

    function _baiduMP(){
        // 百度地图API功能
        var map = new BMap.Map("baidump");
        map.centerAndZoom(new BMap.Point(118.454, 32.955), 6);
        map.enableScrollWheelZoom();
        var beijingPosition=new BMap.Point(116.432045,39.910683),
            hangzhouPosition=new BMap.Point(120.129721,30.314429),
            taiwanPosition=new BMap.Point(121.491121,25.127053);
        var points = [beijingPosition,hangzhouPosition, taiwanPosition];

        var curve = new BMapLib.CurveLine(points, {strokeColor:"blue", strokeWeight:3, strokeOpacity:0.5}); //创建弧线对象
        map.addOverlay(curve); //添加到地图中
        curve.enableEditing(); //开启编辑功能
    }
</script>


