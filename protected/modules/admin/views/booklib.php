<div class="container">
    <div class="row">
        <button class="btn btn-primary" id="add-book-button">添加书籍</button>
    </div>
</div>
<div class="modal fade" id="theModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                添加书籍
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <label class="col-sm-2 " >书名</label>
                        <div class="col-sm-10"><input id="add-bookname" type="text"/></div>
                        <label class="col-sm-2 " >作者</label>
                        <div class="col-sm-10"><input id="add-author" type="text"/></div>
                        <label class="col-sm-2 " >出版社</label>
                        <div class="col-sm-10"><input id="add-pub_house" type="text"/></div>
                        <label class="col-sm-2 " >ISBN</label>
                        <div class="col-sm-10"><input id="add-ISBN" type="text"/></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-defaulta" data-dismiss="modal">关闭</button>
                <button class="btn btn-primary" id="add-book-handel">确定</button>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function(){
        $("#add-book-button").click(function(){
            $("#theModal").modal("show");
        });

        $("#add-book-handel").click(function(){
            $.ajax({
                type:"post",
                url:"?r=admin/booklib/addbook",

            });
            $("#theModal").modal("hide");
        });
    });

</script>