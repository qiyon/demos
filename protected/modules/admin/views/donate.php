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
                            <label >书名:</label>
                            <label id="do-book-bookname"></label><br/>
                            <label >作者:</label>
                            <label id="do-book-author"></label><br/>
                            <label >ISBN:</label>
                            <label id="do-book-ISBN"></label>
                        </div>
                    </div>
                </div>
                <div id="book-choose-div" >
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <input id="search-bookname" type="text" value="" placeholder="书籍名称"/>
                            <button class="btn btn-xs btn-info" onclick="$('#book-choose-button').click();">搜索书籍</button>
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
                <select id="acc-agency" >
                    <option  value="-1">选择受赠点</option>
                    <?php
                    foreach($agencyAll as $oneAgency){
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

<script>
    var jqTable;

    _createtable();

    $("#add-donate-handel").click(function(){
        var do_book_id=$('#do-book-id').val();
        var do_dornor_email=$('#dornor-email').val();
        var do_acc_agency=$('#acc-agency').val();
        var do_description=$('#do-description').val();

        if((do_book_id==-1)||(do_acc_agency==-1)){
            _showMessage('error','请选择书籍和受赠点');
            return;
        }
        $.post('?r=admin/donate/adddonate',{
            bookid:do_book_id,
            dornoremail:do_dornor_email,
            agencyid:do_acc_agency,
            description:do_description,
        },function(json){
            if (json.code==0){
                _showMessage('success','添加成功');
                jqTable.fnDraw(false);
                $("#addModal").modal('hide');
            }else{
                _showMessage('error',json.message);
            }
        },"json");
    });

    $("#add-donate").click(function(){
        $("#book-info-div").show();
        $("#book-choose-div").hide();
        $("#addModal").modal("show");
    });

    $("#book-choose-button").click(function(){
        $.post("?r=admin/booklib/getlist",{
            search:$("#search-bookname").val(),
            offet:0,
            limit:5,
        },function(json){
            if(json.code==0){
                var tbodyOBJ=$("#book-list-tbody");
                tbodyOBJ.empty();
                $.each(json.data,function(index,value){
                    tbodyOBJ.append("<tr><td>"+value.bookname+"</td><td>"+value.author+"</td><td>"+value.ISBN+"</td><td><button class='btn btn-xs btn-success' onclick=\"_chooseBook("+value.id+",'"+value.bookname+"','"+value.author+"','"+value.ISBN+"');\">选择</button></td></tr>");
                });

            }else{
                _showMessage('error',json.message);
            }
        },"json");
        $("#book-info-div").hide();
        $("#book-choose-div").show();
    });

    function _chooseBook(bookid,bookname,author,ISBN){
        $("#do-book-id").val(bookid);
        $("#do-book-bookname").text(bookname);
        $("#do-book-author").text(author);
        $("#do-book-ISBN").text(ISBN);
        $("#book-info-div").show();
        $("#book-choose-div").hide();
    }

    function show_info(){
        $("#book-info-div").show();
        $("#book-choose-div").hide();
    }


    function _createtable()
    {
        jqTable=$('#donate-table').dataTable({
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
            sAjaxSource:"?r=admin/donate/gettable",
            sServerMethod:"POST",
            fnServerParams:function(aoData){
                aoData.push({
                        "name":"search",
                        "value":"",
                    },{
                        "name":"sendname2",
                        "value":"sendvalue2",
                    }
                );
            },
            aoColumns:[
                {mData:"id"},
                {mData:"bookname"},
                {mData:"dornorname"},
                {mData:"agencyname"},
                {mData:"donatetime"},
                {mData:"id",mRender:function(data,type,full){
                    return "<button>btn</button>";
                }},
            ],
            oLanguage: {
                sSearch: "模糊查询:",
                sLengthMenu: "每页显示 _MENU_ 条捐助记录",
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
            }
        });
    }

</script>