function _addAgency() {
  if (!confirm("确认添加新的捐赠点？")) {
    return false;
  }

  var agencyname = $("#add-agency-name").val();
  if (agencyname != "") {
    $.post("/admin/agency/add", {
      name: $("#add-agency-name").val(),
      person: $("#add-agency-person").val(),
      address: $("#add-agency-address").val(),
      telephone: $("#add-agency-telephone").val(),
      worktime: $("#add-agency-worktime").val(),
      coordinate: $("#add-agency-coordinate").val(),
      description: $("#add-agency-description").val(),
      _csrf: yii.getCsrfToken()
    }, function (json) {
      if (json.code == 0) {
        location.reload();
      } else {
        _showMessage("error", json.message);
      }
    }, "json");
  } else {
    _showMessage("error", "名称不能为空");
  }
}

function _delAgency(id) {
  if (confirm("确定要删除捐赠点?")) {
    $.post("/admin/agency/delete", {
      agencyid: id,
      _csrf: yii.getCsrfToken()
    }, function (json) {
      if (json.code == 0) {
        location.reload();
      } else {
        _showMessage("error", json.message);
      }
    }, "json");
  }
}

function _editAgency(agencyid) {
  $.post("/admin/agency/getinfo", {agencyid: agencyid, _csrf: yii.getCsrfToken()}, function (json) {
    if (json.code == 0) {
      $("#edit-agency-id").val(json.info.id);
      $("#edit-agency-name").val(json.info.name);
      $("#edit-agency-person").val(json.info.person);
      $("#edit-agency-address").val(json.info.address);
      $("#edit-agency-telephone").val(json.info.telephone);
      $("#edit-agency-worktime").val(json.info.worktime);
      $("#edit-agency-coordinate").val(json.info.coordinate);
      $("#edit-agency-description").val(json.info.description);

      $("#editModal").modal("show");
    } else {
      _showMessage("error", json.message);
    }
  }, "json");
}

$("#edit-handle").click(function () {
  $.post("/admin/agency/edit", {
    agencyid: $("#edit-agency-id").val(),
    name: $("#edit-agency-name").val(),
    person: $("#edit-agency-person").val(),
    address: $("#edit-agency-address").val(),
    telephone: $("#edit-agency-telephone").val(),
    worktime: $("#edit-agency-worktime").val(),
    coordinate: $("#edit-agency-coordinate").val(),
    description: $("#edit-agency-description").val(),
    _csrf: yii.getCsrfToken()
  }, function (json) {
    if (json.code == 0) {
      location.reload();
    } else {
      _showMessage("error", json.message);
    }
  }, "json");
});
