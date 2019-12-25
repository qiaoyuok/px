Vue.component('addmenu', {
    data() {
        return {
            addMenu: {
                alias: '',
                wxgamecid: '',
            },
            rule: {
                alias: [{required: true, message: '渠道名不能为空！', trigger: 'blur'}],
                wxgamecid: [{required: true, message: '渠道值不能为空！', trigger: 'blur'}],
            },
        }
    },
    template: `<el-form ref="addmenuref" :rules="rule" :model="addMenu">
                    <el-form-item>
                         <el-form-item label="渠道名" prop="alias">
                            <el-input v-model="addMenu.alias"></el-input>
                         </el-form-item>
                    </el-form-item>
                    <el-form-item>
                         <el-form-item label="渠道值" prop="wxgamecid">
                            <el-input  v-model="addMenu.wxgamecid"></el-input>
                         </el-form-item>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="addmenu">添加</el-button>
                        <el-button @click="cancel">取消</el-button>
                    </el-form-item>
                </el-form>`,
    methods: {
        addmenu() {
            var _that = this
            this.$refs.addmenuref.validate((valid) => {
                console.log(valid)
                if (valid) {
                    var data = {
                        Wxgamecid: {
                            alias: this.addMenu.alias,
                            wxgamecid: this.addMenu.wxgamecid,
                        }
                    }
                    postRequest(controller, 'add-wxgamecid', data, (res) => {
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
            this.addMenu.alias = ''
            this.addMenu.wxgamecid = ''
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
            postRequest(controller, 'del-wxgamecid?id=' + this.id, {}, (res) => {
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
