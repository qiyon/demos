function _showMessage(type, message) {
  $.globalMessenger().post({
    message: message,
    type: type,
    showCloseButton: true,
    scrollTo: true
  });
}