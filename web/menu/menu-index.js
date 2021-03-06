var vm;
var controller = '/menu/';

if (document.getElementById('menu-index')) {
    vm = new Vue({
        el: "#menu-index",
        data: {
            dialogAddMenu: false,
            deleteDialog:false,
            menus: [],
            menuName: '',
            parentId: '',
            id:''
        },
        created() {

            this.getMenus()

        },
        methods: {

            // 获取菜单列表
            getMenus() {
                var _that = this
                _that.deleteDialog = false
                var data = {}
                postRequest(controller, 'get-menus', data, (res) => {
                    _that.menus = res.data
                })
            },
            objectSpanMethod({row, column, rowIndex, columnIndex}) {
                if (columnIndex === 7 && row.parent != 0) {
                    return {
                        rowspan: row.rowspan,
                        colspan: 1
                    };
                }
            },

            // 添加菜单操作
            addmenu(name = '', id = '') {
                this.parentId = id
                this.menuName = name
                this.dialogAddMenu = true
            },

            // 监测添加菜单对话框
            dialogaddmenustatus(refresh ='') {
                this.dialogAddMenu = false
                if (refresh == 'refresh'){
                    this.getMenus()
                }
            },

            // 删除菜单
            delmenu(id=''){
                console.log(id);
                this.deleteDialog = true
                this.id = id
            },

            dialogdelmenustatus(refresh =''){
                this.deleteDialog = false
                if (refresh == 'refresh'){
                    this.getMenus()
                }
            },

            // 双击修改菜单属性
            edititemdbclick(field = '', menudata = '') {
                let _that = this
                let value = menudata[field]
                let id = field + menudata.id
                let oldDom = document.querySelector("#" + id)
                console.log(oldDom)
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
                    console.log(value, inputObj.val());
                    if (value == inputObj.val()) {
                        newDom.empty()
                        newDom.append(value)
                        return false
                    }

                    let data = {}
                    postRequest(controller, 'edit-menu?id=' + menudata.id + "&field=" + field + "&value=" + inputObj.val(), data, (res) => {
                        console.log(res);
                        if (res.data.code == 1) {
                            setTimeout(() => {
                                _that.menus = []
                                _that.getMenus()
                            }, 500)
                        }
                    })
                })
            },

            edititemclick(field = '', id = '', value = '') {
                let _that = this
                let data = {}
                postRequest(controller, 'edit-menu?id=' + id + "&field=" + field + "&value=" + value, data, (res) => {
                    console.log(res);
                    if (res.data.code == 1) {
                        setTimeout(() => {
                            _that.menus = []
                            _that.getMenus()
                        }, 500)
                    }
                })
            },
        }
    })
    console.log(vm);
}
