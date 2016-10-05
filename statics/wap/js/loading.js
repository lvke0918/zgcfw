/**
 * My module:
 *  loading
 */
X.sub("init", function() {
    var overlay = document.createElement('div');
    overlay.id = 'preloading';
    overlay.style.display = 'none';
    document.body.appendChild(overlay);
    // var str = '<div class="spinner">';
    // str += '<div class="cube1"></div>';
    // str += '<div class="cube2"></div>';
    // str += '</div>';
    // var str = '<div class="spinner">';
    // str += '<div class="rect1"></div>';
    // str += '<div class="rect2"></div>';
    // str += '<div class="rect3"></div>';
    // str += '<div class="rect4"></div>';
    //str += '<div class="rect5"></div>';
    str += '<div class="rect"></div>';
    str += '</div>';

    overlay.innerHTML = str;

    function onDisplay() {
        overlay.style.display = '';
    }

    function onClose() {
        overlay.style.display = 'none';
    }

    X.sub("showLoading", onDisplay);
    X.sub("closeLoading", onClose);
});