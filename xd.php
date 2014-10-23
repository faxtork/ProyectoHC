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
      <canvas id="pieArea" height="200" width="200"></canvas>
      <div id="pieLegend"></div>
    </div>
    <script>
    // 円グラフ用データ
    // この変数名を legendTemplate の中で使っているので注意
    var datasets = [
        {
            value:     70,
            color:     "green",
            lineColor: "green",    // 凡例の色
            highlight: "seagreen",
            label:     "緑"        // 凡例のラベル
        },
        {
            value:     30,
            color:     "gold",
            lineColor: "gold",     // 凡例の色
            highlight: "yellow",
            label:     "黄色"      // 凡例のラベル
        }
    ];
    
    // オプション
    var options = {
        // 凡例表示用の HTML テンプレート
        legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\">&nbsp;&nbsp;&nbsp;</span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
    };
    // 円グラフ描画
    var myPie = new Chart(document.getElementById("pieArea").getContext("2d")).Pie(datasets, options);
    // generateLegend() の出力を HTML に入れる
    document.getElementById("pieLegend").innerHTML = myPie.generateLegend();
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
      ul.pie-legend {
          list-style: none outside none;
          float: left;
          margin: 0 0 0 0;
          padding: 0;
          position: relative;
          left: 50%;
      }
      ul.pie-legend > li {
          float: left;
          margin-right: 5px;
          padding: 5px;
          position: relative;
          left: -50%;
      }
    </style>