<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Chart.jsで凡例付き円グラフ</title>
     <script src="http://146.83.181.9/~sesparza/ProyectoHC/public/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="http://146.83.181.9/~sesparza/ProyectoHC/public/js/Chart.js"></script>

  </head>
  <body>
    <div id="chartArea" class="center">
      <canvas id="pieArea" height="300" width="300"></canvas>
      <div id="pieLegend"></div>
    </div>
    <script>
    // 円グラフ用データ
    // この変数名を legendTemplate の中で使っているので注意
var mydata1 = {//["Inform\u00e1tica y Computaci\u00f3n","Industria","Electricidad","Mec\u00e1nica","Ciencias","61","2","0","0","2","3","0","0","0","1"]
  labels : ["Inform\u00e1tica y Computaci\u00f3n","Industria","Electricidad","Mec\u00e1nica","Ciencias"],
  datasets : [
    {
      fillColor : "rgba(220,220,220,0.5)",
      strokeColor : "rgba(220,220,220,1)",
      pointColor : "rgba(220,220,220,1)",
      pointStrokeColor : "#fff",
      data : ["61","2","0","0","2"],
      title : "pFirst data"
    },
    {
      fillColor : "rgba(151,187,205,0.5)",
      strokeColor : "rgba(151,187,205,1)",
      pointColor : "rgba(151,187,205,1)",
      pointStrokeColor : "#fff",
      data : ["30","0","0","0","1"],
      title : "pSecond data"
    }
  ]
}

var newopts = {
canvasBackgroundColor:'#000',
spaceLeft:12,spaceRight:12,spaceTop:12,
spaceBottom:12,canvasBorders:false,
canvasBordersWidth:1,canvasBordersColor:"#000",
yAxisMinimumInterval:4,scaleShowLabels:true,scaleShowLine:true,
scaleLineWidth:1,scaleLineColor:"#000",
scaleOverlay :false,scaleOverride :false,
scaleSteps:2,scaleStepWidth:2,scaleStartValue:10,legend:false,
maxLegendCols:5,legendBlockSize:15,legendFillColor:'#000',
legendColorIndicatorStrokeWidth:1,legendPosX:-2,legendPosY:4,
legendXPadding:0,legendYPadding:0,legendBorders:false,legendBordersWidth:1,
legendBordersColors:"#000",legendBordersSpaceBefore:5,
legendBordersSpaceLeft:5,legendBordersSpaceRight:5,
legendBordersSpaceAfter:5,legendSpaceBeforeText:5,
legendSpaceLeftText:5,legendSpaceRightText:5,
legendSpaceAfterText:5,legendSpaceBetweenBoxAndText:5,
legendSpaceBetweenTextHorizontal:5,legendSpaceBetweenTextVertical:5,
legendFontFamily:"'Open Sans'",legendFontStyle:"normal normal",
legendFontColor:"#000",legendFontSize:10,showYAxisMin:false,
rotateLabels:"smart",xAxisBottom:true,yAxisLeft:true,
yAxisRight:false,scaleFontFamily:"'Open Sans'",
scaleFontStyle:"normal bold",scaleFontColor:"#000",
scaleFontSize:20,pointLabelFontFamily:"'Rubik One'",
pointLabelFontStyle:"normal normal",pointLabelFontColor:"#000",
pointLabelFontSize:16,angleShowLineOut:true,angleLineWidth:1,
angleLineColor:"#000",
percentageInnerCutout:50,scaleShowGridLines:true,
scaleGridLineWidth:10,scaleGridLineColor:"#000",scaleXGridLinesStep:10,
scaleYGridLinesStep:3,segmentShowStroke:true,segmentStrokeWidth:2,
segmentStrokeColor:"rgba(255,255,255,1.00)",datasetStroke:true,datasetFill : true,
datasetStrokeWidth:2,bezierCurve:true,pointDotStrokeWidth : 1,pointDotRadius : 3,pointDot : false,
pointDotMarker :"circle",barShowStroke : false,barBorderRadius:0,barStrokeWidth:1,barValueSpacing:15,
barDatasetSpacing:0,scaleShowLabelBackdrop :true,scaleBackdropColor:'rgba(255,255,255,0.75)',
scaleBackdropPaddingX :20,scaleBackdropPaddingY :2,animation : true,
}



    setopts=newopts;
    // var myLine = new Chart(document.getElementById("canvas_line").getContext("2d")).Radar(mydata1,setopts);
    // オプション
    var options = {
        // 凡例表示用の HTML テンプレート
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\">&nbsp;&nbsp;&nbsp;</span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
    };
    // 円グラフ描画
    var myPie = new Chart(document.getElementById("pieArea").getContext("2d")).Radar(mydata1,newopts);
    // generateLegend() の出力を HTML に入れる
  //  document.getElementById("pieLegend").innerHTML = myPie.generateLegend();
    </script>
  </body>
</html>
    <style>
      .center {
          margin-left: auto;
          margin-right: auto;
          text-align: center;
      }
      #pieLegend {
          padding: 10px;
          overflow: hidden;
          position: relative;
      }
      ul.radar-legend {
          list-style: none outside none;
          float: left;
          margin: 0 0 0 0;
          padding: 0;
          position: relative;
          left: 50%;
      }
      ul.radar-legend > li {
          float: left;
          margin-right: 5px;
          padding: 5px;
          position: relative;
          left: -50%;
      }
    </style>
