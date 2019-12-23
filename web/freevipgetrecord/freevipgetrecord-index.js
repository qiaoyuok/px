var vm;
var controller = '/freevipgetrecord/';


if (document.getElementById("freevipgetrecord-app")) {

    vm = new Vue({
        el: "#freevipgetrecord-app",
        data: {
            freevipgetrecordlist: [],
            page: 1,
            limit: 9,
            total: 0,
            search_datetime: '',
            search_tel: '',
            search_nickname: '',
            search_account: '',
            search_vip_name: '',
            search_accountType: '',
            avatarstyle: {width: "40px", height: "40px", 'border-radius': "50%"},
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
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 90 * 2);
                        picker.$emit('pick', [start, end]);
                    }
                }, {
                    text: '最近一年',
                    onClick(picker) {
                        const end = new Date();
                        const start = new Date();
                        start.setTime(start.getTime() - 3600 * 1000 * 24 * 90 * 2 * 2);
                        picker.$emit('pick', [start, end]);
                    }
                }]
            },
            search_vipNameList: [],
            search_accountTypeList: []
        },

        created() {
            this.getFreevipRecord()
        },
        filters: {
            // 时间戳转时间
            timeTran(time = 0) {
                return moment(moment.unix(time).format('YYYY-MM-DD HH:mm:ss'))._i
            }
        },
        methods: {

            //获取已领取会员记录
            getFreevipRecord() {

                let _that = this
                postRequest(controller, 'get-record-list?page=' + _that.page + "&limit=" + _that.limit + "&datetime=" + _that.search_datetime + "&tel=" + _that.search_tel + "&nickname=" + _that.search_nickname + "&account=" + _that.search_account + "&vip_name=" + _that.search_vip_name + "&accountType=" + _that.search_accountType, {}, res => {
                    console.log(res);
                    _that.freevipgetrecordlist = res.data.freevipRecordList
                    _that.total = res.data.total
                    _that.search_accountTypeList = res.data.accountType
                    _that.search_vipNameList = res.data.vip_names
                })
            },

            // 翻页
            pageChange(page) {
                let _that = this
                _that.page = page
                _that.getFreevipRecord()
            },

            //编辑提取账号状态
            edititemclick(field = '', id = '', value = '') {
                let _that = this
                postRequest(controller, 'edit-freevip-record?field=' + field + '&id=' + id + "&value=" + value, {}, res => {
                    if (res.data.code == 1) {
                        _that.getFreevipRecord()
                    }
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
                    postRequest(controller, 'edit-freevip-record?id=' + data.id + "&field=" + field + "&value=" + inputObj.val(), {}, (res) => {
                        if (res.data.code == 1) {
                            newDom.empty()
                            newDom.append(inputObj.val())
                            _that.getFreevipRecord()
                        }
                    })
                })
            },

            search() {
                let _that = this
                _that.getFreevipRecord()
            },

            refresh() {
                let _that = this
                _that.search_datetime = ''
                _that.search_tel = ''
                _that.search_nickname = ''
                _that.search_account = ''
                _that.search_vip_name = ''
                _that.search_accountType = ''
                _that.getFreevipRecord()
            }
        }
    })

}