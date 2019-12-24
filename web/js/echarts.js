var eColor = [
    "#59c4e6",
    "#dc69aa",
    "#ffb980",
    "#97b552",
    "#8d98b3",
    "#07a2a4",
    "#b6a2de",
    "#59678c",
    "#edafda",
    "#d87a80",
    "#e5cf0d",
    "#f5994e",
    "#c05050",
    "#c9ab00",
    "#7eb00a",
    "#6f5553",
    "#c14089",
    "#c12e34",
    "#e6b600",
    "#0098d9",
    "#2b821d",
    "#005eaa",
    "#339ca8",
    "#cda819",
    "#32a487"
]
function init(data,id,title) {
    var myChart = echarts.init(document.getElementById(id));
    option = {
        title: {
            text: title,
            // subtext: '数据来自网络',
            textStyle: {
                color: '#666',
                fontSize: 14,
                fontWeight: 'bold'
            }
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        axisLine: {
            lineStyle: {
                type: 'solid',
                color: '#d2d2d2' //左边线的颜色

            }
        },
        axisLabel: {
            // interval: 1,
            rotate: 50,
            lineHeight: 56,
            textStyle: {
                color: '#A8A8A8' //坐标值得具体的颜色

            }
        },
        legend: {
            data: data.legends,
            bottom:0
        },
        toolbox: {
            feature: {
                dataView: {show: true, readOnly: false},
                magicType: {show: true, type: ['line', 'bar']},
                restore: {show: true},
                saveAsImage: {show: true}
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: 30,
            containLabel: true
        },
        yAxis: {
            type: 'value',
            boundaryGap: [0, 0.01],
            axisTick: {
                show: false
            },
            splitLine: {
                show: true,
                lineStyle: {
                    color: '#dde',
                    type: 'dashed',
                    opacity: 0.5,
                    width: 1
                }
            },
            axisLine: {
                show: false
            },
            axisLabel: {
                textStyle: {
                    color: '#999'
                },
                formatter: function (value, index) {
                    var value;
                    if (value >= 1000) {
                        value = value / 1000 + 'k';
                    } else if (value < 1000) {
                        value = value;
                    }
                    return value
                }
            },
        },
        xAxis: {
            type: 'category',
            data: data.dates,
            axisLine: {
                lineStyle: {
                    type: 'solid',
                    color: '#d2d2d2' //左边线的颜色

                }
            },
            axisLabel: {
                // interval: 1,
                rotate: 50,
                lineHeight: 36,
                textStyle: {
                    color: '#A8A8A8' //坐标值得具体的颜色

                }
            },
        },
        color: eColor,
        series: [

        ]
    };

    $.each(data.series,function (index,element) {
        console.log(index,element);
        option.series.push({name:index,type:"bar",stack:"a",data:element})
    })

    myChart.setOption(option);
}