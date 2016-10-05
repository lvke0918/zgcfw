(function() {
    var data = {
        siteid: '9855912',
        root: 'http://qiao.baidu.com/v3/',
        baseUrl: '' || ('http://qiao.baidu.com/v3/' + 'asset/mobile/'),
        chatUrl: 'http://p.qiao.baidu.com//im/index' || 'http://webim.qiao.baidu.com//im/gateway',
        ucid: '22228420',
        icon: {
            enable: +'1',
            type: +'1',
            theme: 'sector' || 'bar',
            bgColor: '#0F78B5' || '#0F78B5',
            color: '#FFFFFF' || '#FFFFFF',
            size: +'1' || 1,
            top: +'50',
            left: +'5',
            pos: 'left' || 'left',
            bgUrl: '' || '',
            width: +'',
            height: +''
        },
        invite: {
            enable: +'0',
            type: +'1',
            bgColor: '#FFFFFF' || '#FFFFFF',
            bdColor: '#CCCCCC' || '#CCCCCC',
            color: '#333333' || '#333333',
            btnBgColor: '#0F78B5' || '#0F78B5',
            btnColor: '#FFFFFF' || '#FFFFFF',
            width: +'54',
            height: +'28',
            text: '欢迎光临 <br/> 请问有什么需要帮助的吗？',
            bgUrl: '' || ''
        }
    };
    var item = document.getElementById('globalMobileBridgeJSLoad');
    if (item) {
        return;
    }
    if (window.bd_bridge_show_hidden === 'hidden') {
        data.icon.enable = 0;
        data.invite.enable = 0;
    }
    var openModules = '' + data.icon.enable + data.invite.enable + 1;
    var MODULES = ['icon', 'invite', 'api'];
    var loadModules = [];
    var script = document.createElement('script');
    script.charset = 'utf-8';
    script.id = "globalMobileBridgeJSLoad";
    for (var i = 0,
             len = openModules.length; i < len; i++) {
        item = openModules.charAt(i);
        if (item !== '0' && MODULES[i]) {
            item = MODULES[i];
            loadModules.push(item);
        }
    }
    loadModules = loadModules.join('.');
    script.onload = function() {
        qiao.config({
            baseUrl: data.baseUrl
        });
        var req = 'entry/mobile' + (loadModules ? ('.' + loadModules) : '');
        qiao.require([req],
            function(mobile) {
                mobile.init(data);
            });
    }
    script.src = data.baseUrl + 'qiao' + (loadModules ? '.' + loadModules: '') + '.js?v=' + '20160613';
    var head = document.getElementsByTagName('head')[0];
    head.appendChild(script);
})();