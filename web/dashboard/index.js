var vm;
var controller = '/dashboard/';
vm = new Vue({
    el:"#app",
    data:{
        adData:[],
    },
    created(){
        this.getAdLogs();
    },
    methods:{
        getAdLogs(){
            var data = {};
            var _that = this;
            postRequest(controller,'get-ad-logs',data,function (res) {
                console.log(res)
                _that.adData = res.data;
                init()
            })
        }
    }
})

function init() {
    var myChart = echarts.init(document.getElementById('ad-echarts'));
    option = {
        title: {
            text: '世界人口总量',
            subtext: '数据来自网络'
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        legend: {
            data: vm.adData.legends
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        yAxis: {
            type: 'value',
            boundaryGap: [0, 0.01]
        },
        xAxis: {
            type: 'category',
            data: vm.adData.times
        },
        series: [

        ]
    };

    $.each(vm.adData.data,function (index,element) {

        var data = []
        $.each(element,function (i,v) {
            data.push(v)
        })
        option.series.push({name:index,type:"line",data:data})
    })

    myChart.setOption(option);
}