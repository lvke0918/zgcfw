/**
 * My module:
 *  检测mobile并跳转
 */
var path = window.location.pathname;
if (device.mobile() && path.indexOf("/m") === -1) {
     if (path == "/") {
        path = "";
    }
    document.location = '/m' + path;
}