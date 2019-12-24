var vm;
var controller = '/dashboard/';
vm = new Vue({
    el:"#app",
    data:{

    },
    created(){
        this.getAdLogs();
    },
    methods:{
        getAdLogs(){
            var data = {};
            var _that = this;
            postRequest(controller,'get-ad-logs',data,function (res) {
                init(res.data,'ad-echarts')
            })
        }
    }
})
