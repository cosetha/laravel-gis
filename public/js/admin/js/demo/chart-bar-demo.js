// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Bar Chart Example
var ctx = document.getElementById("myBarChart");
var myLineChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [],
    datasets: [{
      label: "Jumlah",
      backgroundColor: "rgba(2,117,216,1)",
      borderColor: "rgba(2,117,216,1)",
      data:[],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'month'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 5
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,  
          maxTicksLimit: 4        
        },
        gridLines: {
          display: true
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
function ajax_chart(chart) {
  var label;
  var data;
  $.get('/data-total', function(response){
   
      chart.data.labels = response.labels;
      for (let index = 0; index < response.data.length; index++) {
        chart.data.datasets[0].data = response.data;          
      }     
      chart.update(); // finally update our chart
  });
}
ajax_chart(myLineChart);
