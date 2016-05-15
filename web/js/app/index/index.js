$(document).ready(function () {
  $("#donateid-button").click(function () {
    var donateId = $("#search-donate-id").val();
    window.location = "/?donateid=" + donateId;
  });
  $("#search-donate-id").keydown(function (e) {
    if (e.keyCode == 13) {
      $("#donateid-button").click();
    }
  });
});
