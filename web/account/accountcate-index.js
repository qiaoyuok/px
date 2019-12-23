let controller = '/accountcate/'
let vm;

if (document.getElementById('accountcate-index')) {
    vm = new Vue({
        el: "#accountcate-index",
        data: {
            cates: [],
            dialogAddCate: false,
            deleteDialog: false,
            parentname: '',
            parentid: '',
            id: '',
        },
        created() {
            this.getCates()
        },
        methods: {
            getCates() {
                let _that = this
                postRequest(controller, 'get-cate', {}, (res) => {
                    console.log(res);
                    _that.cates = res.data
                })
            },

            // 编辑分类
            editcateitem(field = '', value = '', id = '') {
                let _that = this
                postRequest(controller, 'edit-cate?field=' + field + "&value=" + value + "&id=" + id, {}, (res) => {
                    console.log(res)
                    if (res.data.code == 1) {
                        setTimeout(() => {
                            _that.getCates()
                        }, 500)
                    }
                })
            },

            // 添加分类
            addcate(parentname = '', parentid = 0) {
                this.parentname = parentname
                this.parentid = parentid
                this.dialogAddCate = true
            },

            dialogaddcatetatus(refresh = '') {
                this.dialogAddCate = false
                if (refresh == 'refresh') {
                    this.getCates()
                }
            },

            dialogdelcatestatus(refresh = '') {
                this.deleteDialog = false
                if (refresh == 'refresh') {
                    this.getCates()
                }
            },

            delcate(id = '') {
                this.id = id
                this.deleteDialog = true
            }
        }
    })
}