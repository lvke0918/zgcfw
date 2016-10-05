/**
 *  定义常量
 */
//验证非0整数
var INT_REG_F = /^[1-9][0-9]*$/;
var INT_REG = /^[0-9]*$/;
var FLOAT_REG = /^[0-9.]*$/;
var CHART_NUMBER = /^[0-9a-zA-Z]*$/;
var MOBILE_REG = /^1[3|4|5|7|8][0-9]{9}$/;
var EMAIL_REG = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

//获取radio的值

function getRadioValue(n) {
    var r = document.getElementsByName(n);
    var v = '';
    for (var i = 0; i < r.length; i++) {
        if (r[i].checked === true) {
            v = r[i].value;
        }
    }
    return v;
}
//radio赋值

function setRadioValue(n, val) {
    var r = document.getElementsByName(n);
    var v = '';
    for (var i = 0; i < r.length; i++) {
        if (r[i].value === val) {
            r[i].checked = true;
        }
    }
}

//以3位分隔添加,

function formatNum(strNum) {
    if (strNum.length <= 3) {
        return strNum;
    }
    if (!/^(\+|-)?(\d+)(\.\d+)?$/.test(strNum)) {
        return strNum;
    }
    var a = RegExp.$1,
        b = RegExp.$2,
        c = RegExp.$3;
    var re = new RegExp();
    re.compile("(\\d)(\\d{3})(,|$)");
    while (re.test(b)) {
        b = b.replace(re, "$1,$2$3");
    }
    return a + "" + b + "" + c;
}

/*字符串长度*/
function sb_strlen(str) {
    var i = 0;
    var c = 0.0;
    var unicode = 0;
    var len = 0;
    if (str === null || str === "") {
        return 0;
    }
    len = str.length;
    for (i = 0; i < len; i++) {
        unicode = str.charCodeAt(i);
        if (unicode < 127) {
            c += 1;
        } else { //chinese
            c += 2;
        }
    }
    return c;
}

/*分割字符串*/
function sb_substr(str, endp, hasDot) {
    var i = 0,
        c = 0,
        unicode = 0,
        rstr = '';
    var len = str.length;
    var sblen = sb_strlen(str);

    if (endp < 1) {
        endp = sblen + endp; // - ((str.charCodeAt(len-1) < 127) ? 1 : 2);
    }
    // 开始取
    for (i = i; i < len; i++) {
        var unicode = str.charCodeAt(i);
        if (unicode < 127) {
            c += 1;
        } else {
            c += 2;
        }
        rstr += str.charAt(i);
        if (c >= endp) {
            break;
        }
    }
    if (hasDot && sblen > endp) {
        rstr += '...';
    }
    return rstr;
}