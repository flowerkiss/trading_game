<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>ECharts</title>
    <!-- 引入 echarts.js -->
    <script src="../../public/js/echarts.min.js"></script>
</head>
<body>
    <!-- 为ECharts准备一个具备大小（宽高）的Dom -->
    <div id="main" style="width: 800px;height:200px;"></div>
    <script type="text/javascript">
        var value = new Array();
        var index = new Array();

        <?php foreach($Value as $k => $v): ?>
          value.push(<?php echo $v; ?>);
          index.push(<?php echo $k; ?>)
        <?php endforeach; ?>

      
        var ctx_value = echarts.init(document.getElementById('main'));

        option = {
            tooltip: {
                trigger: 'axis',
            },
            xAxis:  {
                type: 'category',
                boundaryGap: false,
                data: index
            },
            yAxis: {
                type: 'value',
                boundaryGap: [0, '100%'],
                splitLine: {
                    show: true
                },
                min : 'dataMin',
                max : 'dataMax'
            },
            animationDuration: 10000,
            series: [{
                name: '模拟数据',
                type: 'line',
                showSymbol: false,
                hoverAnimation: false,
                data: value
            }]
        };
        ctx_value.setOption(option);

/*
        setInterval(function () {
            var i = 0;
            data.shift();
            data.push(value[i]);

            ctx_value.setOption({
                series: [{
                    data: data
                }]
            });
        }, 1000);
        */
    </script>
</body>
</html>
