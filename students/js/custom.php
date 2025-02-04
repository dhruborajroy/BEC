<?php
define('SECURE_ACCESS', true);
session_start();
require('../../inc/connection.inc.php');
require('../../inc/function.inc.php');
if(!isset($_SESSION[ 'USER_ID'])){
  die;
}
$user_id=$_SESSION[ 'USER_ID'];
?>

(function ($) {
  // USE STRICT
  "use strict";

  try {

// single bar chart
var ctx = document.getElementById("singelBarChart");
if (ctx) {
  ctx.height = 150;
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th"],
      datasets: [
        {
          label: "Semester wise GPA ",
          data: [<?php echo getGpaCount($user_id);?>],
          borderColor: "rgba(0, 123, 255, 0.9)",
          borderWidth: "0",
          backgroundColor: "rgba(0, 204, 255, 0.5)"
        }
      ]
    },
    options: {
      legend: {
        position: 'top',
        labels: {
          fontFamily: 'Poppins'
        }

      },
      scales: {
        xAxes: [{
          ticks: {
            fontFamily: "Poppins"

          }
        }],
        yAxes: [{
          display: true,
          gridLines: {
            display: false,
            drawBorder: false
          },
          scaleLabel: {
            display: true,
            labelString: 'Value',
            fontFamily: "Poppins"
          },
          ticks: {
            fontFamily: "Poppins",
            beginAtZero: true, // Ensure y-axis starts from 0
            min: 0 // Set minimum value to 0
          }
        }]
      }
    }
  });
}

} catch (error) {
console.log(error);
}


//WidgetChart 3
    var ctx = document.getElementById("widgetChart3");
    if (ctx) {
      ctx.height = 130;
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th"],
          type: 'line',
          datasets: [{
            data: [<?php echo getGpaCount($user_id);?>],
            label: 'Dataset',
            backgroundColor: 'transparent',
            borderColor: 'rgba(255,255,255,.55)',
          },]
        },
        options: {

          maintainAspectRatio: false,
          legend: {
            display: false
          },
          responsive: true,
          tooltips: {
            mode: 'index',
            titleFontSize: 12,
            titleFontColor: '#000',
            bodyFontColor: '#000',
            backgroundColor: '#fff',
            titleFontFamily: 'Montserrat',
            bodyFontFamily: 'Montserrat',
            cornerRadius: 3,
            intersect: false,
          },
          scales: {
            xAxes: [{
              gridLines: {
                color: 'transparent',
                zeroLineColor: 'transparent'
              },
              ticks: {
                fontSize: 2,
                fontColor: 'transparent'
              }
            }],
            yAxes: [{
              display: false,
              ticks: {
                display: false,
              }
            }]
          },
          title: {
            display: false,
          },
          elements: {
            line: {
              borderWidth: 1
            },
            point: {
              radius: 4,
              hitRadius: 10,
              hoverRadius: 4
            }
          }
        }
      });
    }



  try {
    //Team chart
    var ctx = document.getElementById("cgpa-chart");
    if (ctx) {
      ctx.height = 150;
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th"],
          type: 'line',
          defaultFontFamily: 'Poppins',
          datasets: [{
            data: [<?php echo calculateSemesterWiseCGPA($user_id)?>],
            label: "CGPA Curve",
            backgroundColor: 'rgba(0, 204, 255, 0.5)',
            borderColor: 'rgba(0,103,255,0.5)',
            borderWidth: 2,
            pointStyle: 'circle',
            pointRadius: 5,
            pointBorderColor: 'transparent',
            pointBackgroundColor: 'rgba(0,103,255,0.5)',
          }]
        },
        options: {
          responsive: true,
          tooltips: {
            mode: 'index',
            titleFontSize: 12,
            titleFontColor: '#000',
            bodyFontColor: '#000',
            backgroundColor: '#fff',
            titleFontFamily: 'Poppins',
            bodyFontFamily: 'Poppins',
            cornerRadius: 3,
            intersect: false,
          },
          legend: {
            display: false,
            position: 'top',
            labels: {
              usePointStyle: true,
              fontFamily: 'Poppins',
            },
          },
          scales: {
            xAxes: [{
              display: true,
              gridLines: {
                display: false,
                drawBorder: false
              },
              scaleLabel: {
                display: false,
                labelString: 'Month'
              },
              ticks: {
                fontFamily: "Poppins"
              }
            }],
            yAxes: [{
              display: true,
              gridLines: {
                display: false,
                drawBorder: false
              },
              scaleLabel: {
                display: true,
                labelString: 'Value',
                fontFamily: "Poppins"
              },
              ticks: {
                fontFamily: "Poppins",
                beginAtZero: true, // Ensure y-axis starts from 0
                min: 0 // Set minimum value to 0
              }
            }]
          },
          title: {
            display: true,
          }
        }
      });
    }

  } catch (error) {
    console.log(error);
  }


  try {
    //bar chart
    var ctx = document.getElementById("barChart");
    if (ctx) {
      ctx.height = 200;
      var myChart = new Chart(ctx, {
        type: 'bar',
        defaultFontFamily: 'Poppins',
        data: {
          labels: [<?php //echo getDeptBatchList(1);?>],
          datasets: [
            {
              label: "Students of CE",
              data: [<?php //echo getDeptStudentCount(1);?>],
              borderColor: "rgba(0, 123, 255, 0.9)",
              borderWidth: "0",
              backgroundColor: "rgba(0, 123, 255, 0.5)",
              fontFamily: "Poppins"
            },
            {
              label: "Students of EEE",
              data: [<?php //echo getDeptStudentCount(2);?>],
              borderColor: "rgba(0,0,0,0.09)",
              borderWidth: "0",
              backgroundColor: "rgba(0,0,0,0.07)",
              fontFamily: "Poppins"
            }
          ]
        },
        options: {
          legend: {
            position: 'top',
            labels: {
              fontFamily: 'Poppins'
            }

          },
          scales: {
            xAxes: [{
              ticks: {
                fontFamily: "Poppins"

              }
            }],
            yAxes: [{
              ticks: {
                beginAtZero: true,
                fontFamily: "Poppins"
              }
            }]
          }
        }
      });
    }


  } catch (error) {
    console.log(error);
  }


})(jQuery);