<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>投票结果</title>
    <!-- 引入 echarts.js -->
    <script src="/Public/js/echarts.min.js"></script>
    <script type="text/javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/Public/js/layer.m.js"></script>
</head>
<body>
<!-- 为ECharts准备一个具备大小（宽高）的Dom -->
<div id="bar" style="width: 600px;height:400px;"></div>
<div id="pie" style="width: 600px;height:400px;"></div>
<script type="text/javascript">
    var myChart = echarts.init(document.getElementById('bar'));
    var option = {
        tooltip: {
            show: true
        },
        legend: {
            data: ['票数']
        },
        xAxis: [
            {
                type: 'category',
                data: (function(){
                    var arr=[];
                    $.ajax({
                        type : 'post',
                        async : false, //同步执行
                        url : "<?php echo U('home/show/show');?>",
                        data : {},
                        dataType : 'json', //返回数据形式为json
                        success : function(json) {
                            if (json) {
                                for(var i=0;i<json.length;i++){
                                    //console.log(json[i].context);
                                    arr.push(json[i]['name']);
                                }
                            }

                        },
                        error : function(errorMsg) {
                            alert("不好意思,图表请求数据失败啦!");
                            myChart.hideLoading();
                        }
                    })
                    return arr;
                })()
            }
        ],
        yAxis: [
            {
                type: 'value'
            }
        ],
        series: [
            {
                'name': '票数',
                'type': 'bar',
                'data':(function(){
                    var arr=[];
                    $.ajax({
                        type : 'post',
                        async : false, //同步执行
                        url : "<?php echo U('home/show/show');?>",
                        data : {},
                        dataType : 'json', //返回数据形式为json
                        success : function(json) {
                            if (json) {
                                for(var i=0;i<json.length;i++){
                                    console.log(json[i].context);
                                    arr.push(json[i]['vote']);
                                }
                            }
                        },
                        error : function(errorMsg) {
                            alert("不好意思,图表请求数据失败啦!");
                            myChart.hideLoading();
                        }
                    })
                    return arr;
                })()
            }
        ]
    };
    //使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);


    var myChart2 = echarts.init(document.getElementById('pie'));
    var option2 = {
        title : {
            text: '开发部投票结果',
            subtext: '欢迎投票',
            x:'center'
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: (function(){
                var arr=[];
                $.ajax({
                    type : 'post',
                    async : false, //同步执行
                    url : "<?php echo U('home/show/show');?>",
                    data : {},
                    dataType : 'json', //返回数据形式为json
                    success : function(json) {
                        if (json) {
                            for(var i=0;i<json.length;i++){
                                //console.log(json[i].context);
                                arr.push(json[i]['name']);
                            }
                        }
                    },
                    error : function(errorMsg) {
                        alert("不好意思,图表请求数据失败啦!");
                        myChart.hideLoading();
                    }
                })
                return arr;
            })()
        },
        series : [
            {
                name: '投票比例',
                type: 'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data: (function(){
                    var arr=[];
                    $.ajax({
                        type : 'post',
                        async : false, //同步执行
                        url : "<?php echo U('home/show/show');?>",
                        data : {},
                        dataType : 'json', //返回数据形式为json
                        success : function(json) {
                            if (json) {
                                for(var i=0;i<json.length;i++){
                                    var jsonObj = {};
                                    jsonObj.value = json[i]['vote'];
                                    jsonObj.name = json[i]['name'];
                                    arr.push(jsonObj);

                                }
                            }
                        },
                        error : function(errorMsg) {
                            alert("不好意思,图表请求数据失败啦!");
                            myChart.hideLoading();
                        }
                    })
                    return arr;
                })(),
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    };

    myChart2.setOption(option2);


</script>
</body>
</html>