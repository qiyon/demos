<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="margin-top: 150px">
            <form class="form-horizontal" role="form" method="post">
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">用户名</label>
                    <div class="col-sm-10">
                        <input class="form-control" name="username" id="username" placeholder="输入用户名">
                    </div>
                </div>
                <div class="form-group">
                    <label for="passwd" class="col-sm-2 control-label">密码</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="passwd" id="passwd" placeholder="输入密码">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" value="1"> 保持登陆 <span
                                    class="label label-info">一周</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">登陆</button>
                    </div>
                </div>
                <?php if ((!empty($errortype)) && (!empty($message))) : ?>
                    <div class="col-md-10 col-md-offset-2">
                        <p class="text-<?php echo $errortype; ?>"><?php echo $message; ?></p>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

