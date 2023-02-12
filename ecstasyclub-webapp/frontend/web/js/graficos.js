jQuery(document).ready(function () {

  google.charts.setOnLoadCallback(draw_my_chart);
  google.charts.setOnLoadCallback(draw_my_chart2);

  function draw_my_chart() {

    var options = {
      legend: {
        alignment: "center",
        textStyle: { color: "black", fontSize: 20 },
      },
      //legend: 'none',
      pieSliceText: "value",
      width: 590,
      height: 350,
      pieHole: 0.5,
      sliceVisibilityThreshold: 0.05,
      //is3D: true
    };

    //------------ grafico1 ------------------//
    console.log('teste');
    var data = new google.visualization.DataTable();
    data.addColumn("string", "Roles dos users");
    data.addColumn("number", "Numero de cada roles");

    model.forEach((element) => {
      data.addRows([[element.item_name, parseInt(element.quantidade_item_name)]]);
    });

    var chart = new google.visualization.PieChart(
      document.getElementById("chart_div")
    );
    chart.draw(data, options);
  }

  function draw_my_chart2() {
    var options = {
      legend: {
        alignment: "center",
        textStyle: { color: "black", fontSize: 20 },
      },
      //legend: 'none',
      pieSliceText: "value",
      width: 590,
      height: 350,
      pieHole: 0.5,
      //is3D: true,
      colors: ['pink','lightblue']
    };

    //------------ grafico2 ------------------//

    console.log('teste2');
    var data = new google.visualization.DataTable();
    data.addColumn("string", "descricao");
    data.addColumn("number", "numero");

    model2.forEach((element) => {
      data.addRows([[element.sexo, parseInt(element.quantidade)]]);
    });

    
    var chart = new google.visualization.PieChart(
      document.getElementById("chart_div2")
    );
    chart.draw(data, options);
  }
});
