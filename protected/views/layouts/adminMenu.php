<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <a class="navbar-brand">书香-管理</a>
            </div>
            <div class="collapse navbar-collapse" id="layout-menu">
                <ul class="nav navbar-nav navbar-right">
                    <li><a ><?php echo Yii::app()->user->getusername();?></a></li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown">主题<b class="caret"></b></a>
                        <ul class="dropdown-menu themes">
                            <li><a href="#" data-theme-name="amelia">Amelia</a></li>
                            <li><a href="#" data-theme-name="cerulean">Cerulean</a></li>
                            <li><a href="#" data-theme-name="cosmo">Cosmo</a></li>
                            <li><a href="#" data-theme-name="custom">Custom</a></li>
                            <li><a href="#" data-theme-name="cyborg">Cyborg</a></li>
                            <li><a href="#" data-theme-name="darkly">Darkly</a></li>
                            <li><a href="#" data-theme-name="flatly">Flatly</a></li>
                            <li><a href="#" data-theme-name="journal">Journal</a></li>
                            <li><a href="#" data-theme-name="lumen">Lumen</a></li>
                            <li><a href="#" data-theme-name="readable">Readable</a></li>
                            <li><a href="#" data-theme-name="shamrock">Shamrock</a></li>
                            <li><a href="#" data-theme-name="simplex">Simplex</a></li>
                            <li><a href="#" data-theme-name="slate">Slate</a></li>
                            <li><a href="#" data-theme-name="spacelab">Spacelab</a></li>
                            <li><a href="#" data-theme-name="superhero">Superhero</a></li>
                            <li><a href="#" data-theme-name="united">United</a></li>
                            <li><a href="#" data-theme-name="yeti">Yeti</a></li>
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
