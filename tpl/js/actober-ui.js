$(function() {
	$( "#actober_tools" ).accordion();
	get_tshirt_color('1','1');
});

function get_tshirt_color(userid, productid){
	$.getJSON('webapi.php',{'act':'get_tshirt_color','userid':userid,'productid':productid}, function(data){
		if(data){
			$("#color_list").html('');		
			$.each(data, function(k,v){
				$("#color_list").append('<span style="background-color:'+v.color+'">'+v.number+'</span>');
			});
		}
	});
};

function add_more_upload_field(){
	var more_field = '<div><input type="file" name="custom_upload_files[]" /></div>';
	$("#custom_upload_file_list").append(more_field);
};
