$(document).ready(function(){
	   $('#s_groups').select2({
            placeholder: "Select a group",
            allowClear: true
        });
$('.make-switch').on('switchChange.bootstrapSwitch', function(event, state) {
	var $parent = $(this).parent().parent().parent().parent();
	var $show = $parent.find('.generate');
	var $hidden = $show.find('.hidden');
	console.log($hidden);
	if(state){
		$show.fadeIn();
		$hidden.val('1');
	} else {
		$show.fadeOut();
		$hidden.val('0');
	}
});	

$('.generate_sp').click(function(e){
	e.preventDefault();
	var $parent = $(this).parent().parent();
	var token = '#SP' + Math.floor((Math.random() * 10000) + 1);
	$parent.find('.sp_form').val(token);
});

});