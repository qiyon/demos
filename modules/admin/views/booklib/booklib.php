<?php
$this->registerJsFile('/js/app/admin/booklib/index.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="container">
    <div class="row">
        <button class="btn btn-primary" id="add-book-button">添加书籍</button>
        <div class="pull-right">
            <input class="" id="search-book" type="text" placeholder="书籍名称"/>
            <button class="btn btn-info " id="search-button">查找</button>
        </div>
        <hr>
    </div>
</div>
<div class="container">
    <div class="row">
        <div style="color: #000000">
            <table id="book-table">
                <thead>
                <th>id</th>
                <th>书名</th>
                <th>作者</th>
                <th>出版社</th>
                <th>ISBN</th>
                <th>操作</th>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="theModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                添加书籍
                <span class="label label-info">添加前请先确认书籍是否已存在</span>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="min-height: 250px">
                <label style="min-width: 100px">书名</label>
                <input id="add-bookname" type="text" placeholder="不能为空"/><br>

                <label style="min-width: 100px">作者</label>
                <input id="add-author" type="text" placeholder="用逗号隔开,译者加(译)"/><br>

                <label style="min-width: 100px">出版社</label>
                <input id="add-pub_house" type="text"/><br>

                <label style="min-width: 100px">ISBN</label>
                <input id="add-ISBN" type="text"/><br>

                <label style="min-width: 100px">相关链接</label>
                <input id="add-about_link" type="text" placeholder="链接名=>地址 用逗号隔开"/><br>

                <label style="min-width: 100px">书籍标签</label>
                <input id="add-tags" type="text" placeholder="用逗号隔开"/><br>

                <label style="min-width: 100px">书籍说明</label>
                <textarea id="add-description" style="height: 150px;width: 350px"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-defaulta" data-dismiss="modal">关闭</button>
                <button class="btn btn-primary" id="add-book-handel">确定</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                添加书籍
                <span class="label label-info">修改书籍信息</span>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="min-height: 250px">
                <input type="hidden" id="edit-bookid" value="">
                <label style="min-width: 100px">书名</label>
                <input id="edit-bookname" type="text" placeholder="不能为空"/><br>

                <label style="min-width: 100px">作者</label>
                <input id="edit-author" type="text" placeholder="用逗号隔开,译者加(译)"/><br>

                <label style="min-width: 100px">出版社</label>
                <input id="edit-pub_house" type="text"/><br>

                <label style="min-width: 100px">ISBN</label>
                <input id="edit-ISBN" type="text"/><br>

                <label style="min-width: 100px">相关链接</label>
                <input id="edit-about_link" type="text" placeholder="链接名=>地址 用逗号隔开"/><br>

                <label style="min-width: 100px">书籍标签</label>
                <input id="edit-tags" type="text" placeholder="用逗号隔开"/><br>

                <label style="min-width: 100px">书籍说明</label>
                <textarea id="edit-description" style="height: 150px;width: 350px"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-defaulta" data-dismiss="modal">关闭</button>
                <button class="btn btn-primary" id="edit-book-handel">确定</button>
            </div>
        </div>
    </div>
</div>
