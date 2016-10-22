/**
 * 没有标题和cancel按钮的提示框，用于手机端
 */
X.sub("init", function() {
    /**
     * type:
     *   0, 默认状态
     *   1, modal状态，显示并关闭
     *
     */
    //var overlay = X('dialog_overlay');

    //if (!overlay) {
    overlay = document.createElement('div');
    overlay.id = 'dialog_overlay';
    document.body.appendChild(overlay);
    //}

    var callback = null;
    var validator = null;
    var vfunction = null;
    var vt = 0;
    var enable = true;
    var default_okText = "确定";
    var default_cancel = "取消";

    //overlay.style.display = 'none';
    overlay.style.visibility= 'hidden';
    overlay.innerHTML = '<div id="dialog_panel"><div id="dialog_content"> </div><div id="dialog_control"><a href="javascript:void(0)" id="dialog_close" class="button col2" style="display:none;">' + default_cancel + '</a><a href="javascript:void(0)" id="dialog_ok" class="button">' + default_okText + '</a></div></div>';

    var panel = X('dialog_panel');

    X('dialog_close').addEventListener('click', onClose);

    function closeAndCallback() {
        onClose();
        if (callback) {
            callback();
        }
    }

    X('dialog_ok').addEventListener('click', function() {
        if (enable) {
            if (validator) {
                validator(cloaseAndCallback);
            } else {
                closeAndCallback();
            }
        }
    });

    function onDisplay(evt, obj) {
        callback = null;
        validator = null;
        vfunction = null;


        if (obj.noCancel) {
            X('dialog_close').style.display = 'none';
            var e = X('dialog_ok');
            XPE.className(e).remove('col2');
        } else {
            X('dialog_close').style.display = 'inline-block';
            var e = X('dialog_ok');
            XPE.className(e).add('col2');
        }

        if (obj.doNotShowOk) {
            X('dialog_ok').style.display = 'none';
        } else {
            X('dialog_ok').style.display = 'inline-block';
        }

        if ('string' === typeof obj) {
            X('dialog_content').innerHTML = obj;
            callback = null;
        } else {
            X('dialog_content').innerHTML = obj.msg;
            if (obj.okText) {
                X('dialog_ok').innerHTML = obj.okText;
            } else {
                X('dialog_ok').innerHTML = default_okText;
            }
            if (obj.closeText) {
                X('dialog_close').innerHTML = obj.closeText;
            } else {
                X('dialog_close').innerHTML = default_cancel;
            }
            callback = obj.callback;
            validator = obj.validator;
        }

        if (obj.type === '1') {
            X('dialog_control').style.display = 'none';
            overlay.style.background = 'none';
            var e = X('dialog_panel');
            XPE.className(e).add('dialog_modal');
            var t = obj.delay || 1200;
            clearTimeout(vt);
            vt = setTimeout(function() {
                onClose();
                if (callback) {
                    callback();
                }
            }, t);
        } else {
            X('dialog_control').style.display = '';
            overlay.style.background = 'rgba(0,0,0,0.6)';
            e = X('dialog_panel');
            XPE.className(e).remove('dialog_modal');
        }
        
        if (obj.disbg) {
            XPE.className(overlay).add('disbg');
        } else {
            XPE.className(overlay).remove('disbg');
        }

        if (obj.v) {
            vfunction = obj.v;
            vfunction();
        }

        //overlay.style.display = 'block';
        overlay.style.visibility= 'visible';
        //by getting the actual width of the panel, we can then calculate the
        //margin-left correctly so the div can be positioned correctly in the middle
        //this works for div that positioned as absolute or fixed
        //if the div is static positioned, then just use margin:0 auto
        var marginLeft = -Math.floor(panel.offsetWidth / 2) + 'px';
        var marginTop = -Math.floor((panel.offsetHeight) / 2) + 'px';
        panel.css('marginLeft', marginLeft);
        panel.css('marginTop', marginTop);
    }


    function onClose() {
        if (enable) {
            //overlay.style.display = 'none';
            overlay.style.visibility= 'hidden';
            //X('dialog_content').innerHTML = '';
        }
    }
    
    X.error = function(msg, title) {
        onDisplay("showModal", {
            title: (title || default_title),
            msg: msg,
            noCancel: true,
            okText: default_okText
        });
    };

    X.dialog = function(msg) {
        onDisplay("showModal", {
            type: "1",
            msg: msg
        });
    };

    function setDialog(evt, obj) {
        if (obj.enable) {
            enable = true;
        } else {
            enable = false;
        }

        if (obj.okText) {
            X('dialog_ok').innerHTML = obj.okText;
        } else {
            X('dialog_ok').innerHTML = default_okText;
        }

        if (obj.closeText) {
            X('dialog_close').innerHTML = obj.closeText;
        } else {
            X('dialog_close').innerHTML = default_cancel;
        }

        if (obj.disabled) {
            X('dialog_ok').disabled = true;
            X('dialog_close').disabled = true;
        }
    }

    X.sub("setDialog", setDialog);
    X.sub("showDialog", onDisplay);
    X.sub("closeDialog", onClose);

});