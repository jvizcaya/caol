
/*
*  Create dataset for bar char
*
*/
function createBarData(data) {

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
    
    for (var i = 1; i <= 12; i++){
      let value = _.find(data, function(o) { return o.month == i; });
      let dataPush = value ? value.income.toFixed(2) : 0;

      values.push(dataPush);
    }

    return values;
}

/*
*  return rgbs color
*
*/
function setColor(value){

    var colors = [
      'rgba(255, 0, 0, 0.3)',
      'rgba(0, 0, 255, 0.3)',
      'rgba(60, 179, 113, 0.3)',
      'rgba(238, 130, 238, 0.3)',
      'rgba(255, 165, 0, 0.3)',
      'rgba(106, 90, 205, 0.3)',
      'rgba(255, 99, 71, 0.3)'
    ];

    return colors[value];
}

/**
 * calculate average salary
 *
 */
function average_salary(data){

    var avg = _.meanBy(data, function(o) { return o.salary.brut_salario; });
    var avgArray = [];

    for (var i = 0; i < 12; i++){
      avgArray.push(avg);
    }

    return avgArray;
}

/*
*  Create dataset for pie char
*
*/
function createPieData(values) {

    var totalArray = _.map(values, sum);
    var total = _.sum(totalArray);

    var data = [];
    var labels = [];
    var colors = [];

    values.forEach(function(element, index) {
        labels.push(element.no_usuario);
        colors.push(setColor(index));

        let value = percentage(totalArray[index], total).toFixed(2);

        data.push(value);
    });

    return dataObject(data, colors, labels);
}

/**
 * return dataset for pie chart
 *
 */
function dataObject(data, colors, labels){

    return {
      'datasets': [{
        'data' : data,
        'backgroundColor': colors
      }],
      'labels' : labels
    };
}

/*
*  sum the invoices values
*
*/
function sum(n) {
  return _.sumBy(n.invoices, function(o) { return o.income; });
}

/**
 *  calculate percentage
 */
function percentage(amount, total){
    return (amount * 100) / total;
}
