<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Dashboard Desenvolvimento</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--<link rel="shortcut icon" href="img/gazin.ico" />-->
        <link href="../../chart/css/style.css" rel="stylesheet">
        <link href="../../chart/css/bootstrap.css" rel="stylesheet">
        <script src="../../chart/js/jquery.min.js" type="text/javascript"></script>
        <script src="../../chart/js/highcharts.js"></script>
        <script src="../../chart/js/data.js"></script>
        <script src="../../chart/js/exporting.js"></script>
        <script>


            $(function () {
mesAtual();
                Highcharts.createElement('link', {
                    href: 'https://fonts.googleapis.com/css?family=Unica+One',
                    rel: 'stylesheet',
                    type: 'text/css'
                }, null, document.getElementsByTagName('head')[0]);
                Highcharts.theme = {
                    colors: ["#2b908f", "#90ee7e", "#f45b5b", "#7798BF", "#aaeeee", "#ff0066", "#eeaaee",
                        "#55BF3B", "#DF5353", "#7798BF", "#aaeeee", "#42A5F5"],
                    chart: {
                        backgroundColor: {
                            linearGradient: {x1: 0, y1: 0, x2: 1, y2: 1},
                            stops: [
                                [0, '#252830'],
                                [1, '#252830']
                            ]
                        },
                        style: {
                            fontFamily: "'Roboto', sans-serif"
                        },
                        plotBorderColor: '#606063'
                    },
                    title: {
                        style: {
                            color: '#E0E0E3',
                            textTransform: 'uppercase',
                            fontSize: '25px'
                        }
                    },
                    xAxis: {
                        gridLineColor: '#707073',
                        labels: {
                            style: {
                                color: '#E0E0E3'
                            }
                        },
                        lineColor: '#707073',
                        minorGridLineColor: '#505053',
                        tickColor: '#707073',
                        title: {
                            style: {
                                color: '#A0A0A3'

                            }
                        }
                    },
                    yAxis: {
                        gridLineColor: '#707073',
                        labels: {
                            style: {
                                color: '#E0E0E3'
                            }
                        },
                        lineColor: '#707073',
                        minorGridLineColor: '#505053',
                        tickColor: '#707073',
                        tickWidth: 1,
                        title: {
                            style: {
                                color: '#A0A0A3'
                            }
                        }
                    }

                };

                Highcharts.setOptions(Highcharts.theme);
                $("div[id^='atendimento']").each(function(index){
                    
                    $(this).highcharts({
                        data: {
                            table: 'datatable['+index+']'
                        },
                        chart: {
                            type: 'column'
                        },
                        colors: [
                            '#42A5F5'
                            
                        ],
                        title: {
                            text: $("table[id='datatable["+index+"]']").attr("title")
                        },
                        yAxis: {
                            allowDecimals: false,
                            title: {
                                text: 'Units'
                            }
                        },
                        xAxis:{
                            labels: {
                                rotation: -45,
                                align: 'right',
                                style: {
                                    fontSize: '20px',
                                    fontFamily: "'Roboto', sans-serif"
                                }
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        labels: {
                            rotation: -45,
                            align: 'right',
                            style: {
                                fontSize: '25px',
                                fontFamily: "'Roboto', sans-serif"
                            }
                        },
                        plotOptions: {
        		    column: {
                                grouping: false,
                                shadow: false,
                                //stacking: 'percent',
                                dataLabels: {
                                    enabled: true,
                                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                                    style: {
                                        textShadow: '0 0 3px black'
                                    }
                                }
                            }
                        },
                        series: [{
                               dataLabels: {
                                    y: -50,
                                    enabled: true,
                                    //rotation: -90,
                                    color: '#FFFFFF',
                                    align: 'center',
                                    style: {
                                        fontSize: '26px',
                                        fontFamily: "'Roboto', sans-serif"
                                    }
                                }
                            },{
                                color:'#2f99ef',
                                dataLabels: {
                                    enabled: true,
                                    //rotation: -90,
                                    color: '#FFFFFF',
                                    align: 'center',
                                    style: {
                                        fontSize: '26px',
                                        fontFamily: "'Roboto', sans-serif"
                                    }
                                }
                            }]
                    });
                   
                });
                
                function mesAtual(){
                    var mes;
                    mes = new Date();
                    console.log(mes.getMonth());
                }
                
                // menu action e display nas tabs
                $("#ulmenu li a").click(function(){
                    
                    $("#ulmenu li").each(function(){
                        if($(this).hasClass("active")){
                            $(this).removeClass("active");
                            $("div[id='"+this.id+"']").css("display","none");
                        }
                    });
                    
                    $(this).parent().addClass("active");
                    $("div[id='"+$(this).parent().attr("id")+"']").fadeIn();
                    
                    $(Highcharts.charts).each(function(i,chart){
                        var height = chart.renderTo.clientHeight; 
                        var width = chart.renderTo.clientWidth; 
                        chart.setSize(width, height); 
                    });
                });
                
                
                //função start tab automatico
                var rotationTabArrayIdx = 0;
                var rotationTabArrayTab = [];
                var rotationTabSeconds  = 10;
                var rotationTabTimer;
                
                startRotationTab = function(firstStart){
                    
                    clearTimeout(rotationTabTimer);
                    
                    if(firstStart){
                        $('#ulmenu li').each(function(){
                            rotationTabArrayTab.push(this.id);
                        });
                    }
                                        
                    $("#ulmenu li[id='"+rotationTabArrayTab[rotationTabArrayIdx]+"'] a").click();

                    rotationTabArrayIdx++;

                    if(rotationTabArrayIdx === rotationTabArrayTab.length){
                        rotationTabArrayIdx = 0;
                    }
                    
                    rotationTabTimer = setTimeout(function(){
                        startRotationTab(false);
                    }, (rotationTabSeconds * 3000) );
                };
                
                startRotationTab(true);
                
            });
 
        </script>
    </head>


    <body>
        <div class="container contop">
            <div class="col-md-8">
                <p class="ptop">Dashboard</p>
                <p class="ptopbottom">Desenvolvimento</p>
            </div>
            <div class="col-md-4 rigthcalendar">
                <label class="labeldata"><span class="glyphicon glyphicon glyphicon-calendar"></span>  <?php echo date('d/m/Y') ?></label>
            </div>
        </div>

        <div class="container" style="margin-top: 25px;">
            <ul id="ulmenu" class="nav nav-pills ulnav">
                <li id="aba1" class="active"><a class="menudash">Atendimento </a></li>
                <li id="aba2"><a class="menudash">Suporte</a></li>
                <li id="aba3"><a class="menudash">Desenvolvimento</a></li>
            </ul>
        </div>
        
        <div class="container" style="width: 100%; margin-top: 25px;">
            
            <div id="aba1" class="row">
                <div class="col-md-12">
                    <div id="atendimento[0]" style="height: 550px;"></div>
                    <table id="datatable[0]" title="Gestão a Vista Desenvolvimento T.I" style="display: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Jane</th>
                                <th>John</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Apples</th>
                                <td>95</td>
                                <td>10</td>
                            </tr>
                            <tr>
                                <th>Pears</th>
                                <td>95</td>
                                <td>55</td>
                            </tr>
                            <tr>
                                <th>Plums</th>
                                <td>95</td>
                                <td>95</td>
                            </tr>
                            <tr>
                                <th>Bananas</th>
                                <td>95</td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <th>Oranges</th>
                                <td>95</td>
                                <td>12</td>
                            </tr>
                            <tr>
                                <th>Oranges</th>
                                <td>95</td>
                                <td>28</td>
                            </tr>
                            <tr>
                                <th>Oranges</th>
                                <td>95</td>
                                <td>54</td>
                            </tr>
                            <tr>
                                <th>Oranges</th>
                                <td>95</td>
                                <td>37</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="aba2" class="row" style="display: none;">
                <div class="col-md-12">
                    <div id="atendimento[1]" style="height: 550px;"></div>
                    <table id="datatable[1]" title="Gestão a Vista Suporte T.I" style="display: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Jane</th>
                                <th>John</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Apples</th>
                                <td>3</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <th>Pears</th>
                                <td>2</td>
                                <td>1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div id="aba3" class="row" style="display: none;">
                <div class="col-md-12">
                    <div id="atendimento[2]" style="height: 550px;"></div>
                    <table id="datatable[2]" title="Gestão a Vista Técnica T.I" style="display: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>John</th>
                                <th>Fabio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Apples</th>
                                <td>3</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <th>Pears</th>
                                <td>2</td>
                                <td>3</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
  
       
        <div class="container" style="margin-top: 10px;text-align: center;">
            <div class="col-md-3">
               
            </div>
            <div class="col-md-3">
                <p> 
                    <span class="glyphicon glyphicon glyphicon-stop iconmeta"></span>
                </p>
                <p class="totalbuttom meta">Referência</p>
            </div>
            <div class="col-md-3">
                <p>
                    <span class="glyphicon glyphicon glyphicon-stop iconrealizado"></span>
                </p>
                <p class="totalbuttom meta">Realizado</p>
            </div>
            <div class="col-md-3">
               
            </div>
        </div>
    </body>
</html>

