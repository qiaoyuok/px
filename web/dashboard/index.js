var vm;
var controller = '/dashboard/';
vm = new Vue({
    el:"#app",
    data:{

    },
    created(){
        this.getAdLogsByStatus();
        this.getAdLogsByChannel();
    },
    methods:{
        getAdLogsByStatus(){
            var data = {};
            var _that = this;
            postRequest(controller,'get-ad-logs-by-status',data,function (res) {
                init(res.data,'ad-status-echarts')
            })
        },
        getAdLogsByChannel(){
            var data = {};
            var _that = this;
            postRequest(controller,'get-ad-logs-by-channel',data,function (res) {
                init(res.data,'ad-channel-echarts')
            })
        }
    }
})
