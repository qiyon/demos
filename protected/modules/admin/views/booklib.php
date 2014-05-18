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
                <label style="min-width: 100px"  >书名</label>
                <input id="add-bookname" type="text" placeholder="不能为空"/><br>

                <label style="min-width: 100px" >作者</label>
                <input id="add-author" type="text" placeholder="用逗号隔开,译者加(译)"/><br>

                <label style="min-width: 100px" >出版社</label>
                <input id="add-pub_house" type="text"/><br>

                <label style="min-width: 100px" >ISBN</label>
                <input id="add-ISBN" type="text"/><br>

                <label style="min-width: 100px" >相关链接</label>
                <input id="add-about_link" type="text" placeholder="链接名=>地址 用逗号隔开"/><br>

                <label style="min-width: 100px" >书籍标签</label>
                <input id="add-tags" type="text" placeholder="用逗号隔开"/><br>

                <label style="min-width: 100px" >书籍说明</label>
                <textarea id="add-description" style="height: 150px;width: 350px"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-defaulta" data-dismiss="modal">关闭</button>
                <button class="btn btn-primary" id="add-book-handel">确定</button>
            </div>
        </div>
    </div>
</div>
<script>
    var JDataTable;

    $(document).ready(function(){
        _createTable();


        $("#add-book-button").click(function(){
            $("#theModal").modal("show");
        });

        $("#add-book-handel").click(function(){
            $.ajax({
                type:"post",
                url:"?r=admin/booklib/addbook",
                data:{
                    bookname:$("#add-bookname").val(),
                    author:$("#add-author").val(),
                    pub_house:$("#add-pub_house").val(),
                    ISBN:$("#add-ISBN").val(),
                    about_link:$("#add-about_link").val(),
                    tags:$("#add-tags").val(),
                    description:$("#add-description").val(),
                },
                dataType:"json",
                success:function(json){
                    if(json.code==0){
                        _showMessage("success","添加成功");
                        JDataTable.fnDraw(false);
                        $("#theModal").modal("hide");
                    }else{
                        _showMessage("error",json.message);
                    }
                },
            });
        });

        $("#search-button").click(function(){
            JDataTable.fnDraw();
        });
        $("#search-book").keydown(function(e){
            if(e.keyCode==13){
                $("#search-button").click();
            }
        });


    });

    function _DelBook($bookid){
        if (confirm("确定要删除书籍信息吗？")){
            $.post("?r=admin/booklib/delbook",{bookid:$bookid},function(json){
                if(json.code==0){
                    _showMessage("success","删除成功");
                    JDataTable.fnDraw(false);
                }else{
                    _showMessage("error",json.message);
                }
            },"json");
        }
    }

    function _createTable()
    {
        JDataTable=$("#book-table").dataTable({
            bFilter:false,
            bLengthChange:false,
            bInfo:true,
            bPaginate:true,
            bSort:false,
            iDisplayLength:10,
            bAutoWidth:false,
            sPaginationType:'full_numbers',

            bProcessing:true,
            bServerSide:true,
            sAjaxSource:"?r=admin/booklib/bookTable",
            sServerMethod:"POST",
            fnServerParams:function(aoData){
                aoData.push({
                        "name":"search_book",
                        "value":$("#search-book").val(),
                    },{
                        "name":"sendname2",
                        "value":"sendvalue2",
                    }
                );
            },
            aoColumns:[
                {mData:"id"},
                {mData:"bookname"},
                {mData:"author"},
                {mData:"pub_house"},
                {mData:"ISBN"},
                {mData:"id",mRender:function(data,type,full){
                    return "<button>详细</button> <button>修改</button>"+
                        " <button class='btn btn-xs btn-warning' onclick='_DelBook("+data+");'>删除</button>";
                }},
            ],
            oLanguage: {
                sSearch: "模糊查询:",
                sLengthMenu: "每页显示 _MENU_ 条书籍记录",
                sZeroRecords: "没有记录",
                sInfo: "显示第  _START_ 到第  _END_ 条记录,一共  _TOTAL_ 条记录",
                sInfoEmpty: "显示0条记录",
                sInfoFiltered: "",
                oPaginate: {
                    sFirst:"首页",
                    sPrevious: " 上一页 ",
                    sNext:     " 下一页 ",
                    sLast:     "尾页",
                }
            },
        });
    }

</script>