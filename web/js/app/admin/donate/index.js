var jqTable;
$(function () {
  _createtable();

  $("#add-donate-handel").click(function () {
    var do_book_id = $('#do-book-id').val();
    var do_dornor_email = $('#dornor-email').val();
    var do_acc_agency = $('#acc-agency').val();
    var do_description = $('#do-description').val();

    if ((do_book_id == -1) || (do_acc_agency == -1)) {
      _showMessage('error', '请选择书籍和受赠点');
      return;
    }
    $.post('/admin/donate/adddonate', {
      bookid: do_book_id,
      donoremail: do_dornor_email,
      agencyid: do_acc_agency,
      description: do_description,
      _csrf: yii.getCsrfToken()
    }, function (json) {
      if (json.code == 0) {
        _showMessage('success', '添加成功');
        jqTable.fnDraw(false);
        $("#addModal").modal('hide');
      } else {
        _showMessage('error', json.message);
      }
    }, "json");
  });

  $("#add-donate").click(function () {
    $("#book-info-div").show();
    $("#book-choose-div").hide();
    $("#addModal").modal("show");
  });

  $("#book-choose-button").click(function () {
    $.post("/admin/booklib/getlist", {
      search: $("#search-bookname").val(),
      offet: 0,
      limit: 5,
      _csrf: yii.getCsrfToken()
    }, function (json) {
      if (json.code == 0) {
        var tbodyOBJ = $("#book-list-tbody");
        tbodyOBJ.empty();
        $.each(json.data, function (index, value) {
          tbodyOBJ.append("<tr><td>" + value.bookname + "</td><td>" + value.author + "</td><td>" + value.ISBN + "</td><td><button class='btn btn-xs btn-success' onclick=\"_chooseBook(" + value.id + ",'" + value.bookname + "','" + value.author + "','" + value.ISBN + "');\">选择</button></td></tr>");
        });

      } else {
        _showMessage('error', json.message);
      }
    }, "json");
    $("#book-info-div").hide();
    $("#book-choose-div").show();
  });
});

function _chooseBook(bookid, bookname, author, ISBN) {
  $("#do-book-id").val(bookid);
  $("#do-book-bookname").text(bookname);
  $("#do-book-author").text(author);
  $("#do-book-ISBN").text(ISBN);
  $("#book-info-div").show();
  $("#book-choose-div").hide();
}

function show_info() {
  $("#book-info-div").show();
  $("#book-choose-div").hide();
}

function _add_track(donateId) {
  $("#addtrack").modal("show");
  var donate_tarck_body = $("#track-modal-body");
  donate_tarck_body.empty();
  donate_tarck_body.append("<input type='hidden' id='track-to-donate-id' value='" + donateId + "' >");
  donate_tarck_body.append("<label>信息</label> <input type='text' id='track-infom' > <br>");
  donate_tarck_body.append("<label>经度</label> <input type='text' id='track-longi' > <br>");
  donate_tarck_body.append("<label>纬度</label> <input type='text' id='track-lati' > <br>");
}

$("#add-donate-track").click(function () {
  var trackInfo = $("#track-infom").val();
  if (trackInfo == null || trackInfo == "") {
    _showMessage("error", "追踪信息不能为空");
    return false;
  }

  $.post("/admin/donate/addtrack", {
    donateid: $("#track-to-donate-id").val(),
    information: $("#track-infom").val(),
    lati: $("#track-lati").val(),
    longi: $("#track-longi").val(),
    _csrf: yii.getCsrfToken()
  }, function (json) {
    if (json.code == 0) {
      _showMessage("success", "添加成功");
      $("#addtrack").modal("hide");
    } else {
      _showMessage("error", json.message);
    }
  }, "json");

});

function _donateDel(donateId) {
  if (confirm("确定删除?")) {
    $.post("/admin/donate/deldonate", {donateid: donateId, _csrf: yii.getCsrfToken()}, function (json) {
      if (json.code == 0) {
        _showMessage("success", "删除成功");
        jqTable.fnDraw(false);
      } else {
        _showMessage("error", json.message);
      }
    }, "json");
  }
}

function _createtable() {
  jqTable = $('#donate-table').dataTable({
    bFilter: false,
    bLengthChange: false,
    bInfo: true,
    bPaginate: true,
    bSort: false,
    iDisplayLength: 10,
    bAutoWidth: false,
    sPaginationType: 'full_numbers',

    bProcessing: true,
    bServerSide: true,
    sAjaxSource: "/admin/donate/gettable",
    sServerMethod: "POST",
    fnServerParams: function (aoData) {
      aoData.push({
          "name": "search",
          "value": "",
        }, {
          "name": "sendname2",
          "value": "sendvalue2",
        }, {
          "name": "_csrf",
          "value": yii.getCsrfToken()
        }
      )
      ;
    },
    aoColumns: [
      {mData: "id"},
      {mData: "bookname"},
      {mData: "donorname"},
      {mData: "agencyname"},
      {mData: "donatetime"},
      {
        mData: "id", mRender: function (data, type, full) {
        return "<a target='_blank' href='/?donateid=" + data + "' class='btn btn-info btn-xs'>查看详细</a>"
          + " <button class='btn btn-success btn-xs' onclick='_add_track(" + data + ");' >添加追踪</button>"
          + " <button class='btn btn-warning btn-xs' onclick='_donateDel(" + data + ");'>删除</button> ";
      }
      },
    ],
    oLanguage: {
      sSearch: "模糊查询:",
      sLengthMenu: "每页显示 _MENU_ 条捐助记录",
      sZeroRecords: "没有记录",
      sInfo: "显示第  _START_ 到第  _END_ 条记录,一共  _TOTAL_ 条记录",
      sInfoEmpty: "显示0条记录",
      sInfoFiltered: "",
      oPaginate: {
        sFirst: "首页",
        sPrevious: " 上一页 ",
        sNext: " 下一页 ",
        sLast: "尾页",
      }
    }
  });
}

