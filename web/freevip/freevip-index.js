var vm;
var controller = '/freevip/';
let qiniu = "https://image.mysvip.cn/"

if (document.getElementById('freevip-index')) {
    vm = new Vue({
        el: "#freevip-index",
        data: {
            config: [],
            vipdata: {},
            dialogAdd: false,
            dialogAddStock: false,
            dialogAddType: false,
            dialogDel: false,
            addedCase: [],
            unAddedCates: [],
            alsoconfigs: [],
            controller: controller,
            url: '',
            logostyle: {width: "60px", height: "auto"},
            timeconfig: [],
            selectedtimespace: 1,
            total: 1000,
            limit: 9,
            page: 1,
            qiniu:qiniu,
            stock:[],
            currentAccountInfo:{}
        },
        created() {
            this.getvipType()
            this.getFreeTimeSpace()
        },

        filters:{
            // 时间戳转时间
            timeTran(time=0){
                return moment(moment.unix(time).format('YYYY-MM-DD HH:mm:ss'))._i
            }
        },

        methods: {

            timeselect(){
                let _that = this
                postRequest(controller, 'edit-freevip-time?value=' + this.selectedtimespace, {}, res => {
                    if (res.data.code == 1) {
                        setTimeout(() => {
                            _that.getFreeTimeSpace()
                        }, 500)
                    }
                })
            },

            formatter(row, column) {
                return row.address;
            },

            // 合并单元格
            objectSpanMethod({row, column, rowIndex, columnIndex}) {
                if (columnIndex === 0) {
                    if (row.rowspan) {
                        return {
                            rowspan: row.rowspan,
                            colspan: 1
                        };
                    } else {
                        return {
                            rowspan: 0,
                            colspan: 0
                        };
                    }
                }
            },

            // 获取当前已添加的会员种类(包括一天假的种类和未添加的种类)
            getvipType() {
                let _that = this
                postRequest(controller, 'get-vip-type', {}, (res) => {
                    console.log(res);
                    if (res.data.addedCase.length > 0) {
                        _that.config = res.data.addedCase[0]
                    }
                    _that.addedCase = res.data.addedCase
                    _that.unAddedCates = res.data.unAddedCates
                    _that.getVipConfigs()
                })
            },

            // 接收到对话框消息
            dialogaddstatus(refresh) {
                this.dialogAdd = false
                this.dialogAddStock = false
                this.dialogAddType = false
                if (refresh != "") {
                    this.addedCase = []
                    this.unAddedCates = []
                    this.getvipType()
                }
            },

            getVipConfigs() {
                let _that = this
                postRequest(controller, 'get-free-vip-configs', {}, (res) => {
                    _that.alsoconfigs = res.data
                })
            },

            // 添加会员
            add(index = 0) {
                this.config = this.addedCase[index]
                this.dialogAdd = true
            },

            // 添加库存
            addstock(data = '') {
                this.vipdata = data
                this.dialogAddStock = true
            },

            // 添加会员种类
            addtype() {
                this.dialogAddType = true
            },

            // 复制商品
            copyGoods(id = 0) {
                let _that = this
                this.$confirm('确定要复制此商品吗?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
                }).then(() => {
                    postRequest(controller, 'copy-goods?id=' + id, {}, (res) => {
                        if (res.data.code == 1) {
                            setTimeout(() => {
                                _that.getVipConfigs()
                            }, 500)
                        }
                    })
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: '已取消复制'
                    });
                });
            },

            // 删除账号单项
            delaccount(id = 0) {
                let _that = this
                _that.url = 'del-freevip-config?id=' + id
                _that.dialogDel = true
            },

            dialogstatus() {
                this.dialogDel = false
                this.getvipType()
            },

            //编辑平台状态
            edititemclick(field = '', id = '', value = '') {
                let _that = this
                postRequest(controller, 'edit-freevip-config?field=' + field + '&id=' + id + "&value=" + value, {}, res => {
                    if (res.data.code == 1) {
                        setTimeout(() => {
                            _that.getvipType()
                        }, 500)
                    }
                })
            },

            // 获取时间间隔配置
            getFreeTimeSpace() {
                let _that = this
                postRequest(controller, 'get-time-space', {}, res => {
                    _that.timeconfig = res.data.times
                    _that.selectedtimespace = res.data.selectedtime
                })
            },

            // 双击修改菜单属性
            edititemdbclick(field = '', data = '') {
                let _that = this
                let value = data[field]
                let id = field + data.id
                let oldDom = document.querySelector("#" + id)
                let newDom = $(oldDom)
                newDom.empty()
                newDom.append(`<input style="
                                        width: 100%;height: 40px;border: 1px solid #c9c9c9;
                                        border-radius: 5px;padding: 0 10px";
                                        value="` + value + `"></input>`)
                let inputObj = $(newDom[0].childNodes[0])
                inputObj.focus()
                // 绑定失去焦点事件
                inputObj.bind('blur', function () {
                    if (value == inputObj.val()) {
                        newDom.empty()
                        newDom.append(value)
                        return false
                    }
                    postRequest(controller, 'edit-freevip-config?id=' + data.id + "&field=" + field + "&value=" + inputObj.val(), {}, (res) => {
                        if (res.data.code == 1) {
                            setTimeout(() => {
                                _that.alsoconfigs = []
                                _that.getvipType()
                            }, 500)
                        }
                    })
                })
            },

            // 查看库存
            showStock(e){
                console.log(e);
                let _that = this
                _that.page = 1
                _that.currentAccountInfo = e

                _that.getStock()
            },

            //获取库存
            getStock(){
                let _that = this
                postRequest(controller, 'get-stock?free_main_id=' + _that.currentAccountInfo.id+"&page="+_that.page+"&limit="+_that.limit , {}, (res) => {
                    console.log(res);
                    _that.stock = res.data.stocks
                    _that.total = res.data.total
                })
            },

            // 编辑账号库存状态
            editStock(field = '', id = '', value = '') {
                let _that = this
                postRequest(controller, 'edit-stock?field=' + field + '&id=' + id + "&value=" + value, {}, res => {
                    if (res.data.code == 1) {
                        _that.getStock()
                    }
                })
            },

            // 双击修改菜单属性
            editStockDbclick(field = '', data = '') {
                let _that = this
                let value = data[field]
                let id = field + data.id
                let oldDom = document.querySelector("#" + id)
                let newDom = $(oldDom)
                newDom.empty()
                newDom.append(`<input style="
                                        width: 100%;height: 40px;border: 1px solid #c9c9c9;
                                        border-radius: 5px;padding: 0 10px";
                                        value="` + value + `"></input>`)
                let inputObj = $(newDom[0].childNodes[0])
                inputObj.focus()
                // 绑定失去焦点事件
                inputObj.bind('blur', function () {
                    if (value == inputObj.val()) {
                        newDom.empty()
                        newDom.append(value)
                        return false
                    }
                    postRequest(controller, 'edit-stock?field=' + field + '&id=' + data.id + "&value=" + inputObj.val(), {}, res => {
                        if (res.data.code == 1) {

                            newDom.empty()
                            newDom.append(inputObj.val())
                            _that.getStock()
                        }
                    })
                })
            },

            // 翻页
            pageChange(page) {
                let _that = this
                _that.page = page
                _that.getStock()
            },
        }
    })
}