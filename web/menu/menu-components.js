Vue.component('addmenu', {
    data() {
        return {
            addMenu: {
                name: '',
                router: '',
            },
            parentid: '',
            menuname: '',
            rule: {
                name: [{required: true, message: '菜单名不能为空！', trigger: 'blur'}],
                router: [{required: true, message: '菜单路由地址不能为空！', trigger: 'blur'}],
            },
        }
    },
    template: `<el-form ref="addmenuref" :rules="rule" :model="addMenu">
                    <el-form-item>
                         <el-form-item label="所属父级">
                            <el-input :disabled="true" v-model="menuname"></el-input>
                         </el-form-item>
                    </el-form-item>
                    <el-form-item>
                         <el-form-item label="当前菜单名" prop="name">
                            <el-input v-model="addMenu.name"></el-input>
                         </el-form-item>
                    </el-form-item>
                    <el-form-item>
                         <el-form-item label="当前菜单路由" prop="router">
                            <el-input  v-model="addMenu.router"></el-input>
                         </el-form-item>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="addmenu">添加</el-button>
                        <el-button @click="cancel">取消</el-button>
                    </el-form-item>
                </el-form>`,
    props: ['menuname', 'parentid'],
    mounted() {
        console.log(this.menuname, this.parentid);
    },
    methods: {
        addmenu() {
            var _that = this
            this.$refs.addmenuref.validate((valid) => {
                if (valid) {
                    var data = {
                        Menu: {
                            name: this.addMenu.name,
                            router: this.addMenu.router,
                            parent_id: this.parentid
                        }
                    }
                    postRequest(controller, 'add-menu', data, (res) => {
                        if (res.data.code == 1) {
                            _that.common('refresh')
                        }
                    })
                } else {
                    check()
                }
            })
        },
        cancel() {
            this.common()
        },
        common(refresh='') {
            this.addMenu.name = ''
            this.addMenu.router = ''
            this.parentid = ''
            this.menuname = ''
            this.$emit('dialogaddmenustatus',refresh)
        }
    }
})

Vue.component('delmenu', {
    template: `<div>
                    <span>确定要删除吗？</span>
                    <div class="dialog-footer" style="margin-top: 40px;">
                        <el-button type="primary" @click="confirmDelete">确 定</el-button>
                        <el-button @click="cancel">取 消</el-button>
                    </div>
                </div>`,
    props: ['id'],
    data() {
        return {
            id: ''
        }
    },
    methods: {
        confirmDelete() {
            console.log("确定了");
            let _that = this
            postRequest(controller, 'del-menu?id=' + this.id, {}, (res) => {
                if (res.data.code == 1) {
                    _that.$emit('dialogdelmenustatus','refresh')
                }
            })
        },
        cancel(){
            this.$emit('dialogdelmenustatus')
        }
    }
})
