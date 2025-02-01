


// Search Functionality
function myFunction() {
	var input, filter, ul, li, a, i, txtValue;
	input = document.getElementById("myInput");
	filter = input.value.toUpperCase();
	ul = document.getElementById("myUL");
	li = ul.getElementsByTagName("li");
	for (i = 0; i < li.length; i++) {
		a = li[i].getElementsByTagName("a")[0];
		txtValue = a.textContent || a.innerText;
		if (txtValue.toUpperCase().indexOf(filter) > -1) {
			li[i].style.display = "";
		} else {
			li[i].style.display = "none";
		}
	}
}


(function ($) {
  "use strict";

  /*-------------------------------------
	  Sidebar Toggle Menu
	-------------------------------------*/
  $('.sidebar-toggle-view').on('click', '.sidebar-nav-item .nav-link', function (e) {
	if (!$(this).parents('#wrapper').hasClass('sidebar-collapsed')) {
	  var animationSpeed = 300,
		subMenuSelector = '.sub-group-menu',
		$this = $(this),
		checkElement = $this.next();
	  if (checkElement.is(subMenuSelector) && checkElement.is(':visible')) {
		checkElement.slideUp(animationSpeed, function () {
		  checkElement.removeClass('menu-open');
		});
		checkElement.parent(".sidebar-nav-item").removeClass("active");
	  } else if ((checkElement.is(subMenuSelector)) && (!checkElement.is(':visible'))) {
		var parent = $this.parents('ul').first();
		var ul = parent.find('ul:visible').slideUp(animationSpeed);
		ul.removeClass('menu-open');
		var parent_li = $this.parent("li");
		checkElement.slideDown(animationSpeed, function () {
		  checkElement.addClass('menu-open');
		  parent.find('.sidebar-nav-item.active').removeClass('active');
		  parent_li.addClass('active');
		});
	  }
	  if (checkElement.is(subMenuSelector)) {
		e.preventDefault();
	  }
	} else {
	  if ($(this).attr('href') === "#") {
		e.preventDefault();
	  }
	}
  });

  /*-------------------------------------
	  Sidebar Menu Control
	-------------------------------------*/
  $(".sidebar-toggle").on("click", function () {
	window.setTimeout(function () {
	  $("#wrapper").toggleClass("sidebar-collapsed");
	}, 500);
  });

  /*-------------------------------------
	  Sidebar Menu Control Mobile
	-------------------------------------*/
  $(".sidebar-toggle-mobile").on("click", function () {
	$("#wrapper").toggleClass("sidebar-collapsed-mobile");
	if ($("#wrapper").hasClass("sidebar-collapsed")) {
	  $("#wrapper").removeClass("sidebar-collapsed");
	}
  });

  /*-------------------------------------
	  jquery Scollup activation code
   -------------------------------------*/
  $.scrollUp({
	scrollText: '<i class="fa fa-angle-up"></i>',
	easingType: "linear",
	scrollSpeed: 900,
	animation: "fade"
  });

  /*-------------------------------------
	  jquery Scollup activation code
	-------------------------------------*/
  $("#preloader").fadeOut("slow", function () {
	$(this).remove();
  });

  $(function () {
	/*-------------------------------------
		  Data Table init
	  -------------------------------------*/
	if ($.fn.DataTable !== undefined) {
	  $('.data-table').DataTable({
		paging: true,
		searching: true,
		info: false,
		lengthChange: false,
		lengthMenu: [20, 50, 75, 100],
		columnDefs: [{
		  targets: [0, -1], // column or columns numbers
		  orderable: true // set orderable for selected columns
		}],
	  });
	}

	/*-------------------------------------
		  All Checkbox Checked
	  -------------------------------------*/
	$(".checkAll").on("click", function () {
	  $(this).parents('.table').find('input:checkbox').prop('checked', this.checked);
	});

	/*-------------------------------------
		  Tooltip init
	  -------------------------------------*/
	$('[data-toggle="tooltip"]').tooltip();

	/*-------------------------------------
		  Select 2 Init
	  -------------------------------------*/
	if ($.fn.select2 !== undefined) {
	  $('.select2').select2({
		width: '100%'
	  });
	}

	/*-------------------------------------
		  Date Picker
	  -------------------------------------*/
	if ($.fn.datepicker !== undefined) {
		$('.air-datepicker').datepicker(
		{
		language: {
		  days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
		  daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
		  daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
		  months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
		  monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		  today: 'Today',
		  clear: 'Clear',
		  dateFormat: 'dd/mm/yyyy',
		  firstDay: 0,
		},
		// minDate: new Date(),
		// maxDate: new Date().setTime(Date().getDate() + 10),
	  });
	}

	/*-------------------------------------
		  Counter
	  -------------------------------------*/
	var counterContainer = $(".counter");
	if (counterContainer.length) {
	  counterContainer.counterUp({
		delay: 50,
		time: 1000
	  });
	}

	/*-------------------------------------
		  Vector Map 
	  -------------------------------------*/
	if ($.fn.vectorMap !== undefined) {
	  $('#world-map').vectorMap({
		map: 'world_mill',
		zoomButtons: false,
		backgroundColor: 'transparent',

		regionStyle: {
		  initial: {
			fill: '#0070ba'
		  }
		},
		focusOn: {
		  x: 0,
		  y: 0,
		  scale: 1
		},
		series: {
		  regions: [{
			values: {
			  CA: '#41dfce',
			  RU: '#f50056',
			  US: '#f50056',
			  IT: '#f50056',
			  AU: '#fbd348'
			}
		  }]
		}
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
		aspectRatio: 1.8,
		events: [{
			title: 'All Day Event',
			start: '2025-01-01'
		  },

		  {
			title: 'Meeting',
			start: '2025-01-12T14:30:00'
		  },
		  {
			title: 'Happy Hour',
			start: '2025-01-15T17:30:00'
		  },
		  {
			title: 'Birthday Party',
			start: '2025-01-20T07:00:00'
		  }
		]
	  });
	}
  });

})(jQuery);

$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});




// finding total