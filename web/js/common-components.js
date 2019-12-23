// 删除项，通用组件
Vue.component('delitem',{
    template:`<div>
                    <span>确定要删除吗？</span>
                    <div class="dialog-footer" style="margin-top: 40px;">
                        <el-button type="primary" @click="confirmDelete">确 定</el-button>
                        <el-button @click="cancel">取 消</el-button>
                    </div>
                </div>`,
    props:['controller','url'],
    methods:{
        cancel(){
            this.common()
        },
        confirmDelete(){
            let _that = this
            postRequest(_that.controller,_that.url,{},(res)=>{
                console.log(res);
                if (res.data.code == 1){
                    setTimeout(()=>{
                        _that.common('refresh')
                    },500)
                }
            })
        },
        common(refresh=''){
            console.log("取消了");
            this.$emit('dialogstatus',refresh)
        }
    }
})