<?php 
define('SECURE_ACCESS', true);
include('../../inc/connection.inc.php');
include('../../inc/function.inc.php');
?>
(function ($) {

	/*-------------------------------------
		  Doughnut Chart 
	  -------------------------------------*/
	if ($("#student-doughnut-chart").length) {
	  var doughnutChartData = {
		labels: ["Female Students", "Male Students"],
		datasets: [{
		  backgroundColor: ["#304ffe", "#ffa601"],
		  data: [<?php echo gettotalstudent('female')."," .gettotalstudent('male')?>],
		  label: "Total Students"
		}, ]
	  };
	  var doughnutChartOptions = {
		responsive: true,
		maintainAspectRatio: false,
		cutoutPercentage: 65,
		rotation: -9.4,
		animation: {
		  duration: 2000
		},
		legend: {
		  display: false
		},
		tooltips: {
		  enabled: true
		},
	  };
	  var studentCanvas = $("#student-doughnut-chart").get(0).getContext("2d");
	  var studentChart = new Chart(studentCanvas, {
		type: 'doughnut',
		data: doughnutChartData,
		options: doughnutChartOptions
	  });
	}
    /*-------------------------------------
		  Bar Chart 
	  -------------------------------------*/
	if ($("#expense-bar-chart").length) {

	  var barChartData = {
		labels: [
            <?php 
                $sql = "SELECT b.id AS batch_id, b.name AS batch_name, COUNT(s.id) AS student_count 
                FROM batch b 
                LEFT JOIN students s ON b.id = s.batch 
                GROUP BY b.id, b.name 
                ORDER BY b.numaric_value ASC";
    
                $result = mysqli_query($con, $sql);
                
                $batches = []; // Initialize an empty array
                
                // Fetch data and store in an array
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $batches[] = $row;
                    }
                    mysqli_free_result($result);
                } else {
                    echo "Error: " . mysqli_error($con);
                }
                
                $lastBatch = end($batches); // Get the last element

                foreach ($batches as $batch) {
                    echo $batch['batch_name'];
                    if ($batch !== $lastBatch) {
                        echo " ,";
                    }
                }
                ?>],
		datasets: [{
			backgroundColor: ["#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01","#40dfcd", "#417dfc", "#ffaa01",],
			
		  data: [
            <?php
            $lastBatch = end($batches); // Get the last element
            foreach ($batches as $batch) {
                echo intval($batch['student_count']);
                if ($batch !== $lastBatch) {
                    echo " ,";
                }
            }
            ?>],
		  label: "Students (Batch Wise)"
		}, ]
	  };
	  var barChartOptions = {
		responsive: true,
		maintainAspectRatio: false,
		animation: {
		  duration: 2
		},
		scales: {

		  xAxes: [{
			display: false,
			maxBarThickness: 100,
			ticks: {
			  display: false,
			  padding: 0,
			  fontColor: "#646464",
			  fontSize: 14,
			},
			gridLines: {
			  display: true,
			  color: '#e1e1e1',
			}
		  }],
		  yAxes: [{
			display: true,
			ticks: {
			  display: true,
			  autoSkip: false,
			  fontColor: "#646464",
			  fontSize: 14,
			  stepSize: 10,
			  padding: 20,
			  beginAtZero: true,
			  callback: function (value) {
				var ranges = [{
					divider: 1e6,
					suffix: 'M'
				  },
				  {
					divider: 1e3,
					suffix: 'k'
				  }
				];

				function formatNumber(n) {
				  for (var i = 0; i < ranges.length; i++) {
					if (n >= ranges[i].divider) {
					  return (n / ranges[i].divider).toString() + ranges[i].suffix;
					}
				  }
				  return n;
				}
				return formatNumber(value);
			  }
			},
			gridLines: {
			  display: true,
			  drawBorder: true,
			  color: '#e1e1e1',
			  zeroLineColor: '#e1e1e1'

			}
		  }]
		},
		legend: {
		  display: false
		},
		tooltips: {
		  enabled: true
		},
		elements: {}
	  };
	  var expenseCanvas = $("#expense-bar-chart").get(0).getContext("2d");
	  var expenseChart = new Chart(expenseCanvas, {
		type: 'bar',
		data: barChartData,
		options: barChartOptions
	  });
	}
    
	<?php
	$sql = "SELECT 
    b.id AS batch_id, 
    b.name AS batch_name, 
    d.id AS dept_id, 
    d.name AS dept_name, 
    COALESCE(COUNT(s.id), 0) AS student_count  -- Ensures zero count when no students exist
	FROM batch b
	LEFT JOIN students s ON b.id = s.batch AND s.dept_id = 2  -- Ensures the dept_id condition applies correctly
	LEFT JOIN depts_lab_list d ON d.id = 2  -- Keeps dept_id = 2 fixed
	WHERE d.public_view = '1'
	GROUP BY b.id, b.name, d.id, d.name
	ORDER BY b.id ASC, d.id ASC";

	$result = mysqli_query($con, $sql);

	$departments = [];

	if ($result) {
	while ($row = mysqli_fetch_assoc($result)) {
	$departments[] = $row;
	}
	mysqli_free_result($result);
	}
	?>
	
	/*------------------Line Chart ----------*/
	  if ($("#earning-line-chart").length) {
    var lineChartData = {
        labels: [<?php echo getDeptBatchList(1);?>],
        datasets: [{
            data: [<?php echo getDeptStudentCount(1);?>],
            backgroundColor: '#ff0000',
            borderColor: '#ff0000',
            borderWidth: 1,
            pointRadius: 0,
            pointBackgroundColor: '#ff0000',
            pointBorderColor: '#ffffff',
            pointHoverRadius: 6,
            pointHoverBorderWidth: 3,
            fill: 'origin',
            label: "Student of Civil Engineering "
        },
        {
            data: [<?php echo getDeptStudentCount(2);?>],
            backgroundColor: '#437dfc',
            borderColor: '#417dfc',
            borderWidth: 1,
            pointRadius: 0,
            pointBackgroundColor: '#304ffe',
            pointBorderColor: '#ffffff',
            pointHoverRadius: 6,
            pointHoverBorderWidth: 3,
            fill: 'origin',
            label: "Student of EEE "
        }]
    };

    var lineChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        animation: { duration: 2000 },
        scales: {
            xAxes: [{
                display: true,
                ticks: { display: true, fontColor: "#222222", fontSize: 16, padding: 20 },
                gridLines: { display: true, drawBorder: true, color: '#c23ccc', borderDash: [5, 5] }
            }],
            yAxes: [{
                display: true,
                ticks: {
                    display: true,
                    autoSkip: true,
                    maxRotation: 0,
                    fontColor: "#646464",
                    fontSize: 16,
                    stepSize: 20,
                    padding: 20,
                },
                gridLines: { display: true, drawBorder: false, color: '#cccccc', borderDash: [5, 5] }
            }]
        },
        legend: { display: false },
        tooltips: { mode: 'index', intersect: false, enabled: true },
        elements: { line: { tension: .35 }, point: { pointStyle: 'circle' } }
    };

    var earningCanvas = $("#earning-line-chart").get(0).getContext("2d");
    var earningChart = new Chart(earningCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
    });
}
    

	  
	/*-------------------------------------
		  Calender initiate 
	  -------------------------------------*/
	if ($.fn.fullCalendar !== undefined) {
	  $('#fc-calender').fullCalendar({
		header: {
		  center: 'basicDay,basicWeek,month',
		  left: 'title',
		  right: 'prev,next',
		},
		fixedWeekCount: false,
		navLinks: true, // can click day/week names to navigate views
		editable: true,
		eventLimit: true, // allow "more" link when too many events
		aspectRatio: 3,
		events: 
			<?php 
			$year=date("Y");
			$holidays=array();
			$holidays = [
				"$year-02-21" => "International Mother Language Day",
				"$year-03-17" => "Sheikh Mujibur Rahman's Birthday",
				"$year-03-26" => "Independence Day",
				"$year-04-14" => "Bengali New Year",
				"$year-05-01" => "May Day",
				"$year-05-17" => "Buddha Purnima",
				"$year-06-28" => "Eid-ul-Adha",
				"$year-06-29" => "Eid-ul-Adha Holiday",
				"$year-06-30" => "Eid-ul-Adha Holiday",
				"$year-07-07" => "Ashura",
				"$year-08-15" => "National Mourning Day",
				"$year-09-16" => "Eid-e-Milad-un-Nabi",
				"$year-10-24" => "Durga Puja (Bijoya Dashami)",
				"$year-12-16" => "Victory Day",
				"$year-12-25" => "Christmas Day",
				// Dhaka University Holidays
				"$year-02-28" => "Dhaka University Founding Day",
				"$year-04-10" => "DU Admission Test Holiday",
				"$year-06-15" => "Summer Vacation Start",
				"$year-07-15" => "Summer Vacation End",
				"$year-12-31" => "DU Academic Year End",
				// Technical Education Board Holidays
				"$year-01-01" => "Technical Education Board Academic Year Start",
				"$year-06-01" => "Technical Education Board Semester Break Start",
				"$year-07-01" => "Technical Education Board Semester Break End",
				"$year-12-30" => "Technical Education Board Academic Year End"
			];

			$holidayEvents = [];
			foreach ($holidays as $date => $title) {
				$holidayEvents[] = [
					"title" => $title,
					"start" => $date . "T00:00:00"
				];
			}
			echo json_encode($holidayEvents, JSON_PRETTY_PRINT);
			?>
	  });
	}
})(jQuery);



toastr.options = {
    "closeButton": true,
    "debug": true,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}
