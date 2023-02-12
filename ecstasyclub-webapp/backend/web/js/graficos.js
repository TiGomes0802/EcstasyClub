jQuery(document).ready(function () {

  google.charts.setOnLoadCallback(draw_my_chart);
  google.charts.setOnLoadCallback(draw_my_chart2);

  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(draw_my_chart3);

  google.charts.setOnLoadCallback(draw_my_chart4);


  //------------ grafico1 ------------------//
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

  //------------ grafico2 ------------------//
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

  //------------ grafico3 ------------------//
  function draw_my_chart3() {

    const Info      = ['mês'      ];
    const January   = ['Janeiro'  ];
    const February  = ['Fevereiro'];
    const March     = ['Março'    ];
    const April     = ['Abril'    ];
    const May       = ['Maio'     ];
    const June      = ['Junho'    ];
    const July      = ['Julho'    ];
    const August    = ['Agosto'   ];
    const September = ['Setembro' ];
    const October   = ['Outobro'  ];
    const November  = ['Novembro' ];
    const December  = ['Dezembro' ];
    console.log(December);
    listatiposeventos.forEach((element, index) => {
      Info.push(element.tipo)
      var Number = 0.00;
      January.push(Number);
      February.push(Number);
      March.push(Number);
      April.push(Number);
      May.push(Number);
      June.push(Number);
      July.push(Number);
      August.push(Number);
      September.push(Number);
      October.push(Number);
      November.push(Number);
      December.push(Number);
    });
    console.log(December);
    listatiposeventos.forEach((element, index) => {
        model3.forEach((element2) => {
          if(element.tipo === element2.tipo){
            switch (element2.mes) {
              case 'January':
                January[index + 1] = parseFloat(parseFloat(element2.faturamento).toFixed(2));
                break;
              case 'February':
                February[index + 1] = parseFloat(parseFloat(element2.faturamento).toFixed(2));
                break;
              case 'March':
                March[index + 1] = parseFloat(parseFloat(element2.faturamento).toFixed(2));
                break;
              case 'April':
                April[index + 1] = parseFloat(parseFloat(element2.faturamento).toFixed(2));
                break;
              case 'May':
                May[index + 1] = parseFloat(parseFloat(element2.faturamento).toFixed(2));
                break;
              case 'June':
                June[index + 1] = parseFloat(parseFloat(element2.faturamento).toFixed(2));
                break;
              case 'July':
                July[index + 1] = parseFloat(parseFloat(element2.faturamento).toFixed(2));
                break;
              case 'August':
                August[index + 1] = parseFloat(parseFloat(element2.faturamento).toFixed(2));
                break;
              case 'September':
                September[index + 1] = parseFloat(parseFloat(element2.faturamento).toFixed(2));
                break;
              case 'October':
                October[index + 1] = parseFloat(parseFloat(element2.faturamento).toFixed(2));
                break;
              case 'November':
                November[index + 1] = parseFloat(parseFloat(element2.faturamento).toFixed(2));
                break;
              case 'December':
                December[index + 1] = parseFloat(parseFloat(element2.faturamento).toFixed(3));
                break;
            }
          }
        });
    });

    console.log(December);

    var data = google.visualization.arrayToDataTable([
      Info,
      January,
      February,
      March,
      April,
      May,
      June,
      July,
      August,
      September,
      October,
      November,
      December
    ]);

    var options = {

    };

    var chart = new google.charts.Bar(document.getElementById('chart_div3'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
  
  //------------ grafico4 ------------------//
  function draw_my_chart4() {

    var options = {
      legend: {
        alignment: "center",
        textStyle: { color: "black", fontSize: 20 },
      },
      //legend: 'none',
      pieSliceText: "value",
      width: 700,
      height: 350,
      pieHole: 0.5,
      //is3D: true,
    };

    
    console.log('teste4');
    var data = new google.visualization.DataTable();
    data.addColumn("string", "Codigos de rps");
    data.addColumn("number", "Numero de codigos de rps");

    model4.forEach((element) => {
      data.addRows([[element.codigorp, parseInt(element.quantidade)]]);
    });
    console.log(model4);
    var chart = new google.visualization.PieChart(
      document.getElementById("chart_div4")
    );
    chart.draw(data, options);
  }
  
});
