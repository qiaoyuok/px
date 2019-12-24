var vm;
var controller = '/dashboard/';
vm = new Vue({
    el:"#app",
    data:{
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
            }]
        },
        time: '',
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
                init(res.data,'ad-status-echarts',"用户广告行为")
            })
        },
        getAdLogsByChannel(){
            var data = {};
            var _that = this;
            postRequest(controller,'get-ad-logs-by-channel',data,function (res) {
                init(res.data,'ad-channel-echarts',"用户来源渠道")
            })
        },
        toSearch(){
            moment.format()
        }
    }
})
