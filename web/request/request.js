var appId = '';
var id = '';
var msg = ''

//获取页面get参数
function getParam() {
    var aQuery = window.location.href.split("?");  //取得Get参数
    var aGET = new Array();
    if (aQuery.length > 1) {
        var aBuf = aQuery[1].split("&");
        for (var i = 0, iLoop = aBuf.length; i < iLoop; i++) {
            var aTmp = aBuf[i].split("=");  //分离key与Value
            aGET[aTmp[0]] = aTmp[1];
        }
    }
    return aGET;
}

// 获取url中的操作APPID
function getAppId() {
    if (appId === "") {
        var get = getParam();
        if (get.hasOwnProperty('appId')) {
            appId = get['appId'];
        }
    }
    return appId;
}

// 获取url中的参数id
function getId() {
    if (id === "") {
        var get = getParam();
        if (get.hasOwnProperty('id')) {
            id = get['id'];
        }
    }
    return id;
}

/**
 * post 异步请求封装
 * @param controller    控制器
 * @param option    操作名
 * @param data      请求数据
 * @param fun       回调方法
 */
function postRequest(controller = '', option = '', data = '', fun = '') {
    var config = {headers: {"Content-Type": "application/x-www-form-urlencoded"}};
    var csrfToken = $('meta[name="csrf-token"]').attr("content");
    data._csrf = csrfToken;
    axios.post(controller + option, Qs.stringify(data), config).then(response => {
        if (response.data.code == 1) {
            msg = vm.$message({
                showClose: false,
                message: response.data.msg,
                type: 'success'
            });
        } else if (response.data.code == 0) {
            msg = vm.$message({
                showClose: false,
                message: response.data.msg,
                type: 'error'
            });
        }
        if (fun != '') {
            fun(response)
        }
    });
}

/**
 * 前端校验报错提示
 */
function check() {
    vm.$message({
        showClose: false,
        message: '所有必填项不能为空！',
        type: 'error'
    });
    return false;
}
