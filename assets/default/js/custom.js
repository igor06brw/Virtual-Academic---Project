$(document).ready(function(){
	var base_url = $("#base_url").val();
	
	
	if ($('.clock').length > 0){
		var clock = $('.clock').FlipClock({
			clockFace: 'TwentyFourHourClock'
		});
	}
	if ($('#time2').length > 0) {
	(function () {
		function checkTime(i) {
			return (i < 10) ? "0" + i : i;
		}

		function startTime2() {
			var today = new Date(),
				h = checkTime(today.getHours()),
				m = checkTime(today.getMinutes()),
				s = checkTime(today.getSeconds());
			document.getElementById('time2').innerHTML = h + ":" + m + ":" + s;
			t = setTimeout(function () {
				startTime2()
			}, 500);
		}
		startTime2();
	})();
	}
	
	if ($('.runner').length > 0) {
		$('.runner').each(function(){
			var $that = $(this);
			var start = $that.data('start');
			console.log(start);
			$that.runner({
				autostart: true,
				countdown: false,
				startAt: start * 1000,
				milliseconds:false
			});
		});
	}
	
	
	var counter = $('#logout_in').data('seconds');
	var interval = setInterval(function() {
		counter--;
		$('#logout_in').html(counter);
		if (counter == 1) {
		    location = base_url + 'login/logout';
		}
	}, 1000);
	
	if ($('input[name="id"]').length > 0) {

		$('input[name="id"]').focus();
		$(document).mousemove(function(e){$('input[name="id"]').focus();counter = $('#logout_in').data('seconds');});
		$(document).keypress(function(e) {$('input[name="id"]').focus();counter = $('#logout_in').data('seconds');});

	}
	
	
});