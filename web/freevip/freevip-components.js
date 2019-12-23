Vue.component('add', {
    template: `<el-form ref="addref" :rules="rules" :model="Form">
                    <el-form-item label="会员种类">
                        <el-input :disabled="true" style="width: 50%;" :value="config.cate_name"></el-input>
                    </el-form-item>
                    <el-form-item label="会员名称" prop="cate_index">
                         <el-select v-model="Form.cate_index" placeholder="请选择">
                            <el-option
                              v-for="(item,index) in config.children"
                              :key="index"
                              :label="item.cate_name"
                              :value="index">
                            </el-option>
                         </el-select>
                         <span>（如：爱奇艺）</span>
                    </el-form-item>
                   
                    <el-form-item label="账号类型" prop="accountType_index">
                         <el-select v-model="Form.accountType_index" placeholder="请选择">
                            <el-option
                              v-for="(item,index) in accountType"
                              :key="index"
                              :label="item.accountType.value"
                              :value="index">
                            </el-option>
                         </el-select>
                         <span>（如：激活码）</span>
                    </el-form-item>
                    <el-form-item label="会员类型" prop="vip_id">
                         <el-select v-model="Form.vip_id" placeholder="请选择">
                            <el-option
                              v-for="(item,index) in vip_type"
                              :key="index"
                              :label="item.value"
                              :value="item.id">
                            </el-option>
                         </el-select>
                         <span>（如：黄金会员）</span>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="add">添加</el-button>
                        <el-button @click="cancel">取消</el-button>
                    </el-form-item>
                </el-form>`,
    props: ['config'],
    data() {
        return {
            value: 3,
            accountType: [],
            vip_type: [],
            Form: {
                cate_index: '',
                accountType_index: '',
                vip_id: ''
            },
            config: {},
            rules: {
                cate_index: [{required: true, message: '请先选择会员'}],
                accountType_index: [{required: true, message: '请选择账号类型！'}],
                vip_id: [{required: true, message: '请选择会员类型！'}],
            },
        }
    },
    mounted(){
      console.log(this.config,222);
    },
    watch: {
        'Form.cate_index'() {
            console.log("账号类型：", this.Form.accountType, "会员类型：", this.Form.vip_type);
            this.Form.accountType = ''
            this.Form.vip_id = ''
            this.vip_type = []
            console.log(this.Form.cate_index);
            if (this.Form.cate_index !== '') {
                console.log(111);
                this.accountType = this.config.children[this.Form.cate_index].config
            }
        },
        'Form.accountType_index'() {
            if (this.Form.accountType_index === '') {
                return false
            }
            console.log(this.Form.accountType_index,'sss');
            this.Form.vip_id = ''
            console.log(this.config.children[this.Form.cate_index].config[this.Form.accountType_index].config,222);
            this.vip_type = this.config.children[this.Form.cate_index].config[this.Form.accountType_index].config
        },
    },
    methods: {
        add() {
            let _that = this
            _that.$refs.addref.validate((validate) => {
                if (validate) {
                    let data = {
                        freeconfig_main: {
                            parent_cate_id: _that.config.id,
                            parent_cate_name: _that.config.cate_name,
                            logo: _that.config.children[_that.Form.cate_index].logo,
                            cateId: _that.config.children[_that.Form.cate_index].id,
                            vip_name: _that.config.children[_that.Form.cate_index].cate_name,
                            vipType: _that.Form.vip_id,
                            accountType: _that.config.children[_that.Form.cate_index].config[_that.Form.accountType_index].accountType.id
                        }
                    }
                    postRequest(controller, 'add-freevip-config', data, (res) => {
                        console.log(res);
                        if (res.data.code == 1) {
                            setTimeout(() => {
                                _that.Form.accountType_index = ''
                                _that.Form.vip_id = ''
                                _that.Form.cate_index = ''
                                _that.vip_type = []
                                _that.accountType = []
                                _that.common('refresh')
                            }, 500)
                        }
                    })
                } else {
                    check()
                }
            })
        },

        cancel() {
            this.common()
            console.log("取消");
        },

        common(refresh = '') {
            this.$emit('dialogaddstatus', refresh)
        }
    }
})

Vue.component('addstock', {
    template: `<el-form ref="addstockref" :rules="rules" :model="data">
                    <el-form-item label="会员种类名">
                        <el-input :disabled="true" v-model="vipdata.vip_name+vipdata.vipType" style="width: 50%;"></el-input>
                    </el-form-item>
                    <el-form-item label="会员到期时间" prop="endTime">
                       <el-date-picker
                          v-model="data.endTime"
                          type="datetime"
                          value-format="timestamp"
                          placeholder="选择日期">
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item label="添加会员账号（格式：账号----密码  支持多行）" prop="account">
                        <el-input
                          type="textarea"
                          :rows="4"
                          placeholder="请输入内容"
                          v-model="data.account">
                        </el-input>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="add">添加</el-button>
                        <el-button @click="cancel">取消</el-button>
                    </el-form-item>
                </el-form>`,
    props: ['vipdata'],
    mounted() {
        console.log(this.vipdata);
    },
    data() {
        return {
            data: {
                endTime: '',
                account: ''
            },
            rules: {
                endTime: [{required: true, message: '会员到期时间不能为空'}],
                account: [{required: true, message: '会员账号不能为空'}],
            },
        }
    },
    methods: {
        add() {
            let _that = this
            this.$refs.addstockref.validate((validate) => {
                if (validate) {
                    postRequest(controller, 'add-freevip-stock?id=' + _that.vipdata.id, _that.data, (res) => {
                        if (res.data.code == 1) {
                            setTimeout(() => {
                                _that.common('refresh')
                            }, 500)
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

        common(refresh = '') {
            this.data.account = ''
            this.data.viptime = ''
            this.$emit('dialogaddstatus', refresh)
        }
    }
})

Vue.component('addtype', {
    template: `<el-form ref="addtyperef" :rules="rules"  :model="Form">
                    <el-form-item label="会员种类" prop="value">
                         <el-select v-model="Form.value" placeholder="请选择">
                            <el-option
                              v-for="(item,index) in unaddedcates"
                              :key="index"
                              :label="item.cate_name"
                              :value="index">
                            </el-option>
                         </el-select>
                         <span>（如：视频，阅读）</span>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="add">添加</el-button>
                        <el-button @click="cancel">取消</el-button>
                    </el-form-item>
                </el-form>`,
    props: ['unaddedcates'],
    data() {
        return {
            unaddedcates: [],
            Form: {
                value: '',
            },
            rules: {
                value: [{required: true, message: '会员种类不能为空！', trigger: 'blur'}]
            },
        }
    },
    show() {
        console.log('sss');
    },
    methods: {
        add() {
            let _that = this
            this.$refs.addtyperef.validate((validate) => {
                if (validate) {
                    let data = {
                        'cateId': _that.unaddedcates[_that.Form.value].id,
                        'cate_name': _that.unaddedcates[_that.Form.value].cate_name
                    }
                    postRequest(controller, 'add-freevip-cate', data, (res) => {
                        console.log(res);
                        if (res.data.code == 1) {
                            setTimeout(() => {
                                this.common("refresh")
                            }, 500)
                        }
                    })
                } else {
                    check()
                }
            })
        },

        cancel() {
            this.common()
            console.log("取消");
        },

        common(refresh = '') {
            this.$emit('dialogaddstatus', refresh)
        }
    }
})