<?php
$this->registerJsFile('/js/app/admin/donate/index.js', ['depends' => [\app\assets\JqueryAsset::class]]);
?>
<div class="container">
    <div class="row">
        <button class="btn btn-primary" id="add-donate">捐助</button>
        <hr>
    </div>
</div>
<div class="container">
    <div class="row">
        <div style="color: #000000">
            <table id="donate-table">
                <thead>
                <th>id</th>
                <th>捐助书名</th>
                <th>捐助者</th>
                <th>受赠点</th>
                <th>捐助时间</th>
                <th>操作</th>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                添加捐助信息
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <label style="min-width: 100px">书籍信息</label>
                <button class="btn btn-sm btn-primary" id="book-choose-button">选择书籍</button>
                <a class="btn btn-sm btn-info" target="_blank" href="?r=admin/booklib/index">书籍管理</a>
                <br>
                <div id="book-info-div">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <input type="hidden" id="do-book-id" value="-1"/>
                            <label>书名:</label>
                            <label id="do-book-bookname"></label><br/>
                            <label>作者:</label>
                            <label id="do-book-author"></label><br/>
                            <label>ISBN:</label>
                            <label id="do-book-ISBN"></label>
                        </div>
                    </div>
                </div>
                <div id="book-choose-div">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <input id="search-bookname" type="text" value="" placeholder="书籍名称"/>
                            <button class="btn btn-xs btn-info" onclick="$('#book-choose-button').click();">搜索书籍
                            </button>
                            <table class="table table-condensed">
                                <tbody id="book-list-tbody">
                                </tbody>
                            </table>
                            <button class="btn btn-xs btn-warning pull-right" onclick="show_info();">取消</button>
                        </div>
                    </div>
                </div>
                <label style="min-width: 100px">捐助者邮箱</label><input id="dornor-email" type="text"/><br>
                <label style="min-width: 100px">受赠点</label>
                <select id="acc-agency">
                    <option value="-1">选择受赠点</option>
                    <?php
                    foreach ($agencyAll as $oneAgency) {
                        echo "<option value='{$oneAgency->id}'>{$oneAgency->name}</option>>";
                    }
                    ?>
                </select>
                <br>
                <label style="min-width: 100px">捐助描述</label>
                <textarea id="do-description" style="height: 150px;width: 350px"> </textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-defaulta" data-dismiss="modal">关闭</button>
                <button class="btn btn-primary" id="add-donate-handel">确定</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addtrack">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                添加追踪信息
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="track-modal-body"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-defaulta" data-dismiss="modal">关闭</button>
                <button class="btn btn-primary" id="add-donate-track">确定</button>
            </div>
        </div>
    </div>
</div>

