<?php
use app\models\Donate;
use app\models\BookLib;
use app\models\Agency;

$this->registerJsFile('/js/app/index/index.js', ['depends' => [\app\assets\JqueryAsset::class]]);
?>
<div class="container">
    <div class="row">
        <a class="btn btn-primary " href="/admin">后台管理</a>
        <hr>
        <input type="text" name="" id="search-donate-id" style="width: 300px;" placeholder="输入二维码上方的ID查询捐助信息"/>
        <button id="donateid-button" class="btn btn-info btn-xs ">查找</button>
        <br>
        <?php if (!empty($Dinfo["id"])) { ?>
            <div class="panel panel-default col-md-4 col-sm-6 col-xs-12">
                <div class="panel-body">

                    <h3><?php echo $Dinfo["bookinfo"]["bookname"]; ?></h3>
                    <label>作者</label> <?php echo $Dinfo["bookinfo"]["author"]; ?> <br>
                    <label>ISBN</label> <?php echo $Dinfo["bookinfo"]["ISBN"]; ?> <br>
                    <label>出版社</label> <?php echo $Dinfo["bookinfo"]["pub_house"]; ?> <br>
                    <label>标签</label> <?php echo $Dinfo["bookinfo"]["tags"]; ?> <br>
                    <label>相关链接</label>
                    <ul>
                        <?php
                        $linkinfo = explode(",", $Dinfo["bookinfo"]["about_link"]);
                        foreach ($linkinfo as $onel) {
                            $onelinkarr = explode("=>", $onel);
                            if (isset($onelinkarr[1])) {
                                echo "<li><a target='_blank' href='{$onelinkarr[1]}'>{$onelinkarr[0]}</a></li>";
                            } else {
                                echo "<li><a target='_blank' href='{$onelinkarr[0]}'>相关链接</a></li>";
                            }
                        }
                        ?>
                    </ul>
                    <dl>
                        <dt>书籍描述</dt>
                        <dd><?php echo $Dinfo["bookinfo"]["description"]; ?></dd>
                    </dl>
                    <label>捐助者</label> <?php echo $Dinfo["donorinfo"]["nickname"]; ?> <br>
                    <label>捐赠点</label> <?php echo $Dinfo["agencyinfo"]["name"]; ?> <br>
                    <label>捐助描述</label> <?php echo $Dinfo["description"]; ?> <br>
                    <label>捐助记录</label>
                    <div class="well">
                        <?php foreach ($Dinfo["tracks"] as $oneT) { ?>
                            <dl>
                                <dt><?php echo $oneT["information"]; ?></dt>
                                <dd> --<?php echo $oneT["tracktime"]; ?></dd>
                            </dl>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <?php
                if (!empty($imgsrc)) {
                    echo $imgsrc;
                }
                ?>
            </div>

        <?php } else {
            echo "<br>";
            $doNUm = Donate::find()->count();
            $bNum = BookLib::find()->count();
            $aNum = Agency::find()->count();
            ?>
            <ul class="list-unstyled">当前共有:
                <li><p class="text-primary">捐赠记录 <?php echo $doNUm; ?> 条。</p></li>
                <li><p class="text-success">捐赠管理点 <?php echo $aNum; ?> 个。</p></li>
                <li><p class="text-info">记录信息的书籍 <?php echo $bNum ?> 本。</p></p></li>
            </ul>
            <?php
        } ?>
    </div>
</div>

