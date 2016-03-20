$(document).ready(function(){
	var assets_url = $("#assets_url").val();
	function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
	}
	function checkTime(i) {
			if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
			return i;
	}


	startTime();
	$("#token").focus();

	$('#token').focusout(function(){
         $('#token').focus();
     });
	var count = 0;
	function send(){
	
		if(count !=0) {
			$("#token").val('');
			return true;
		}		
		
		var controller = $("#form").attr('data-controller');
		var token = $("#token").val();
		$.ajax({
			url: controller,
			method: 'POST',
			dataType: 'json',
			data:'token=' + token,
			beforeSend: function(){
				count = 0;
				$("#emp_name").css('visibility', 'hidden');
				$("#msg_back").css('visibility', 'hidden');
				/*
				$("body").css({'opacity' : '0.2'});
				$("body").css({'background-color' : '#1E1B1B'});
				*/
				$("#form :input").attr("disabled", true);
				$("#img").attr('src',assets_url + 'place.jpg');
				
			},
			complete: function(){
				$("body").css({'opacity' : '1.0'});
				$("body").css({'background-color' : '#ddd'});
				$("#form :input").attr("disabled", false);	
				$("#token").val('');
				$("#token").focus();
				
				
				
			},
			success: function(data){
				
			if(data.status){
					if(data.img.length > 0) $("#img").attr("src",data.img);
					$("#emp_name").html(data.emp_name).fadeIn('slow');
					$("#msg_back").html(data.msg_back).fadeIn('slow');
			
					$("#emp_name").css('visibility', 'visible');
					$("#msg_back").css('visibility', 'visible');
					
					if(data.welcome){
						var welcome = (data.custom_mp3_w) ? data.custom_mp3_w : assets_url + 'mp3/gm.mp3';
						var audio = new Audio(welcome);
						audio.play();			
					} else {
						var bye = (data.custom_mp3_b) ? data.custom_mp3_b : assets_url + 'mp3/sl.mp3';
						var audio = new Audio(bye);
						audio.play();
					}
					
					count = 3;
					var counter = setInterval(function(){
						  count=count-1;
						  if (count <= 0)
						  {
							 clearInterval(counter);
								$("#emp_name").css('visibility', 'hidden');
								$("#msg_back").css('visibility', 'hidden');
								$("#img").attr('src',assets_url + 'place.jpg');
							 return;
						  }
					} ,1000); 
	
				} else {
					if(data.img.length > 0) $("#img").attr("src",data.img);
					
					$("#emp_name").html(data.emp_name).fadeIn('slow');
					$("#msg_back").html(data.msg_back).fadeIn('slow');
		
		
					$("#emp_name").css('visibility', 'visible');
					$("#msg_back").css('visibility', 'visible');				
					
					count = 3;
					var counter = setInterval(function(){
						  count=count-1;
						  if (count <= 0)
						  {
							 clearInterval(counter);
								
								$("#emp_name").css('visibility', 'hidden');
								$("#msg_back").css('visibility', 'hidden');
								
								$("#img").attr('src',assets_url + 'place.jpg');
							 return;
						  }
					} ,1000);				
				}
			}
		});
		
	}
	
	$(document).on('submit','#form',function(){
		send();
		return false;
	});
	
	$("#send").click(function(e){
		e.preventDefault();
		send();
	});
});