var vm;
var controller = '/goods/goods/';
let qiniu = "https://image.mysvip.cn/"

if (document.getElementById('goods-index-app')) {

    vm = new Vue({
        el: "#goods-index-app",
        data: {
            goodsList: [],
            limit: 9,
            page: 1,
            total: 0,
            stockLimit: 9,
            stockPage: 1,
            stockTotal: 0,
            parentCates: [],
            baseConfig: {},
            goodsType: 1,
            row: '',
            accounts: '',
            stock: []
        },
        created() {
            this.getGoodsList()
            this.getCate()
        },
        filters: {
            // 时间戳转时间
            timeTran(time = 0) {
                return moment(moment.unix(time).format('YYYY-MM-DD HH:mm:ss'))._i
            },
            accountFilter(id, origin) {
                let _that = this
                let name;
                $.each(origin, function (index, element) {
                    if (element.index == id) {
                        return name = element.value;
                    }
                })
                return name
            },
            cateFilter(id, origin, isParent = 1) {
                let _that = this
                let name;
                if (isParent == 1) {
                    $.each(origin, function (index, element) {
                        if (element.id == id) {
                            return name = element.cate_name;
                        }
                    })
                }
                if (isParent == 0) {
                    $.each(origin, function (index, element) {
                        $.each(element.children, function (i, v) {
                            if (v.id == id) {
                                return name = v.cate_name;
                            }
                        })
                    })
                }
                return name
            },
        },
        methods: {

            //获取商品列表
            getGoodsList() {
                let _that = this
                postRequest(controller, 'get-goods-list?goodsType=' + _that.goodsType, {}, res => {
                    console.log(res);
                    _that.goodsList = res.data.goodsList
                    _that.total = res.data.total
                })
            },

            //获取分类列表
            getCate() {
                let _that = this
                postRequest("/accountconfig/", 'get-account-config', {}, res => {
                    console.log(res);
                    _that.parentCates = res.data.accountCates
                    _that.baseConfig = res.data.accountBaseConfig
                })
            },

            // 修改商品状态 目前只有 正常 和 拉黑
            edititemclick(field = '', id = '', value = '') {
                let _that = this
                if (value == 3) {
                    this.$confirm('此操作将永久删除该商品, 是否继续?', '提示', {
                        confirmButtonText: '确定',
                        cancelButtonText: '取消',
                        type: 'warning'
                    }).then(() => {
                        postRequest(controller, 'edit-goods-status?id=' + id + "&field=" + field + "&value=" + value, {}, (res) => {
                            console.log(res);
                            if (res.data.code == 1) {
                                setTimeout(() => {
                                    _that.getGoodsList()
                                }, 500)
                            }
                        })
                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: '已取消删除'
                        });
                    });
                } else {
                    postRequest(controller, 'edit-goods-status?id=' + id + "&field=" + field + "&value=" + value, {}, (res) => {
                        console.log(res);
                        if (res.data.code == 1) {
                            setTimeout(() => {
                                _that.getGoodsList()
                            }, 500)
                        }
                    })
                }
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
                                _that.getGoodsList()
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

            changeTab(e) {
                let _that = this
                _that.goodsType = parseInt(e.index) + 1
                _that.getGoodsList()
            },

            tableRowClassName({row, rowIndex}) {
                if (row.goodsType == 1) {
                    return 'account-type-row';
                } else {
                    return 'common-type-row';
                }
            },

            //添加库存
            addstock(row) {
                this.row = row
            },

            //获取库存
            getStock() {
                let _that = this
                postRequest(controller, 'get-stock?goodsId=' + _that.row.id + "&page=" + _that.stockPage + "&limit=" + _that.stockLimit, {}, (res) => {
                    console.log(res);
                    _that.stock = res.data.stocks
                    _that.stockTotal = res.data.total
                })
            },

            addStockSubmit() {
                let _that = this
                postRequest(controller, 'add-accounts?id=' + this.row.id, {
                    accounts: this.accounts,
                    row: this.row
                }, (res) => {
                    if (res.data.code == 1) {
                        setTimeout(() => {
                            $("#cancelAdd").click()
                            _that.accounts = ''
                            _that.getGoodsList()
                        }, 500)
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

            pageChange(page) {
                let _that = this
                _that.page = page
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
            // 查看库存
            showStock(e) {
                console.log(e);
                let _that = this
                _that.stockPage = 1
                _that.row = e

                _that.getStock()
            },
            stockPageChange(page) {
                let _that = this
                _that.stockPage = page
                _that.getStock()
            },
        }
    })

}