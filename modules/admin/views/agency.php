<div class="container">
    <div class="row">
        <!--列出所有的捐赠点信息 -->
        <?php foreach ($agencys as $oneagen) { ?>
        <div class="panel panel-default col-md-4" style="height: 250px">
            <button class="btn btn-xs btn-warning pull-right" onclick="_delAgency(<?php echo $oneagen->id;?>);">删除</button>
            <button class="btn btn-xs btn-info pull-right" onclick="_editAgency(<?php echo $oneagen->id;?>);">编辑</button>
            <h4><?php echo $oneagen->name;?></h4>
            <label for="">联系人： <?php echo $oneagen->person;?></label><br/>
            <label for="">联系地址： <?php echo $oneagen->address;?></label><br/>
            <label for="">联系电话： <?php echo $oneagen->telephone;?></label><br/>
            <label for="">工作时间： <?php echo $oneagen->worktime;?></label><br/>
            <label for="">捐赠点描述： <?php echo $oneagen->description;?></label><br/>
            <label for="">地理坐标： <?php echo $oneagen->coordinate;?> (纬度,经度)</label><br/>
        </div>
        <?php } ?>

        <!--添加捐赠点-->
        <div class="panel panel-default col-md-4" style="height: 250px">
            <label style="width: 100px">名称</label> <input type="text" id="add-agency-name"><br>
            <label style="width: 100px">联系人</label> <input type="text" id="add-agency-person"><br>
            <label style="width: 100px">联系地址</label> <input type="text" id="add-agency-address"><br>
            <label style="width: 100px">联系电话</label> <input type="text" id="add-agency-telephone"><br>
            <label style="width: 100px">工作时间</label> <input type="text" id="add-agency-worktime"><br>
            <label style="width: 100px"><small>（纬度,精度）</small></label> <input type="text" id="add-agency-coordinate"><br>
            <label style="width: 100px">描述</label> <input type="text" id="add-agency-description"><br>
            <label style="width: 100px"></label> <button class="btn btn-success btn-sm" onclick="_addAgency();">添加新捐赠点</button>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                修改捐助点信息
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div id="edit-modal-body">
                    <input type="hidden" id="edit-agency-id" value="">
                    <label style="width: 200px">名称</label> <input type="text" id="edit-agency-name"><br>
                    <label style="width: 200px">联系人</label> <input type="text" id="edit-agency-person"><br>
                    <label style="width: 200px">联系地址</label> <input type="text" id="edit-agency-address"><br>
                    <label style="width: 200px">联系电话</label> <input type="text" id="edit-agency-telephone"><br>
                    <label style="width: 200px">工作时间</label> <input type="text" id="edit-agency-worktime"><br>
                    <label style="width: 200px">地理坐标（纬度,精度）</label> <input type="text" id="edit-agency-coordinate"><br>
                    <label style="width: 200px">描述</label> <input type="text" id="edit-agency-description"><br>

                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-defaulta" data-dismiss="modal">关闭</button>
                <button class="btn btn-primary" id="edit-handle">确定</button>
            </div>
        </div>
    </div>
</div>
<script>

    function _addAgency(){

        if (!confirm("确认添加新的捐赠点？")){
            return false;
        }

        var agencyname=$("#add-agency-name").val();
        if (agencyname!=""){
            $.post("?r=admin/agency/add",{
                name:$("#add-agency-name").val(),
                person:$("#add-agency-person").val(),
                address:$("#add-agency-address").val(),
                telephone:$("#add-agency-telephone").val(),
                worktime:$("#add-agency-worktime").val(),
                coordinate:$("#add-agency-coordinate").val(),
                description:$("#add-agency-description").val()
            },function(json){
                if (json.code==0){
                    location.reload();
                }else{
                    _showMessage("error",json.message);
                }
            },"json");
        }else{
            _showMessage("error","名称不能为空");
        }
    }

    function _delAgency(id){
        if (confirm("确定要删除捐赠点?")){
            $.post("?r=admin/agency/delete",{
                agencyid:id
            },function(json){
                if (json.code==0){
                    location.reload();
                }else{
                    _showMessage("error",json.message);
                }
            },"json");
        }
    }

    function _editAgency(agencyid){
        $.post("?r=admin/agency/getinfo",{agencyid:agencyid},function(json){
            if(json.code==0){
                $("#edit-agency-id").val(json.info.id);
                $("#edit-agency-name").val(json.info.name);
                $("#edit-agency-person").val(json.info.person);
                $("#edit-agency-address").val(json.info.address);
                $("#edit-agency-telephone").val(json.info.telephone);
                $("#edit-agency-worktime").val(json.info.worktime);
                $("#edit-agency-coordinate").val(json.info.coordinate);
                $("#edit-agency-description").val(json.info.description);

                $("#editModal").modal("show");
            }else{
                _showMessage("error",json.message);
            }
         },"json");
    }

    $("#edit-handle").click(function(){
        $.post("?r=admin/agency/edit",{
                agencyid:$("#edit-agency-id").val(),
                name:$("#edit-agency-name").val(),
                person:$("#edit-agency-person").val(),
                address:$("#edit-agency-address").val(),
                telephone:$("#edit-agency-telephone").val(),
                worktime:$("#edit-agency-worktime").val(),
                coordinate:$("#edit-agency-coordinate").val(),
                description:$("#edit-agency-description").val()
        },function(json){
            if (json.code==0){
                location.reload();
            }else{
                _showMessage("error",json.message);
            }
        },"json");
    });
</script>