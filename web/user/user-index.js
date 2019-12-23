var vm
var controller = '/user/'
if (document.getElementById('user-index')) {
    vm = new Vue({
        el: "#user-index",
        data: {
            users: [],
            total: 1000,
            avatarstyle: {width: "40px", height: "40px", 'border-radius': "50%"},
            limit: 9,
            search_datetime: '',
            search_tel: '',
            search_nickname: '',
            page: 1,
            pickerOptions: {
                shortcuts: [{
                    text: '最近一周',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: '最近一个月',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: '最近三个月',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: '最近半年',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 90*2);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: '最近一年',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 90*2*2);
                        picker.$emit('pick', [start, end]);
                    }
                }]
            },
            userInfo:''
        },
        created() {
            this.getUsers()
        },
        filters:{
            // 时间戳转时间
            timeTran(time=0){
                return moment(moment.unix(time).format('YYYY-MM-DD HH:mm:ss'))._i
            }
        },
        methods: {
            getUsers() {
                let _that = this
                postRequest(controller, 'get-user?page=' + _that.page + "&limit=" + this.limit + "&nickname=" + _that.search_nickname + "&tel=" + _that.search_tel + "&datetime=" + _that.search_datetime, {}, (res) => {
                    console.log(res);
                    _that.users = res.data.data
                    _that.total = parseInt(res.data.total)
                })
            },

            // 双击修改菜单属性
            edititemdbclick(field = '', data = '') {
                let _that = this
                let value = data[field]
                let id = field + data.id
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

                    postRequest(controller, 'edit-user?id=' + data.id + "&field=" + field + "&value=" + inputObj.val(), {}, (res) => {
                        console.log(res);
                        if (res.data.code == 1) {
                            setTimeout(() => {
                                _that.users = []
                                _that.getUsers()
                            }, 500)
                        }
                    })
                })
            },

            // 修改用户状态 目前只有 正常 和 拉黑
            edititemclick(field = '', id = '', value = '') {
                let _that = this
                postRequest(controller, 'edit-user?id=' + id + "&field=" + field + "&value=" + value, {}, (res) => {
                    console.log(res);
                    if (res.data.code == 1) {
                        setTimeout(() => {
                            _that.getUsers()
                        }, 500)
                    }
                })
            },
            pageChange(page) {
                let _that = this
                _that.page = page
                _that.getUsers()
            },

            // 获取用户详情
            getUserInfo(index = 0){
                this.userInfo = this.users[index]
            },

            search() {
                let _that = this
                _that.getUsers()
            },

            refresh() {
                let _that = this
                _that.search_datetime = ''
                _that.search_tel = ''
                _that.search_nickname = ''
                _that.getUsers()
            }
        },
    })
}