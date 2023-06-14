/*
PIE CHART
================================================ */
var pieData = {
  labels: ['xxxx', 'yyyyy', 'zzzz', 'jjjj'],
  series: [14, 9, 8, 6]
};

var pieOptions = {
  width: '100%',
  height: '440px'
};

new Chartist.Pie('.pie-chart', pieData, pieOptions);

/*
BAR CHART
================================================ */
var barData = {
  labels: ['2018年', '2019年', '2020年'],
  series: [[10, 16, 29]]
};

var barOptions = {
    axisY: {
        offset: 60,
        scaleMinSpace: 50,
        labelInterpolationFnc: function(value) {
          return value + ' 人'
        }
    },
    width: '100%',
    height: '400px'
};

new Chartist.Bar('.bar-chart', barData, barOptions);
