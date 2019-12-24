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
        this.time = [moment().subtract('days',7), moment()];
    },
    watch:{
      time(){
            this.toSearch();
      }
    },
    methods:{
        getAdLogsByStatus(startAt='',endAt = ''){
            var data = {};
            var _that = this;
            postRequest(controller,'get-ad-logs-by-status?startAt='+startAt+"&endAt="+endAt,data,function (res) {
                init(res.data,'ad-status-echarts',"用户广告行为")
            })
        },
        getAdLogsByChannel(startAt='',endAt = ''){
            var data = {};
            var _that = this;
            postRequest(controller,'get-ad-logs-by-channel?startAt='+startAt+"&endAt="+endAt,data,function (res) {
                init(res.data,'ad-channel-echarts',"用户来源渠道")
            })
        },
        toSearch(){
            var startTime = moment(this.time[0]).format('YYYY-MM-DD');
            var endTime = moment(this.time[1]).format('YYYY-MM-DD');

            this.getAdLogsByStatus(startTime,endTime);
            this.getAdLogsByChannel(startTime,endTime);
        }
    }
})
