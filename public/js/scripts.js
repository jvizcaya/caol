
/*
*  Create dataset for bar char
*
*/
function createDatasets(data) {

    var dataset = [];

    data.forEach(function(element, index) {
        dataset.push({
          label: element.no_usuario,
          data: generateData(element.invoices),
          backgroundColor: setColor(index),
          borderColor: setColor(index),
          borderWidth: 1
        });
    });

    dataset.push({
            label: 'Custo Fixo Médio',
            data: average_salary(data),
            type: 'line',
            order: 2
        });

    return dataset;
}

/*
*  Create data for dataset
*
*/
function generateData(data){

    var values = [];

    data.forEach(function(element){
      values.push(element.income.toFixed(2));
    });

    return values;
}

/*
*  return rgbs color
*
*/
function setColor(value){

    var colors = [
      'rgba(255, 0, 0, 0.2)',
      'rgba(0, 0, 255, 0.2)',
      'rgba(60, 179, 113, 0.2)',
      'rgba(238, 130, 238, 0.2)',
      'rgba(255, 165, 0, 0.2)',
      'rgba(106, 90, 205, 0.2)',
      'rgba(255, 99, 71, 0.2)'
    ];

    return colors[value];
}
