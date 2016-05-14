<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <a class="navbar-brand" href="/admin">书香-管理</a>
            </div>

            <div class="collapse navbar-collapse" id="layout-menu">

                <ul class="nav navbar-nav">
                    <li><a href="/admin/booklib">书库</a></li>
                    <li><a href="/admin/donate">捐助</a></li>
                    <li><a href="/admin/agency">捐赠点</a></li>
                    <li><a href="/index">前台</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a><?php echo Yii::$app->user->identity ? Yii::$app->user->identity->username : 'Guest'; ?></a>
                    </li>
                    <li>
                        <a href="/admin/index/logout">退出</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

