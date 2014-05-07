/**
 * Created by heqiyon on 5/7/14.
 */
function _showMessage(type,message){
    $.globalMessenger().post({
        message:message,
        type:type,
        showCloseButton: true,
        scrollTo: true
    });
}
