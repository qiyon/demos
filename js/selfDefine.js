/**
 * Created by heqiyon on 5/7/14.
 */

/**
 * 调用js插件 messenger 显示操作消息
 * @param type
 * @param message
 * @private
 */
function _showMessage(type,message){
    $.globalMessenger().post({
        message:message,
        type:type,
        showCloseButton: true,
        scrollTo: true
    });
}
