<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <a class="navbar-brand" href="?r=admin/index/index">书香-管理</a>
            </div>
            <div class="collapse navbar-collapse" id="layout-menu">
                <ul class="nav navbar-nav navbar-right">
                    <li><a ><?php echo Yii::app()->user->getNickname();?></a></li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">主题<b class="caret"></b></a>
                        <ul class="dropdown-menu themes">
                            <?php
                                foreach ($this->themeArray as $sgTheme){
                                    echo "<li><a href='' sx-theme='{$sgTheme}'>{$sgTheme}";
                                    if ($sgTheme==$this->theme) echo "  √";
                                    echo "</a></li>";
                                }
                            ?>
                        </ul>
                    </li>
                    <li>
                        <a href="?r=admin/index/logout">退出</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<input id="themes" type="hidden" value="<?php echo $this->theme;?>">
<script>
    $("[sx-theme]").click(function(){
        var theTheme=$(this).attr("sx-theme");
        $.post("?r=admin/index/setTheme",{theme:theTheme},function(res){
            location.reload();
        });
        return false;
    });
</script>
