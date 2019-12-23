Vue.component('add',{
    template:`<el-form ref="addref" :rules="rules" :model="addForm">
                    <el-form-item>
                         <el-form-item label="配置项">
                            <el-input :disabled="true" v-model="des"></el-input>
                         </el-form-item>
                    </el-form-item>
                    <el-form-item>
                         <el-form-item :label="des+'名称'" prop="value">
                            <el-input v-model="addForm.value"></el-input>
                         </el-form-item>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="add">添加</el-button>
                        <el-button @click="cancel">取消</el-button>
                    </el-form-item>
                </el-form>`,
    props:['id','field','des'],
    data(){
        return {
            addForm:{
                value:'',
            },
            rules:{
                value:[{required: true, message: this.des+'不能为空', trigger: 'blur'}]
            }
        }
    },
    methods:{
        add(){
            console.log('添加');
            let _that = this
            _that.$refs.addref.validate((validate)=>{
                if (validate){
                    postRequest(controller,'add-config?id='+_that.id+"&field="+_that.field+"&value="+_that.addForm.value,{},(res)=>{
                        if (res.data.code == 1){
                            _that.common("refresh")
                        }
                    })
                }else{
                    check()
                }
            })
        },
        cancel(){
            this.common()
        },
        common(refresh=''){
            this.addForm.value = ''
            this.$emit('dialogaddstatus',refresh)
        }
    }
})