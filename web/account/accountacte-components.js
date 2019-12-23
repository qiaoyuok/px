Vue.component('addcate',{
    template:`<el-form ref="addcateref" :rules="rules" :model="addCate">
                    <el-form-item>
                         <el-form-item label="所属父级">
                            <el-input :disabled="true" v-model="parentname"></el-input>
                         </el-form-item>
                    </el-form-item>
                    <el-form-item>
                         <el-form-item label="当前分类名" prop="cate_name">
                            <el-input v-model="addCate.cate_name"></el-input>
                         </el-form-item>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="addcate">添加</el-button>
                        <el-button @click="cancel">取消</el-button>
                    </el-form-item>
                </el-form>`,
    props:['parentid','parentname'],
    data(){
        return {
            addCate:{
                cate_name:''
            },
            parentid:'',
            rules:{
                cate_name:[{required: true, message: '分类名不能为空！', trigger: 'blur'}]
            }
        }
    },
    methods:{
        cancel(){
            this.common()
        },
        addcate(){

            let _that = this
            this.$refs.addcateref.validate((validate)=>{
                if (validate){
                    let data = {
                        Accountcate:{
                            cate_name:_that.addCate.cate_name,
                            parent_id:_that.parentid
                        }
                    }
                    postRequest(controller,'add-cate',data,(res)=>{
                        console.log(res);
                        if (res.data.code == 1){
                            setTimeout(()=>{
                                _that.common('refresh')
                            },500)
                        }
                    })
                }
            })
        },
        common(refresh='') {
            this.addCate.cate_name = ''
            this.parentid = ''
            this.parentname = ''
            this.$emit('dialogaddcatetatus',refresh)
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
            postRequest(controller, 'del-cate?id=' + this.id, {}, (res) => {
                if (res.data.code == 1) {
                    _that.$emit('dialogdelcatestatus','refresh')
                }
            })
        },
        cancel(){
            this.$emit('dialogdelcatestatus')
        }
    }
})