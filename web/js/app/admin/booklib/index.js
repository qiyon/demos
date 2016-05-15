var JDataTable;
$(document).ready(function () {
  _createTable();

  $("#add-book-button").click(function () {
    $("#theModal").modal("show");
  });
  $("#add-book-handel").click(function () {
    $.ajax({
      type: "post",
      url: "/admin/booklib/addbook",
      data: {
        bookname: $("#add-bookname").val(),
        author: $("#add-author").val(),
        pub_house: $("#add-pub_house").val(),
        ISBN: $("#add-ISBN").val(),
        about_link: $("#add-about_link").val(),
        tags: $("#add-tags").val(),
        description: $("#add-description").val(),
        _csrf: yii.getCsrfToken()
      },
      dataType: "json",
      success: function (json) {
        if (json.code == 0) {
          _showMessage("success", "添加成功");
          JDataTable.fnDraw(false);
          $("#theModal").modal("hide");
        } else {
          _showMessage("error", json.message);
        }
      }
    });
  });

  $("#search-button").click(function () {
    JDataTable.fnDraw();
  });
  $("#search-book").keydown(function (e) {
    if (e.keyCode == 13) {
      $("#search-button").click();
    }
  });


  $("#edit-book-handel").click(function () {
    $.post("/admin/booklib/edit", {
      bookid: $("#edit-bookid").val(),
      bookname: $("#edit-bookname").val(),
      author: $("#edit-author").val(),
      pub_house: $("#edit-pub_house").val(),
      ISBN: $("#edit-ISBN").val(),
      about_link: $("#edit-about_link").val(),
      tags: $("#edit-tags").val(),
      description: $("#edit-description").val(),
      _csrf: yii.getCsrfToken()
    }, function (json) {
      if (json.code == 0) {
        _showMessage("success", "修改成功");
        $("#editModal").modal("hide");
        JDataTable.fnDraw(false);
      } else {
        _showMessage("error", json.message);
      }
    }, "json");
  });
});


function _editBook(bookid) {
  $.get("/admin/booklib/getinfobyid", {bookid: bookid}, function (json) {
    $("#edit-bookid").val(json.id);
    $("#edit-bookname").val(json.bookname);
    $("#edit-author").val(json.author);
    $("#edit-ISBN").val(json.ISBN);
    $("#edit-pub_house").val(json.pub_house);
    $("#edit-about_link").val(json.about_link);
    $("#edit-description").val(json.description);
    $("#edit-tags").val(json.tags);
    $("#editModal").modal("show");
  }, "json");
}

function _DelBook($bookid) {
  if (confirm("确定要删除书籍信息吗？")) {
    $.post("/admin/booklib/delbook", {bookid: $bookid, _csrf: yii.getCsrfToken()}, function (json) {
      if (json.code == 0) {
        _showMessage("success", "删除成功");
        JDataTable.fnDraw(false);
      } else {
        _showMessage("error", json.message);
      }
    }, "json");
  }
}

function _createTable() {
  JDataTable = $("#book-table").dataTable({
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
    sAjaxSource: "/admin/booklib/booktable",
    sServerMethod: "GET",
    fnServerParams: function (aoData) {
      aoData.push({
          "name": "search_book",
          "value": $("#search-book").val()
        }, {
          "name": "sendname2",
          "value": "sendvalue2"
        }
      );
    },
    aoColumns: [
      {mData: "id"},
      {mData: "bookname"},
      {mData: "author"},
      {mData: "pub_house"},
      {mData: "ISBN"},
      {
        mData: "id", mRender: function (data, type, full) {
        return "<button class='btn btn-xs btn-info' onclick='_editBook(" + data + ");'>修改</button>" +
          " <button class='btn btn-xs btn-warning' onclick='_DelBook(" + data + ");'>删除</button>";
      }
      }
    ],
    oLanguage: {
      sSearch: "模糊查询:",
      sLengthMenu: "每页显示 _MENU_ 条书籍记录",
      sZeroRecords: "没有记录",
      sInfo: "显示第  _START_ 到第  _END_ 条记录,一共  _TOTAL_ 条记录",
      sInfoEmpty: "显示0条记录",
      sInfoFiltered: "",
      oPaginate: {
        sFirst: "首页",
        sPrevious: " 上一页 ",
        sNext: " 下一页 ",
        sLast: "尾页"
      }
    }
  });
}
