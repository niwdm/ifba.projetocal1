<!DOCTYPE HTML>
<html>
    <head>
 
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" / >
        <meta http-equiv="refresh" content="150">
    <title>ProjetoCal/Temp/Humi</title>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript">
 
        $(document).ready(function() {
 
            var options = {
                chart: {
        zoomType: 'xy',
        alignTicks: false,
                    renderTo: 'container',
                    type: 'line',
                    marginRight: 80,
 
                    marginBottom: 55
                },
                title: {
                    text: 'Temp och Fukt',
                    x: -20 //center
                },
 
 
    xAxis: {
        crosshair: true,
        
            type: 'datetime',
            tickInterval: 80,
            labels: {
//                        format: '{value: %H:%M}',
                dateTimeLabelFormats: {
                           day: '%H:%M'
                }
//              align: 'right',
//              rotation: -90,
                    }
         },
 
        yAxis: [{
        title: {
            tickInterval: 0.1,
            text: '°C/%',
            rotation: 0,
            },
                labels: {
                    overflow: 'justify'
                    }
                },
        
        {
        title: {
                    tickInterval: 0.1,
            text: '°C/%',
            rotation: 0,
            },
                linkedTo:0,
                opposite:true
               }],
        tooltip: {
                    shared: true
                },
                legend: {
            enabled: true,
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom',
//                    x: 0,
                    y: 20,
                    borderWidth: 0
                },
    
                series: []
        }
 
                $.getJSON("datatemphumi.php", function(json) {
                    options.xAxis.categories = json[1]['data'];
                    options.series[0] = json[0];
                    options.series[1] = json[2];
            chart = new Highcharts.Chart(options);
            });
        });
        </script>
 
 
        <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
    </head>
    <body>
        <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
    </body>
</html>
